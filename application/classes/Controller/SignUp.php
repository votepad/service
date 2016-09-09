<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_SignUp
 * @author ProNWE team
 * @copyright Khaydarov Murod
 */

class Controller_SignUp extends Dispatch
{
    public $template = 'main';

    function action_index()
    {
        $email      = Arr::get($_POST, 'email', '');
        $password   = Arr::get($_POST, 'password', '');

        /** Disallow template rendering */
        $this->auto_render = false;

        if (!$email && !$password) {
            $this->redirect('auth/');
        }

        $user = new ORM_User();

        try {
            $user->email    = $email;
            $user->password = $password;
            
            $user->save();
        }
        catch (ORM_Validation_Exception $e) {
            echo Debug::vars($e);
        }

        $this->redirect('signup/continue');

    }
    
}