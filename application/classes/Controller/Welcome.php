<?php

/**
<<<<<<< HEAD
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 24.04.2016
 * Time: 20:29
 */
class Controller_Welcome extends Controller_Template
=======
 * Class Controller_Welcome
 *
 * @copyright Khaydarov Murod
 * @author Turov Nikolay
 *
 * @version 0.3
 *
 */

class Controller_Welcome extends Dispatch
>>>>>>> beta
{
    public $template = 'welcome/main';

    /**
     * Welcome Page
     */
    public function action_index()
    {
        $this->template->title = "Главная | Votepad.ru";
        $this->template->description = "VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря нашему сервису подсчет результатов становится гораздо быстрее и проще. Предлагаемые инструменты включают в себя создание сценария мероприятия любой сложности, контролирование процесса выставления баллов, получение результатов сразу после проставления их экспертным жюри, формирование протокола выставленных баллов, информирование гостей о результатах мероприятия.";
        $this->template->keywords = "Электронное голосование, Экспертное жюри, Деловые игры, Мероприятия, Конкурсы, Выставление баллов, Выбор победителя, Победитель, Результат, Рейтинг, Страница с результатами, votepad, event, competition, business game, judges, rating, vote, results";
        $this->template->header = View::factory('welcome/blocks/header_home');
        $this->template->section = View::factory('welcome/landing');
        $this->template->auth_modal = View::factory('welcome/blocks/auth_modal');
    }

    /**
     * VotePad Features
     */
    public function action_features()
    {
        $this->template->title = "Возможности | Votepad.ru";
        $this->template->description = "";
        $this->template->keywords = "";
        $this->template->header = View::factory('welcome/blocks/header');
        $this->template->section = View::factory('welcome/features');
        //$this->template->auth_modal = View::factory('welcome/blocks/auth_modal');
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
