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

    /** @todo FIle transport */
    function action_continue()
    {
        if (!parent::isLogged()) {
            Controller::redirect('auth/');
        }


        if ($this->request->method() == self::POST){

            $user = new ORM_User();
            $user->where('id', '=', $this->_session->get('id_user'))
                ->find();

            if ($user->loaded())
            {
                $user->lastname   = Arr::get($_POST, 'lastname', '');
                $user->name       = Arr::get($_POST, 'name', '');
                $user->surname    = Arr::get($_POST, 'surname', '');
                $user->phone      = Arr::get($_POST, 'number', '');
                $user->sex        = Arr::get($_POST, 'sex', '');
                $user->city       = Arr::get($_POST, 'city', '');
                $user->avatar     = $_FILES['avatar']['name'] ?: 'no-user.png';

                $user->save();
            }

        } else {

            $this->template->title          = 'Продолжение регистрации';
            $this->template->description    = 'Продолжение регистрации на сайте Pronwe.ru';
            $this->template->keywords       = 'Продолжение регистрации на сайте Pronwe.ru';

            array_push( $this->js,  'vendor/bootstrap/dist/js/bootstrap.js');
            array_push( $this->js,  'vendor/jQuery-Storage-API/jquery.storageapi.js');
            array_push( $this->js,  'js/app.js');

            $this->template->css = $this->css;
            $this->template->js  = $this->js;

            $this->template->aside      = View::factory('aside');
            $this->template->section    = View::factory('auth/continregistr');

        }

    }
}