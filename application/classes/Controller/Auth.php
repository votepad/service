<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @author ProNWE team
 * @copyright Khaydarov Murod
 */

class Controller_Auth extends Dispatch {

    public $template = 'auth/auth';

    protected $model = null;

    function action_index()
    {

        array_push( $this->css, 'css/auth.css');
        array_push( $this->css, 'css/ProNWE_input.css');
        array_push( $this->js, 'js/auth.js');
        
        unset( $this->css[5] );


        $this->template->css = $this->css;
        $this->template->js  = $this->js;
    }

    function action_signin()
    {
        $email      = Arr::get($_POST, 'email', '');
        $password   = Arr::get($_POST, 'password', '');

        $this->model = new Model_Auth();

        /**
         * If fields are empty
         */
        if ( empty($email) || empty($password)) {
            $this->redirect('auth/');
        }

        $auth = $this->login($email, $password);

        if (!$auth)
        {
            $this->redirect('auth/');
        }
        else
        {
            if (!$auth['done'])
                $this->redirect('signup/continue');
            else
                $this->redirect('events/my');
        }


        $this->auth_render = false;
    }
    
    private function login($email, $password, $remember = FALSE)
    {
        return $this->model->login($email, $password);
    }

    private function action_logout($email)
    {
        return $this->model->logout($email, FALSE);
    }

}

?>