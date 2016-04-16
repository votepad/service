<?php


class Controller_Judges_Settings_Index extends Dispatch {

    public $template = 'main';

    public function action_setting1()
    {
        parent::isLogged();

        $id_event = $this->request->param('id');

        $this->template->title          = 'Настройка порядка выступления участников';
        $this->template->description    = 'Описание страницы';
        $this->template->keywords       = 'Настройка порядка выступления участников';
        
        array_push( $this->js,  'vendor/jquery-ui/ui/core.js');
        array_push( $this->js,  'vendor/jquery-ui/ui/widget.js');
        array_push( $this->js,  'vendor/jquery-ui/ui/mouse.js');
        array_push( $this->js,  'vendor/jquery-ui/ui/sortable.js');
        array_push( $this->js,  'vendor/jqueryui-touch-punch/jquery.ui.touch-punch.min.js');
        array_push( $this->js,  'vendor/jquery.steps/jquery.steps.js');
        array_push( $this->css, 'css/judge-panel-1.css');
        array_push( $this->js,  'js/judge-panel-1.js');
        
        $types = Kohana::$config->load('type');
        $status = Kohana::$config->load('status');
        $city = Kohana::$config->load('city');

        $this->template->css = $this->css;
        $this->template->js = $this->js;

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('events/judge-panel/settings/setting-1')
            ->set('types', $types)
            ->set('status', $status)
            ->set('city', $city)
            ->bind('event', $event)
            ->bind('participants', $participants)
            ->bind('stages', $stages);


        /**
         * Getting Event INFO.
         */

        $event = new Model_Events();
        $event = $event->getEvent($id_event);

        /**
         * Getting Events stages
         */

        $stages = Model_Stages::getAll($id_event);


        /**
         * Getting Events Participant by Id And Ordered by Positions
         */

        for($i = 0; $i < count($stages); $i++)
        {
            $id = $stages[$i]['id'];
            $participants[] = Model_Participants::getParticipantsByPosition($event['id'], $id);
        }
    }

    public function action_setting2()
    {
        parent::isLogged();

        $id_event = $this->request->param('id');

        $this->template->title          = 'Настройка порядка выступления участников';
        $this->template->description    = 'Описание страницы';
        $this->template->keywords       = 'C';

        array_push( $this->js,  'vendor/jquery-ui/ui/core.js');
        array_push( $this->js,  'vendor/jquery-ui/ui/widget.js');
        array_push( $this->js,  'vendor/jquery-ui/ui/mouse.js');
        array_push( $this->js,  'vendor/jquery-ui/ui/sortable.js');
        array_push( $this->js,  'vendor/jqueryui-touch-punch/jquery.ui.touch-punch.min.js');
        array_push( $this->js,  'vendor/jquery.steps/jquery.steps.js');
        array_push( $this->css, 'css/judge-panel-2.css');
        array_push( $this->js,  'js/judge-panel-2.js');

        array_push( $this->js,  'vendor/bootstrap/dist/js/bootstrap.js');
        array_push( $this->js,  'vendor/jQuery-Storage-API/jquery.storageapi.js');
        array_push( $this->js,  'js/app.js');
        
    

        $types = Kohana::$config->load('type');
        $status = Kohana::$config->load('status');
        $city = Kohana::$config->load('city');

        $this->template->css = $this->css;
        $this->template->js = $this->js;

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('events/judge-panel/settings/setting-2')
            ->set('types', $types)
            ->set('status', $status)
            ->set('city', $city)
            ->bind('event', $event)
            ->bind('participants', $participants)
            ->bind('stages', $stages);

        /**
         * Getting Event INFO.
         */

        $event = new Model_Events();
        $event = $event->getEvent($id_event);
        /**
         * Getting Events stages
         */

        $stages = Model_Stages::getAll($id_event);


        /**
         * Getting Events Participant by Id And Ordered by Positions
         */

        for($i = 0; $i < count($stages); $i++)
        {
            $id = $stages[$i]['id'];
            $participants[] = Model_Participants::getParticipantsByPosition($event['id'], $id);
        }
    }
}