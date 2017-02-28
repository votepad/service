<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth_Organizer extends Auth {

    const AUTH_ORGANIZER_SALT = 'votepadrusalt';
    const AUTH_MODE = 'organizer';

    /**
     * Before execution parent class
     */
    public function before()
    {
        // Do not allow render
        $this->auto_render = false;
        parent::before();
    }

    public function action_auth()
    {
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
    }


}