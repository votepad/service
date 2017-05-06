<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth_Judge extends Auth {

    const AUTH_JUDGE_SALT = 'votepadjudgessalt';
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
        $eventCode = (int) Arr::get($_POST, 'eventCode');
        $judgeSecret  = Arr::get($_POST, 'judgeSecret');

        if ($event = Model_Event::getEventByCode($eventCode)) {

            $auth = new Model_Auth();

            if ( !$auth->login($event, $judgeSecret, self::AUTH_MODE) ) {
                $this->redirect('/');
            }

            $session = Session::instance();
            $sid = $session->id();
            $id = $session->get('id');

            $hash = $this->makeHash('sha256', self::AUTH_JUDGE_SALT . $sid . self::AUTH_MODE . $id);

            Cookie::set('secret', $hash, Date::DAY);

            $this->saveSessionData($hash, $sid, $id);

            $this->redirect('voting'); // eventpage

        } else {
            $this->redirect('/');
        }

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
        Cookie::delete('a_mode');
    }

    private function saveSessionData($hash, $sid, $id) {

        $this->redis->set($hash, $sid . ':' . $id . ':' . Request::$client_ip, array('nx', 'ex' => 3600 * 24));

    }

}
