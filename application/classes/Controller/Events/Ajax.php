<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Events_Ajax
 * @author Pronwe Team
 * @copyright Khaydarov Murod
 */

class Controller_Events_Ajax extends Ajax {

    /**
     * @return object - True or False when event is removed
     */
    public function action_deleteEvent()
    {
        /** No access for non-ajax requests */

        if ( !parent::_is_ajax())
            $this->request('/');

        $id = Arr::get($_POST, 'id');
        return Model_Events::delete($id);
    }

    /**
     * @return [Boolean] - True or False
     */
    public function action_updateEventInfo()
    {
        /** No access for non-ajax requests */

        if ( !parent::_is_ajax())
            $this->request('/');

        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        return Model_Events::updateEventByFieldName($name, $value, $id);
    }

    /**
     * @return [Boolean] - True or False
     */
    public function action_updateParticipant()
    {
        /** No access for non-ajax requests */

        if ( !parent::_is_ajax())
            $this->request('/');

        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        return Model_Participants::updateParticipantByFieldName($name, $value, $id);

    }

    public function action_updateJudge()
    {
        /** No access for non-ajax requests */

        if ( !parent::_is_ajax())
            $this->request('/');



        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        echo Model_Judge::updateJudgeByFieldName($name, $value, $id);
    }

    public function action_updateStage()
    {
        /** No access for non-ajax requests */

        if ( !parent::_is_ajax())
            $this->request('/');

        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        echo Model_Stages::updateStageByFieldName($name, $value, $id);
    }

    public function action_updateCriteria()
    {
        /** No access for non-ajax requests */

        if ( !parent::_is_ajax())
            $this->request('/');

        $name   = Arr::get($_POST, 'name');  // Column name
        $value  = Arr::get($_POST, 'value');
        $id     = Arr::get($_POST, 'pk');

        echo Model_Stages::updateCriteriaByFieldName($name, $value, $id);
    }

    public function action_deleteEventsSubstance()
    {
        /** No access for non-ajax requests */

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