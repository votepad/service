<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @team ProNWE team
 * @author Khaydarov Murod
 */

class Controller_Auth extends Dispatch {

    public $template = 'auth/auth';

    function action_index()
    {
        Session::instance()->destroy();
    }

    function action_signin()
    {
        $email      = Arr::get($_POST, 'email', '');
        $password   = Arr::get($_POST, 'password', '');
        $mode       = Arr::get($_GET, 'mode', '');

        /**
         * Проверяем, если поля пустые, то отправляем обратно на авторизацию
         */
        if ( empty($email) || empty($password)) {
            $this->errors = 'Something happen';
            $this->redirect('auth/');
        }

        $model_user = Model_User::Instance();
        $logIn      = $model_user->login($email, $password);

        /**
         * Если не получилось авторизоваться - обратно на Auth/
         */

        if ( !$logIn ) {
            $asJudge = Model_Judge::logInAsJudge($email, $email);

            if (count($asJudge) != 0) {
                Session::instance()->set('id_judge', $asJudge['id']);
                $this->redirect('event/' . $asJudge['id_event']. '/judge/panel'. Model_Events::EventsType($asJudge['id_event']) );
            }

            $this->redirect('auth/');
        }
        else
        {
            $id_user = $this->session->get('id_user');

            $id = Model_PrivillegedUser::getUserOrganization($id_user);

            $this->redirect('organization/' . $id);
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

    private function login($email, $password, $remember = FALSE)
    {

    }

    private function logout($email)
    {

    }

    /**
     * @todo Check form
     */
    private function checkForm()
    {

    }

}

?>