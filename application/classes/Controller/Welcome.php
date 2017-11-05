<?php

/**
 * Class Controller_Welcome
 *
 * @copyright Votepad Team
 *
 * @author Khaydarov Murod
 * @author Turov Nikolay
 *
 * @version
 *
 */

class Controller_Welcome extends Dispatch
{
    public $template = 'welcome/main';

    public function before()
    {
        parent::before();

        $this->template->title = "Добро пожаловать";
        $this->template->description = "Votepad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря нашему сервису подсчет результатов становится гораздо быстрее и проще. Предлагаемые инструменты включают в себя создание сценария мероприятия любой сложности, контролирование процесса выставления баллов, получение результатов сразу после проставления их экспертным жюри, информирование гостей о результатах мероприятия.";
        $this->template->keywords = "Электронное голосование, Экспертное жюри, Деловые игры, Мероприятия, Конкурсы, Выставление баллов, Выбор победителя, Победитель, Результат, Рейтинг, Страница с результатами, votepad, event, competition, business game, judges, rating, vote, results";

    }

    /**
     * Welcome Page
     */
    public function action_index()
    {
        $events = Methods_Events::getAllByType(1);

        $this->template->header = 'welcome';
        $this->template->section = View::factory('welcome/pages/landing')
                ->set('events', $events);
    }

    public function action_agreement()
    {
        $this->template->title = "Согласие на обработку персональных данных";
        $this->template->header = 'global';
        $this->template->section = View::factory('welcome/pages/agreement');
    }


}
