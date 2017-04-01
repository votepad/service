<?php

/**
 * Class Controller_Profile
 *
 * @copyright Votepad Team
 * @author Turov Nikolay
 * @version 0.1.0
 */

class Controller_Profile extends Dispatch
{
    public $template = 'main';

    private $profile = null;

    public function before()
    {

        parent::before();

        $id = $this->request->param('id');
        $profile = new Model_User($id);

        if (!$id || !$profile->id) {
            throw new HTTP_Exception_404();
        }

        $this->profile = $profile;

        /** Meta data */
        $this->template->title       = $profile->name. ' ' . $profile->surname;
        $this->template->description = "Просмотреть профиль " . $profile->name. ' ' . $profile->surname . " на сайте votepad.ru. VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря Votepad становиться проще и быстрее провести подсчет результатов!";
        $this->template->keywords    = "Профиль, Электронное голосование, Выставление баллов, Результат, Рейтинг, Страница с результатами, votepad, profile, voting, results, rating";


        $this->template->header = View::factory('globalblocks/header')
            ->set('header_menu', View::factory('profile/blocks/header_menu'))
            ->set('header_menu_mobile', View::factory('profile/blocks/header_menu_mobile'));

    }

    /**
     * Welcome Page
     */
    public function action_index()
    {
        $isProfileOwner = !empty($this->session->get('uid'))
            && $this->session->get('uid') == $this->request->param('id');

        $this->template->mainSection = View::factory('profile/content')
            ->set('isProfileOwner', $isProfileOwner)
            ->set('profile', $this->profile);
    }

    public function action_update()
    {
        $this->profile->name = Arr::get($_POST, 'name', $this->profile->name);
        $this->profile->surname = Arr::get($_POST, 'surname', $this->profile->surname);
        $this->profile->lastname = Arr::get($_POST, 'lastname', $this->profile->lastname);
        $email = Arr::get($_POST, 'email');

        if ($email != $this->profile->email) {
            $this->profile->email = $email;
            $this->profile->isConfirmed = 0;
        }

        $this->profile->phone = Arr::get($_POST, 'phone', $this->profile->phone);

        $this->profile->update();

        if (Arr::get($_POST, 'newpassword') && Arr::get($_POST, 'newpassword2')) {

            $oldpass = Arr::get($_POST, 'oldpassword');
            $newpass1 = Arr::get($_POST, 'newpassword');
            $newpass2 = Arr::get($_POST, 'newpassword2');

            if ($newpass1 != $newpass2) {
                $response = new Model_Response_Auth('PASSWORDS_ARE_NOT_EQUAL_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

            if (!$this->profile->checkPassword($oldpass)) {
                $response = new Model_Response_Auth('INVALID_INPUT_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

            $this->profile->changePassword($newpass1);

        }

        $this->redirect('user/' . $this->profile->id);

    }

}
