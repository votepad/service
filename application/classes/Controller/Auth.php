<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 22.02.2016
 * Time: 12:32
 */

class Controller_Auth extends Dispatch {

    public $template = 'auth/auth';

    function action_index()
    {
        array_push( $this->css, 'css/font-awesome.min.css');
        array_push( $this->css, 'css/ownPronwe.css');
        array_push( $this->css, 'css/auth.css');


        $this->template->css = $this->css;
        $this->template->js = $this->js;
        $this->template->assets = $this->assets;
    }

    function action_signin()
    {
        $email = Arr::get($_POST, 'email', '');
        $password = Arr::get($_POST, 'password', '');


        /**
         * Проверяем, если поля пустые, то отправляем обратно на авторизацию
         */
        if ( empty($email) || empty($password)) {
            $this->errors = 'Something happen';
            $this->redirect('auth/');
        }

        $model_user = Model_User::Instance();
        $logIn = $model_user->login($email, $password);

        /**
         * Если не получилось авторизоваться - обратно на Auth/
         */

        if ( !$logIn ) {
            $this->redirect('auth/');
        }

        /**
         * Удачная авторизация - перекидываем в приложение.
         */

        else {
            if ($logIn == 2)
                $this->redirect('signUp/continue');
            else
                $this->redirect('profile');
        }
    }

    function action_vk()
    {

    }

    function action_facebook()
    {

    }

    function action_twitter()
    {

    }


    /*
     * Продолжение регистрации
     */

}

?>