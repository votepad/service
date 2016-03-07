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

    }

    function action_continue()
    {
        /*
         * CSS
         */
        array_push( $this->css, 'css/font-awesome.min.css');
        array_push( $this->css, 'vendor/whirl/dist/whirl.css');
        array_push( $this->css, 'vendor/animate.css/animate.min.css');
        array_push( $this->css, 'vendor/cropper/dist/cropper.css');
        array_push( $this->css, 'css/bootstrap.css');
        array_push( $this->css, 'css/app.css');
        array_push( $this->css, 'css/pronwe.css');

        /*
         * Javascript
         */

        array_push( $this->js, 'vendor/jquery/dist/jquery.js');
        array_push( $this->js, 'vendor/bootstrap/dist/js/bootstrap.js');
        array_push( $this->js, 'vendor/jQuery-Storage-API/jquery.storageapi.js');
        array_push( $this->js, 'vendor/jquery-localize-i18n/dist/jquery.localize.js');
        array_push( $this->js, 'vendor/cropper/dist/cropper.js');
        array_push( $this->js, 'js/app.js');
        array_push( $this->js, 'js/twitter.js');
        array_push( $this->js, 'http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU');


        $this->template->css = $this->css;
        $this->template->js = $this->js;
        $this->template->assets = $this->assets;

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