<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 14.03.2016
 * Time: 23:11
 */

class Controller_Events_Ajax extends Ajax {

    public function action_index()
    {
        echo 'Method is: '. __METHOD__;
    }

    public function action_deleteEvent()
    {
        /**
        * Не впускать прямые Get запросы
        */

        if ( !parent::_is_ajax())
            $this->request('/');

        $id = Arr::get($_POST, 'id');
        return Model_Events::delete($id);
    }

    public function action_updateEventInfo()
    {
        /**
         * Не впускать прямые Get запросы
         */

        if ( !parent::_is_ajax())
            $this->request('/');

        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        echo Model_Events::updateEventByFieldName($name, $value, $id);
    }

    public function action_updateParticipant()
    {
        /**
         * Не впускать прямые Get запросы
         */

        if ( !parent::_is_ajax())
            $this->request('/');

        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        echo Model_Participants::updateParticipantByFieldName($name, $value, $id);

    }

    public function action_updateJudge()
    {
        /**
         * Не впускать прямые Get запросы
         */

        if ( !parent::_is_ajax())
            $this->request('/');



        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        echo Model_Judge::updateJudgeByFieldName($name, $value, $id);
    }

    public function action_updateStage()
    {
        /**
         * Не впускать прямые Get запросы
         */

        if ( !parent::_is_ajax())
            $this->request('/');

        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        echo Model_Stages::updateStageByFieldName($name, $value, $id);
    }

    public function action_updateCriteria()
    {
        /**
         * Не впускать прямые Get запросы
         */

        if ( !parent::_is_ajax())
            $this->request('/');

        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        echo Model_Stages::updateCriteriaByFieldName($name, $value, $id);
    }

    public function action_deleteEventsSubstance()
    {
        /**
         * Не впускать прямые Get запросы
         */

        $substance  = Arr::get($_POST, 'substance');
        $id         = Arr::get($_POST, 'id');

        if ($substance == 'delparticipant')
            Model_Participants::deleteParticipantById($id);

        if ($substance == 'deljudge')
            Model_Judge::deleteJudgesById($id);

        if ($substance == 'delstage')
            Model_Stages::deleteStagesById($id);

        if ($substance == 'delcriteria')
            Model_Stages::deleteCriteria($id);

        return 1;

    }

    public function action_participantposition()
    {
        $id_event       = Arr::get($_POST, 'id_event');
        $id_stage       = Arr::get($_POST, 'stage');
        $id_participant = Arr::get($_POST, 'participant');
        $position       = Arr::get($_POST, 'position');

        Model_Participants::setPosition($id_event, $id_stage, $id_participant, $position);
    }

}