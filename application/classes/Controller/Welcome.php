<?php

/**
 * Class Controller_Welcome
 *
 * @copyright Khaydarov Murod
 * @author Turov Nikolay
 *
 * @version 0.3
 *
 */

class Controller_Welcome extends Dispatch
{
    public $template = 'welcome/main';

    /**
     * Welcome Page
     */
    public function action_index()
    {

        $canLogin = Dispatch::canLogin();

        if ($canLogin) {
            $userId = Cookie::get('uid');
            $user = new Model_User($userId);
        }

        $this->template->title = "Добро пожаловать | Votepad";
        $this->template->description = "VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря нашему сервису подсчет результатов становится гораздо быстрее и проще. Предлагаемые инструменты включают в себя создание сценария мероприятия любой сложности, контролирование процесса выставления баллов, получение результатов сразу после проставления их экспертным жюри, формирование протокола выставленных баллов, информирование гостей о результатах мероприятия.";
        $this->template->keywords = "Электронное голосование, Экспертное жюри, Деловые игры, Мероприятия, Конкурсы, Выставление баллов, Выбор победителя, Победитель, Результат, Рейтинг, Страница с результатами, votepad, event, competition, business game, judges, rating, vote, results";
        $this->template->header = View::factory('globalblocks/header')
                ->set('header_menu', View::factory('welcome/blocks/header_menu'))
                ->set('auth_modal', View::factory('globalblocks/auth_modal'));
        $this->template->section = View::factory('welcome/landing');

        if ($canLogin) {

            $this->template->auth_modal = View::factory('globalblocks/auth_modal')
                ->set('canLogin', $canLogin)
                ->set('user', $user);
        } else {

            $this->template->auth_modal = View::factory('globalblocks/auth_modal')
                ->set('canLogin', $canLogin);

        }

    }

    /**
     * VotePad Features
     */
    public function action_features()
    {
        $this->template->title = "Возможности | Votepad";
        $this->template->description = "";
        $this->template->keywords = "";
        $this->template->header = View::factory('welcome/blocks/header');
        $this->template->section = View::factory('welcome/features');
    }


    /**
     * TEMP CONTROLLERS FOR EVENT
     */
    public function action_ifse()
    {
        $this->template = View::factory('welcome/temp_events/ifse/index');
    }

    public function action_point()
    {
        $this->template = View::factory('welcome/temp_events/point/index');
    }

    public function action_mister2017()
    {
        $this->template = View::factory('welcome/temp_events/mister17/index');
    }

    public function action_pervokursnik()
    {
        $this->template = View::factory('welcome/temp_events/pervokursnik/index');
    }

    public function action_tnl()
    {
        $this->template = View::factory('welcome/temp_events/tnl/index');
    }

    public function action_miss2016()
    {
        $this->template = View::factory('welcome/temp_events/miss2016/index');
    }


}
