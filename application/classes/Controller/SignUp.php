<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 07.03.2016
 * Time: 22:50
 */

class Controller_SignUp extends Dispatch
{
    public $template = 'auth/continue-registration';

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

    function action_continue()
    {
        /*
         * CSS
         */

        $this->template->css = $this->css;
        $this->template->js = $this->js;

    }

    function action_save()
    {
        $lastname   = Arr::get($_POST, 'lastname');
        $name       = Arr::get($_POST, 'name');
        $surname    = Arr::get($_POST, 'surname');
        $sex        = Arr::get($_POST, 'sex');
        $phone      = Arr::get($_POST, 'number');
        $country    = Arr::get($_POST, 'country');
        $city       = Arr::get($_POST, 'city');

        $model_user = Model_User::Instance();

        $model_user->signUpContinue(
                                    $lastname,
                                    $name,
                                    $surname,
                                    $sex,
                                    $phone,
                                    $country,
                                    $city
            );

        $this->redirect('profile');
    }
}