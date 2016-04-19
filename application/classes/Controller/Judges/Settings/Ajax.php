<?php
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 17.04.2016
 * Time: 23:38
 */

class Controller_Judges_Settings_Ajax extends Ajax {

    function action_block()
    {
        /**
         * Не впускать прямые Get запросы
         */

        if ( !parent::_is_ajax())
            $this->request('/');

        $stage = Arr::get($_POST, 'stage');
        echo Model_Stages::block($stage);
    }

    public function action_getBlocked() {
        /**
         * Не впускать прямые Get запросы
         */

        if ( !parent::_is_ajax())
            $this->request('/');


        $stage = Arr::get($_POST, 'stage');
        echo Model_Stages::stageStatus($stage);
    }

    public function action_getBlockedParticipants()
    {
        $stage  = Arr::get($_POST, 'stage');
        $result = Model_Participants::getBlocked($stage);

        echo json_encode($result);
    }

}