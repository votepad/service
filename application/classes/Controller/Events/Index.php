<?php
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 13.03.2016
 * Time: 13:01
 */

class Controller_Events_Index extends Dispatch {

    public $template = 'main';

    public function action_index()
    {
        parent::isLogged();

        $this->template->title          = 'Мои мероприятия';
        $this->template->description    = 'Описание страницы';
        $this->template->keywords       = 'C';

        $this->template->css = $this->css;
        $this->template->js = $this->js;

        $this->template->aside      = View::factory('aside');
        $this->template->section    = 'content';
    }

    public function action_edit()
    {
        parent::isLogged();

        $this->template->title          = 'Мои мероприятия';
        $this->template->description    = 'Описание страницы';
        $this->template->keywords       = 'C';


        array_push($this->css, 'css/newevent.css');
        array_push($this->css, 'css/edit-event.css');

        $this->template->css = $this->css;
        $this->template->js = $this->js;

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('events/edit-event');
    }

    public function action_new()
    {
        parent::isLogged();

        /*
         * Meta Datas
         */

        $this->template->title  ='Создать новое мероприятие';
        $this->template->description    = 'Новое мероприятие';
        $this->template->keywords       = 'SEO';

        /*
         * Styles And Templates
         */
        array_push( $this->css, 'vendor/chosen_v1.2.0/chosen.min.css');
        array_push( $this->js,  'vendor/chosen_v1.2.0/chosen.jquery.min.js');

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('events/new-event');

        $this->template->css    = $this->css;
        $this->template->js     = $this->js;
    }
}