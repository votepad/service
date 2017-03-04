<?php

/**
 * Class Controller_Profile
 * @author Votepad Team
 * @copyright Turov Nikolay
 * @version 0.1.0
 */

class Controller_Profile extends Dispatch
{
    public $template = 'profile/main';

    /**
     * Welcome Page
     */
    public function action_index()
    {

        $id = $this->request->param('id');

        $user = new Model_User($id);

        if (!$user->id) {
            throw new HTTP_Exception_404();
        }



        $this->template->user = $user;

        $this->template->header = View::factory('profile/blocks/header')
            ->set('auth_modal', View::factory('welcome/blocks/auth_modal'))
            ->set('user', $user);
        $this->template->footer = View::factory('profile/blocks/footer');
        $this->template->jumbotron_wrapper = View::factory('profile/blocks/jumbotron_wrapper', array('user' => $user));


        /*$this->template->title = "Главная | Votepad.ru";
        $this->template->description = "VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря нашему сервису подсчет результатов становится гораздо быстрее и проще. Предлагаемые инструменты включают в себя создание сценария мероприятия любой сложности, контролирование процесса выставления баллов, получение результатов сразу после проставления их экспертным жюри, формирование протокола выставленных баллов, информирование гостей о результатах мероприятия.";
        $this->template->keywords = "Электронное голосование, Экспертное жюри, Деловые игры, Мероприятия, Конкурсы, Выставление баллов, Выбор победителя, Победитель, Результат, Рейтинг, Страница с результатами, votepad, event, competition, business game, judges, rating, vote, results";

        $this->template->section = View::factory('welcome/landing');*/

    }

    public function action_update()
    {
        $id = $this->request->param('id');

        $user = new Model_User($id);

        if (!$user->id) {
            throw new HTTP_Exception_404();
        }

        $user->name = Arr::get($_POST, 'name', $user->name);
        $user->surname = Arr::get($_POST, 'surname', $user->surname);
        $user->lastname = Arr::get($_POST, 'lastname', $user->lastname);

        if (Arr::get($_POST, 'email', $user->email) != $user->email) {
            $user->email = Arr::get($_POST, 'email');
            $user->isConfirmed = 0;
        }

        $user->phone = Arr::get($_POST, 'phone', $user->phone);

        $user->update();

        if (Arr::get($_POST, 'newpassword') && Arr::get($_POST, 'newpassword2')) {

            $oldpass = Arr::get($_POST, 'oldpassword');
            $newpass1 = Arr::get($_POST, 'newpassword');
            $newpass2 = Arr::get($_POST, 'newpassword2');

            if ($newpass1 != $newpass2) {
                echo ('pass1 != pass2');
                return;
            }

            if (!$user->checkPassword($oldpass)) {
                echo 'Invalid pass';
                return;
            }

            $user->changePassword($newpass1);

        }

        $this->redirect('user/'.$id);

    }

}
