<?php defined('SYSPATH') or die('No direct script access.');

class Controller_SignUp extends Ajax
{

    function action_index()
    {
        $this->checkCsrf();

        $email      = Arr::get($_POST, 'email', '');
        $password   = Arr::get($_POST, 'password', '');
        $name       = Arr::get($_POST, 'name', '');

        if (!$email || !$password || !$name) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }


        if (Model_User::isUserExist($email)) {
            $response = new Model_Response_User('USER_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User();

        $user->email = $email;
        $user->password = $this->makeHash('md5', $password . getenv('SALT'));
        $user->name = $name;

        $user = $user->save();

        $hash = $this->makeHash('sha256', $user->id . getenv('SALT') . $user->email);
        $template = View::factory('email-templates/email-confirm', array('user' => $user, 'password' => $password, 'hash' => $hash));

        $email = new Email();
        $email = $email->send($user->email, array(getenv('INFO_EMAIL'), getenv('INFO_EMAIL_NAME')), 'Добро пожаловать в Votepad!', $template, true);

        if ($email == 1) {
            $this->redis->set(getenv('REDIS_CONFIRMATION_HASHES') . $hash, $user->id, array('nx', 'ex' => Date::DAY));
        }

        $auth = new Model_Auth();
        $auth->login($user->email, $user->password, Controller_Auth_Organizer::AUTH_MODE);

        $response = new Model_Response_User('USER_CREATE_SUCCESS', 'success',  array('id' => $user->id));
        $this->response->body(@json_encode($response->get_response()));
    }

}