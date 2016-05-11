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
        array_push( $this->css, 'css/auth.css');
        array_push( $this->css, 'css/ProNWE_input.css');
        array_push( $this->js, 'js/auth.js');
        
        unset( $this->css[5] );


        $this->template->css = $this->css;
        $this->template->js = $this->js;
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
            $asJudge = Model_Judge::logInAsJudge($email, $email);

            if (count($asJudge) != 0)
            {
                Session::instance()->set('id_judge', $asJudge['id']);
                $this->redirect('event/' . $asJudge['id_event']. '/judge/panel'. Model_Events::EventsType($asJudge['id_event']) );
            }

            $this->redirect('auth/');
        }

        /**
         * Удачная авторизация - перекидываем в приложение.
         */

        else {
            if ($logIn == 2)
                $this->redirect('signup/continue');
            else
                $this->redirect('events/my');
        }
    }

    function action_logout()
    {
        $model_user = Model_User::Instance();
        $model_user->logout();
        Controller::redirect('/auth');
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