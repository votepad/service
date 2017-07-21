<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Class Controller_Profiles_Ajax
 *
 * @copyright Votepad Team
 * @author Turov Nikolay
 * @version 0.2.0
 */

class Controller_Profiles_Ajax extends Ajax
{

    public function action_update()
    {
        $this->checkCsrf();

        $name = Arr::get($_POST,'name');
        $email = Arr::get($_POST,'email');
        $phone = Arr::get($_POST,'phone');
        $private = Arr::get($_POST,'private');

        if ($this->user->name == $name && $this->user->email == $email && $this->user->phone == $phone && $this->user->private == $private) {
            $response = new Model_Response_Form('NOTHING_CHANGE_WARING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::phone($phone,12)) {
            $response = new Model_Response_User('PATIENTS_UPDATE_SUCCESS', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $change_email = $this->user->email != $email;

        $this->user->name = $name;
        $this->user->email = $email;
        $this->user->phone = $phone;
        $this->user->private = $private;

        if ($change_email) {

            if (Model_User::isUserExist($email)) {
                $response = new Model_Response_User('USER_EXISTED_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

            $this->user->isConfirmed = 0;
        }

        $this->user->update();

        if ($change_email) {
            $this->confirm_email();
            $response = new Model_Response_User('USER_UPDATE_EMAIL_CHANGE_SUCCESS', 'success');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $response = new Model_Response_User('USER_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_changepassword()
    {
        $this->checkCsrf();

        $oldPassword  = Arr::get($_POST, 'oldPassword');
        $newPassword  = Arr::get($_POST, 'newPassword');
        $newPassword1 = Arr::get($_POST, 'newPassword1');

        if (!$this->user->checkPassword($oldPassword)) {
            $response = new Model_Response_User('USER_PASSWORD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($oldPassword == $newPassword) {
            $response = new Model_Response_User('USER_SAME_PASSWORDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($newPassword != $newPassword1) {
            $response = new Model_Response_User('USER_PASSWORDS_ARE_NOT_EQUAL_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $this->user->changePassword($newPassword);

        $response = new Model_Response_User('USER_PASSWORD_CHANGE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }

    public function action_confirmemail()
    {
        $this->confirm_email();
    }

    private function confirm_email()
    {
        $hash = $this->makeHash('sha256', $this->user->id . $_SERVER['SALT'] . $this->user->email);

        $template = View::factory('email-templates/email-confirm2', array('user' => $this->user, 'hash' => $hash));

        $email = new Email();
        $email = $email->send($this->user->email, $_SERVER['INFO_EMAIL'], 'Потверждение эл.почты', $template, true);

        if ($email == 1) {
            $this->redis->set($_SERVER['REDIS_CONFIRMATION_HASHES'] . $hash, $this->user->id, array('nx', 'ex' => Date::DAY));
            $response = new Model_Response_Email('EMAIL_SEND_SUCCESS', 'success');
        } else {
            $response = new Model_Response_Email('EMAIL_SEND_ERROR', 'error');
        }

        $this->response->body(@json_encode($response->get_response()));
    }
}
