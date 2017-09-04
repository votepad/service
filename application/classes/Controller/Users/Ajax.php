<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Class Controller_Users_Ajax
 *
 * @copyright Votepad Team
 * @author Turov Nikolay
 * @version 0.2.0
 */

class Controller_Users_Ajax extends Ajax
{

    public function action_update()
    {
        $this->checkCsrf();

        $name = Arr::get($_POST,'name');
        $email = Arr::get($_POST,'email');
        $phone = Arr::get($_POST,'phone');
        $private = Arr::get($_POST,'private');

        if ($this->user->name == $name && $this->user->email == $email && $this->user->phone == $phone && $this->user->private == $private) {
            $response = new Model_Response_Form('NOTHING_CHANGE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($phone != "" && !Valid::phone($phone,12)) {
            $response = new Model_Response_User('USER_PHONE_ERROR', 'error');
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

            $this->user->is_confirmed = 0;
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
        $hash = $this->makeHash('sha256', $this->user->id . getenv('SALT') . $this->user->email);

        $template = View::factory('email-templates/email-confirm2', array('user' => $this->user, 'hash' => $hash));

        $email = new Email();
        $email = $email->send($this->user->email, array(getenv('INFO_EMAIL'), getenv('INFO_EMAIL_NAME')), 'Потверждение эл.почты', $template, true);

        if ($email == 1) {
            $this->redis->set(getenv('REDIS_CONFIRMATION_HASHES') . $hash, $this->user->id, array('nx', 'ex' => Date::DAY));
            $response = new Model_Response_Email('EMAIL_SEND_SUCCESS', 'success');
        } else {
            $response = new Model_Response_Email('EMAIL_SEND_ERROR', 'error');
        }

        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     *
     */
    public function action_forgetpassword()
    {
        $this->checkCsrf();

        $email = Arr::get($_POST,'email');

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        // TODO check recaptcha

        $user = Model_User::getByEmail($email);

        if (!$user->id) {
            $response = new Model_Response_User('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $hash = $this->makeHash('sha256', $user->id . getenv('SALT') . $user->email);
        $template = View::factory('email-templates/reset-password', array('user' => $user, 'hash' => $hash));

        $email = new Email();
        $email = $email->send($user->email, array(getenv('INFO_EMAIL'), getenv('INFO_EMAIL_NAME')), 'Восстановление пароля', $template, true);

        if ($email == 1) {
            $this->redis->set(getenv('REDIS_RESET_HASHES') . $hash, $user->id, array('nx', 'ex' => Date::HOUR));
            $response = new Model_Response_Email('EMAIL_SEND_SUCCESS', 'success');
        } else {
            $response = new Model_Response_Email('EMAIL_SEND_ERROR', 'error');
        }
        $this->response->body(@json_encode($response->get_response()));
    }


    /**
     * Reset Password if hash is valid
     * @throws HTTP_Exception_400
     */
    public function action_resetpassword() {

        $hash = Arr::get($_POST,'hash');
        $id = $this->redis->get(getenv('REDIS_RESET_HASHES') . $hash);

        if (!$id) {
            throw new HTTP_Exception_400();
        }

        if (isset($_POST['reset'])) {
            $newPassword1 = Arr::get($_POST,'password1');
            $newPassword2 = Arr::get($_POST,'password2');

            if ($newPassword1 != $newPassword2) {
                $response = new Model_Response_User('USER_PASSWORDS_ARE_NOT_EQUAL_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

            $user = new Model_User($id);

            if (!$user->id) {
                $response = new Model_Response_User('USER_DOES_NOT_EXISTED_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

            if ($user->checkPassword($newPassword1)) {
                $response = new Model_Response_User('USER_SAME_PASSWORDS_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

            $user->changePassword($newPassword1);

            $auth = new Model_Auth();
            $auth->login($user->email, $newPassword1, Controller_Auth_Organizer::AUTH_MODE);

            $response = new Model_Response_User('USER_RESET_PASSWORD_SUCCESS', 'success', array('id' => $user->id));

        } else {

            $response = new Model_Response_User('USER_RESET_PASSWORD_CANCEL_SUCCESS', 'success');

        }

        $this->redis->delete(getenv('REDIS_RESET_HASHES') . $hash);

        $this->response->body(@json_encode($response->get_response()));
        return;

    }

}
