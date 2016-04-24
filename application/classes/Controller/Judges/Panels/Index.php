<?php


class Controller_Judges_Panels_Index extends Dispatch {

    public $template = 'events/judge-panel/main';

    public function action_panel1()
    {

        $id_event = $this->request->param('id');

        $this->template->title          = 'Вид панели 1';
        $this->template->description    = 'Описание страницы';
        $this->template->keywords       = 'C';

        array_push( $this->js,  'vendor/jquery.steps/jquery.steps.js');
        array_push( $this->js,  'js/judge-panel-1.js');
        array_push( $this->css, 'css/judge-panel.css');
        array_push( $this->js,  'vendor/sweetalert/dist/sweetalert.min.js');
        array_push( $this->css, 'vendor/sweetalert/dist/sweetalert.css');
        array_push( $this->js,  'vendor/bootstrap/dist/js/bootstrap.js');
        array_push( $this->js,  'vendor/jQuery-Storage-API/jquery.storageapi.js');
        array_push( $this->js,  'js/app.js');
        


        $this->template->css    = $this->css;
        $this->template->js     = $this->js;

        $this->template->section    = View::factory('events/judge-panel/views/view-1')
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

    public function action_panel2()
    {
        $id_event = $this->request->param('id');

        $this->template->title          = 'Вид панели 2';
        $this->template->description    = 'Описание страницы';
        $this->template->keywords       = 'C';

        array_push( $this->js,  'vendor/jquery.steps/jquery.steps.js');
        array_push( $this->js,  'js/judge-panel-2.js');
        array_push( $this->css, 'css/judge-panel.css');
        array_push( $this->js,  'vendor/sweetalert/dist/sweetalert.min.js');
        array_push( $this->css, 'vendor/sweetalert/dist/sweetalert.css');
        array_push( $this->js,  'vendor/bootstrap/dist/js/bootstrap.js');
        array_push( $this->js,  'vendor/jQuery-Storage-API/jquery.storageapi.js');
        array_push( $this->js,  'js/app.js');
        

        $this->template->css    = $this->css;
        $this->template->js     = $this->js;

        $this->template->section    = View::factory('events/judge-panel/views/view-2')
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