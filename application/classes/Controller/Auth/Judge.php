<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth_Judge extends Auth {

    const AUTH_MODE = 'judge';

    /**
     * Before execution parent class
     */
    public function before()
    {
        // поля без CSRF
        $exceptions = ['logout'];

        if (!in_array($this->request->action(), $exceptions)) {

            // check CSRF
            $this->checkCsrf();

        }


        // Do not allow render
        $this->auto_render = false;
        parent::before();
    }

    public function action_auth()
    {
        if (!$this->request->is_ajax()) {
            return;
        }
        $eventCode = (int) Arr::get($_POST, 'eventCode');
        $judgeSecret  = Arr::get($_POST, 'judgeSecret');

        $event = Model_Event::getEventByCode($eventCode);

        if (!$event) {
            $response = new Model_Response_Auth('INVALID_EVENT_CODE_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $auth = new Model_Auth();

        if ( !$auth->login($event, $judgeSecret, self::AUTH_MODE) ) {
            $response = new Model_Response_Auth('INVALID_JUDGE_SECRET_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $session = Session::instance();
        $sid = $session->id();
        $id = $session->get('id');

        $hash = $this->makeHash('sha256', getenv('AUTH_JUDGE_SALT') . $sid . self::AUTH_MODE . $id);

        Cookie::set('secret', $hash, Date::DAY);

        $this->saveSessionData($hash, $sid, $id);

        $response = new Model_Response_Auth('LOGIN_SUCCESS', 'success', array('id' => $id));
        $this->response->body(@json_encode($response->get_response()));

    }

    public function action_logout()
    {
        $auth = new Model_Auth();
        $auth->logout(TRUE);
        $this->clearCookie();

        $this->redirect('/');

    }

    private function clearCookie()
    {
        Cookie::delete('sid');
        Cookie::delete('id');
        Cookie::delete('secret');
        Cookie::delete('mode');
    }

    private function saveSessionData($hash, $sid, $id) {

        $this->redis->set(getenv('REDIS_SESSION_JUDGES_HASHES') . $hash, $sid . ':' . $id . ':' . Request::$client_ip, array('nx', 'ex' => 3600 * 24));

    }

}
