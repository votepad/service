<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth_Judge extends Auth {

    /**
     * Before execution parent class
     */
    public function before()
    {
        // поля без CSRF
        $exceptions = ['logout', 'resetPassword'];

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
        echo $eventCode;
        exit;
    }

}
