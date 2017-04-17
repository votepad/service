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

        if ($id = Model_Event::getEventByCode($eventCode)) {

            $judge = Methods_Judges::getJudge($id, $judgeSecret);

            if ( !$judge ) {
                $this->redirect('welcome');
            }

            $auth = $this->completeJudgeAuth($judge);
            $hash = $this->makeHash('sha256', self::AUTH_JUDGE_SALT . $auth->id() . self::AUTH_MODE . $auth->get('j_id'));

            Cookie::set('secret', $hash, Date::DAY);
            Cookie::set('j_id', $auth->get('j_id'), Date::DAY);
            Cookie::set('sid', $auth->id(), Date::DAY);

            $this->saveSessionData($hash, $auth->id(), $auth->get('j_id'));

            $this->redirect('eventpage'); // eventpage

        } else {
            $this->redirect('welcome');
        }

    }

    private function completeJudgeAuth($judje) {

        $session = Session::instance();
        $session->set('j_id', $judje->id);
        $session->set('j_name', $judje->name);
        $session->set('j_event', $judje->event);

        return $session;

    }

    private function saveSessionData($hash, $sid, $j_id) {

        $this->redis->set($hash, $sid . ':' . $j_id . ':' . Request::$client_ip, array('nx', 'ex' => 3600 * 24));

    }

}
