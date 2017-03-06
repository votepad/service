<?php defined('SYSPATH') or die('No direct script access.');

class Controller_SignUp extends Dispatch
{
    public $template = 'main';

    function action_index()
    {
        $this->auto_render = false;

        if (!$this->request->is_ajax()) {

            return;

        }


        $email      = Arr::get($_POST, 'email', '');
        $password   = Arr::get($_POST, 'password', '');
        $name       = Arr::get($_POST, 'name', '');


        if (!$email || !$password || !$name) {

            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');

            $this->response->body(@json_encode($response->get_response()));
            return;

        }


        if (!$email || Model_User::isUserExist($email)) {

            $response = new Model_Response_SignUp('USER_EXISTS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;

        }

        $user = new Model_User();

        $user->email = $email;
        $user->password = $password;
        $user->name = $name;

        $user->save();

        $auth = new Model_Auth();

        if ($auth->login($email, $password)) {

            $response = new Model_Response_SignUp('SIGNUP_SUCCESS', 'success',  array('id' => $user->id));
            $this->response->body(@json_encode($response->get_response()));

        };

        /**
         * TODO: Email - Validation
         */

    }

}