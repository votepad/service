<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth_Organizer extends Auth {

    const AUTH_ORGANIZER_SALT = 'votepadrusalt';
    const AUTH_MODE = 'organizer';

    /**
     * Before execution parent class
     */
    public function before()
    {
        // check CSRF
        $this->checkCsrf();

        // Do not allow render
        $this->auto_render = false;
        parent::before();
    }

    public function action_auth()
    {
        if ( isset($_POST['recover']) ) {

            $uid = $this->recover();

            // Если сессия была уничтожена или хэш не совпал
            if (!$uid) {
                $this->clearCookie();
            }

            // редирект на профиль
            $this->redirect('/user/' . $uid);

        } else if ( isset($_POST['logout'])) {

            $this->clearCookie();
            $this->session->destroy();

            $this->redirect('/');

        }

        $email      = Arr::get($_POST, 'email', '');
        $password   = Arr::get($_POST, 'password', '');
        $remember   = false;

        if ( empty($email) || empty($password)) {
            $this->makeAttempt();
            $this->redirect('/');
        }

        $user = new Model_Auth();

        if (!$user->login($email, $password, $remember)) {
            $this->makeAttempt();
            $this->redirect('/');
        }

        $session = Session::instance();
        $sid = $session->id();
        $uid = $session->get('uid');

        $hash = $this->makeHash('sha256', self::AUTH_ORGANIZER_SALT . $sid . self::AUTH_MODE . $uid);

        Cookie::set('secret', $hash, DATE::DAY);

        $this->saveSessionData($hash, $sid, $uid);

        $this->redirect('/user/'.$uid);

    }

    /**
     * Check session token (make secret from Cookie data)
     *
     * @return null|string
     */
    private function recover()
    {
        $uid    = Cookie::get('uid');
        $sid    = Cookie::get('sid');
        $secret = Cookie::get('secret');

        $hash = $this->makeHash('sha256', self::AUTH_ORGANIZER_SALT . $sid . self::AUTH_MODE . $uid);

        if ($this->redis->get($hash)) {
            return $uid;
        }

        return NULL;
    }

    private function clearCookie()
    {
        Cookie::delete('sid');
        Cookie::delete('uid');
        Cookie::delete('secret');
    }

    /**
     * save session in Redis server
     *
     * @param $hash - secret code
     * @param $sid - session id
     * @param $uid - user id
     */
    private function saveSessionData($hash, $sid, $uid)
    {
        $this->redis->set($hash, $sid . ':' . $uid . ':' . Request::$client_ip, array('nx', 'ex' => 3600 * 24));
    }


}