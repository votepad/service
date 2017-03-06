<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 07.03.2016
 * Time: 22:50
 */

class Controller_SignUp extends Dispatch
{
    public $template = 'main';

    function action_index()
    {
        $email = Arr::get($_POST, 'email', '');
        $password = Arr::get($_POST, 'password', '');

        /**
         * TODO: Email - Validation
         */

        $model_user = Model_User::Instance();
        $model_user->signUp($email, $password);

        $this->redirect('signup/continue');

    }
}