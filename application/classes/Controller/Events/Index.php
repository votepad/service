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

        $id_event = $this->request->param('id');

        $this->template->title          = 'Редактирование мероприятия';
        $this->template->description    = 'Описание страницы';
        $this->template->keywords       = 'C';


        array_push($this->css, 'css/edit-event.css');

        array_push( $this->css, 'vendor/x-editable/bootstrap3-editable/css/bootstrap-editable.css');
        array_push( $this->js,  'vendor/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js');
        array_push( $this->css, 'vendor/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css');
        array_push( $this->js,  'vendor/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js');
        array_push( $this->js,  'vendor/x-editable/inputs-ext/typeaheadjs/typeaheadjs.js');
        array_push( $this->js,  'vendor/moment/min/moment.js');
        array_push( $this->js,  'vendor/moment/min/moment-with-locales.min.js');
        array_push( $this->css, 'vendor/select2/dist/css/select2.css');
        array_push( $this->js,  'vendor/select2/dist/js/select2.full.js');

        array_push( $this->js,  'js/pjsc.js');

        $this->template->css = $this->css;
        $this->template->js = $this->js;

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('events/edit-event')
                                                ->bind('event', $event)
                                                ->bind('participants', $participants)
                                                ->bind('judges', $judges)
                                                ->bind('stages', $stages);


        /**
         * Getting Event INFO.
         */

        $event = new Model_Events();
        $event = $event->getEvent($id_event);

        /**
         * Getting Events Participant by Id
         */

        $participants = Model_Participants::getAll($id_event);

        /**
         * Getting Events Judges by id_event
         */

        $judges = Model_Judge::getAll($id_event);

        /**
         * Getting Events stages
         */

        $stages = Model_Stages::getAll($id_event);

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
        array_push( $this->js,  'vendor/jquery-validation/dist/jquery.validate.js');
        array_push( $this->js,  'vendor/combodate/combodate.js');
        array_push( $this->js,  'vendor/moment/min/moment.js');
        array_push( $this->js,  'vendor/moment/min/moment-with-locales.min.js');
        array_push( $this->js,  'js/event.js');

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('events/new-event');

        $this->template->css    = $this->css;
        $this->template->js     = $this->js;
    }
}