<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth_Judge extends Auth {

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

        if ($id = Model_Event::getEventByCode($eventCode)) {

//            $this->redirect('judge') Redirect to judge page

        }

    }

}
