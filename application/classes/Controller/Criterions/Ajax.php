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
        $min_score   = Arr::get($_POST, 'min_score');
        $max_score   = Arr::get($_POST, 'max_score');

        if (empty($name) || empty($min_score) || empty($max_score)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $criterion = new Model_Criterion();

        $criterion->name        = $name;
        $criterion->event       = $event;
        $criterion->description = $description;
        $criterion->min_score   = $min_score;
        $criterion->max_score   = $min_score;
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
        $min_score   = Arr::get($_POST, 'min_score');
        $max_score   = Arr::get($_POST, 'max_score');

        if (empty($name) || empty($min_score) || empty($max_score)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
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
            $criterion->min_score == $min_score && $criterion->max_score == $min_score) {

            $response = new Model_Response_Form('NOTHING_CHANGE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $criterion->name        = $name;
        $criterion->event       = $event;
        $criterion->description = $description;
        $criterion->min_score   = $min_score;
        $criterion->max_score   = $min_score;
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