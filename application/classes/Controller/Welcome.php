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

    /*
     * Welcome Page
    */
    public function action_index()
    {
        $this->template->title = "Главная | VotePad.ru";
        $this->template->description = "VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря нашему сервису подсчет результатов становится гораздо быстрее и проще. Предлагаемые инструменты включают в себя создание сценария мероприятия любой сложности, контролирование процесса выставления баллов, получение результатов сразу после проставления их экспертным жюри, формирование протокола выставленных баллов, информирование гостей о результатах мероприятия.";
        $this->template->keywords = "Электронное голосование, Экспертное жюри, Деловые игры, Мероприятия, Конкурсы, Выставление баллов, Выбор победителя, Победитель, Результат, Рейтинг, Страница с результатами, votepad, event, competition, business game, judges, rating, vote, results";
        $this->template->header = View::factory('welcome/blocks/header_home');
        $this->template->section = View::factory('welcome/landing');
    }

    /*
     * VotePad Features
    */
    public function action_features()
    {
        $this->template->title = "Возможности | VotePad.ru";
        $this->template->description = "";
        $this->template->keywords = "";
        $this->template->header = View::factory('welcome/blocks/header');
        $this->template->section = View::factory('welcome/features');
    }
}
