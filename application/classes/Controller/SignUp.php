<?php defined('SYSPATH') or die('No direct script access.');

class Controller_SignUp extends Dispatch
{
    public $template = 'main';

    function action_index()
    {
        $email      = Arr::get($_POST, 'email', '');
        $password   = Arr::get($_POST, 'password', '');
        $name       = Arr::get($_POST, 'name', '');

        $user = new Model_User();

        $user->email = $email;
        $user->password = $password;
        $user->name = $name;

        $user->save();

        $auth = new Model_Auth();

        if ($auth->login($email, $password)) {

            $this->redirect('/user/'.$user->id);

        };

        /**
         * TODO: Email - Validation
         */

    }
}