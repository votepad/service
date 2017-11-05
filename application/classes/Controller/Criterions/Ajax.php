<?php

/**
 * Class Controller_Criterions_Ajax
 */
class Controller_Criterions_Ajax extends Ajax
{

    public function action_create()
    {
        $event       = Arr::get($_POST, 'event');
        $name        = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $minScore    = (int)Arr::get($_POST, 'minScore', 0);
        $maxScore    = (int)Arr::get($_POST, 'maxScore');

        if (empty($name) || empty($maxScore)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($minScore >= $maxScore) {
            $response = new Model_Response_Criterion('CRITERION_MIN_LARGE_MAX_SUCCESS', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $criterion = new Model_Criterion();

        $criterion->name        = $name;
        $criterion->event       = $event;
        $criterion->description = $description;
        $criterion->minScore    = $minScore;
        $criterion->maxScore    = $maxScore;
        $criterion = $criterion->save();

        $response = new Model_Response_Criterion('CRITERION_CREATE_SUCCESS', 'success', array('criterion' => $criterion));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_update()
    {
        $id          = Arr::get($_POST, 'id');
        $event       = Arr::get($_POST, 'event');
        $name        = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $minScore    = Arr::get($_POST, 'minScore');
        $maxScore    = Arr::get($_POST, 'maxScore');

        if (empty($name) || empty($minScore) || empty($maxScore)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }
        
        if ($minScore >= $maxScore) {
            $response = new Model_Response_Criterion('CRITERION_MIN_LARGE_MAX_SUCCESS', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $criterion = new Model_Criterion($id);

        if (!$criterion->id) {
            $response = new Model_Response_Criterion('CRITERION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($criterion->event != $event) {
            $response = new Model_Response_Criterion('CRITERION_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($criterion->name == $name && $criterion->description == $description &&
            $criterion->minScore == $minScore && $criterion->maxScore == $maxScore) {

            $response = new Model_Response_Form('NOTHING_CHANGE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $criterion->name        = $name;
        $criterion->event       = $event;
        $criterion->description = $description;
        $criterion->minScore    = $minScore;
        $criterion->maxScore    = $maxScore;
        $criterion = $criterion->update();

        $response = new Model_Response_Criterion('CRITERION_UPDATE_SUCCESS', 'success', array('criterion' => $criterion));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_delete()
    {
        $id       = Arr::get($_POST, 'id');
        $event    = Arr::get($_POST, 'event');

        $criterion = new Model_Criterion($id);

        if (!$criterion->id) {
            $response = new Model_Response_Criterion('CRITERION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($criterion->event != $event) {
            $response = new Model_Response_Criterion('CRITERION_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $criterion->delete();

        $response = new Model_Response_Criterion('CRITERION_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }
}