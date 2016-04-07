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

}