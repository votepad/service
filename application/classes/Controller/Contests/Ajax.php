<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contests_Ajax extends Ajax
{

    public function action_create()
    {
        $event        = Arr::get($_POST, 'event');
        $name         = Arr::get($_POST, 'name');
        $description  = Arr::get($_POST, 'description');
        $formula      = Arr::get($_POST, 'formula');
        $judges       = Arr::get($_POST, 'judges');

        if (empty($name) || empty($description) || empty($formula) || empty($judges)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $contest = new Model_Contest();

        $contest->name        = $name;
        $contest->event       = $event;
        $contest->description = $description;
        $contest->formula     = $formula;

        $contest = $contest->save();

        Methods_Contests::saveJudges($contest->id, $judges);

        $response = new Model_Response_Contest('CONTEST_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_update()
    {
        $id          = Arr::get($_POST, 'id');
        $event       = Arr::get($_POST, 'event');
        $name        = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $judges      = Arr::get($_POST, 'judges');
        $formula     = Arr::get($_POST, 'formula');

        if (empty($name) || empty($description) || empty($formula) || empty($judges)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $contest = new Model_Contest($id);

        if (!$contest->id) {
            $response = new Model_Response_Contest('CONTEST_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($contest->event != $event) {
            $response = new Model_Response_Contest('CONTEST_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $contest->name = $name;
        $contest->description = $description;
        $contest->formula = $formula;
        $contest = $contest->update();

        Methods_Contests::updateJudges($contest->id, $judges);

        $contest->formula = Methods_Stages::getJSONbyFormula($contest->formula);
        $contest->judges  = Methods_Contests::getJudges($contest->id);

        $contestBlock = View::factory('events/blocks/scenario-contest-block', array('contest' => $contest))->render();

        $response = new Model_Response_Contest('CONTEST_UPDATE_SUCCESS', 'success', array('contest' => $contestBlock));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_delete()
    {
        $id       = Arr::get($_POST, 'id');
        $event    = Arr::get($_POST, 'event');

        $contest = new Model_Contest($id);

        if (!$contest->id) {
            $response = new Model_Response_Contest('CONTEST_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($contest->event != $event) {
            $response = new Model_Response_Contest('CONTEST_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Methods_Contests::removeAllJudges($contest->id);
        $contest->delete();

        $response = new Model_Response_Contest('CONTEST_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

}