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

    function action_continue()
    {
        parent::isLogged();

        $this->template->title          = 'Продолжение регистрации';
        $this->template->description    = 'Описание страницы';
        $this->template->keywords       = 'C';

        $city = Kohana::$config->load('city');
        $gender = Kohana::$config->load('gender');

        array_push( $this->js,  'vendor/bootstrap/dist/js/bootstrap.js');
        array_push( $this->js,  'vendor/jQuery-Storage-API/jquery.storageapi.js');
        array_push( $this->js,  'js/app.js');

        $this->template->css = $this->css;
        $this->template->js = $this->js;

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('auth/continregistr')   
                                                ->bind('cities', $cities);

        $model_user = Model_User::Instance();
        $cities = $model_user->getCities();
    }

    function action_save()
    {
        $lastname   = Arr::get($_POST, 'lastname');
        $name       = Arr::get($_POST, 'name');
        $surname    = Arr::get($_POST, 'surname');
        $phone      = Arr::get($_POST, 'number');
        $sex        = Arr::get($_POST, 'sex');
        $city       = Arr::get($_POST, 'city');
        $avatar     = $_FILES['avatar']['name'] ?: 'no-user.png';

        Model_Uploader::fileTransport($_FILES, 'avatar');
        $model_user = Model_User::Instance();
        
        $model_user->signUpContinue(
                                    $lastname,
                                    $name,
                                    $surname,
                                    $sex,
                                    $phone,
                                    $city,
                                    $avatar
            );

        $this->redirect('events/my');
    }
}