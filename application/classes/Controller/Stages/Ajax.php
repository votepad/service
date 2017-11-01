<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Stages_Ajax extends Ajax
{

    public function action_create()
    {
        $event        = Arr::get($_POST, 'event');
        $name         = Arr::get($_POST, 'name');
        $description  = Arr::get($_POST, 'description');
        $formula      = Arr::get($_POST, 'formula');

        if (empty($name) || empty($description) || empty($formula)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $stage = new Model_Stage();

        $stage->name        = $name;
        $stage->event       = $event;
        $stage->description = $description;
        $stage->formula     = $formula;

        switch(Arr::get($_POST, 'mode')) {
            case 'participants':
                $stage->mode = Methods_Stages::MEMBERS_PARTICIPANTS;
                $members =  Arr::get($_POST, 'participants');
                break;
            case 'teams':
                $stage->mode = Methods_Stages::MEMBERS_TEAMS;
                $members =  Arr::get($_POST, 'teams');
                break;
            default:
                break;
        }

        if (empty($members)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $stage = $stage->save();
        Methods_Stages::saveMembers($stage->id, $members);

        $response = new Model_Response_Stage('STAGE_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_update()
    {
        $id          = Arr::get($_POST, 'id');
        $event       = Arr::get($_POST, 'event');
        $name        = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $members     = Arr::get($_POST, 'members');
        $formula     = Arr::get($_POST, 'formula');

        if (empty($name) || empty($description) || empty($formula) || empty($members)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $stage = new Model_Stage($id);

        if (!$stage->id) {
            $response = new Model_Response_Stage('STAGE_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($stage->event != $event) {
            $response = new Model_Response_Stage('STAGE_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $stage->name = $name;
        $stage->description = $description;
        $stage->formula = $formula;
        $stage = $stage->update();

        Methods_Stages::updateMembers($stage->id, $members);

        $stage->formula = Methods_Criterions::getJSONbyFormula($stage->formula);
        $stage->members = Methods_Stages::getMembers($stage->id, $stage->mode);

        $stageBlock = View::factory('events/blocks/scenario-stage-block', array('stage' => $stage))->render();

        $response = new Model_Response_Stage('STAGE_UPDATE_SUCCESS', 'success', array('stage' => $stageBlock));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_delete()
    {
        $id       = Arr::get($_POST, 'id');
        $event    = Arr::get($_POST, 'event');

        $stage = new Model_Stage($id);

        if (!$stage->id) {
            $response = new Model_Response_Stage('STAGE_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($stage->event != $event) {
            $response = new Model_Response_Stage('STAGE_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Methods_Stages::removeAllMembers($stage->id);
        $stage->delete();

        $response = new Model_Response_Stage('STAGE_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_publish()
    {
        $event   = Arr::get($_POST, 'event');
        $publish = Arr::get($_POST, 'publish');
        $contest = Arr::get($_POST, 'contest');
        $stage   = Arr::get($_POST, 'stage');

        $contest = new Model_Contest($contest);

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

        $stage = new Model_Stage($stage);

        if (!$stage->id) {
            $response = new Model_Response_Stage('STAGE_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($stage->event != $event) {
            $response = new Model_Response_Stage('STAGE_EVENT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $publish_stages = $this->redis->sMembers(getenv('REDIS_EVENTS') . $event . ':publish:stages');
        $is_publish = in_array($contest->id . '-' . $stage->id, $publish_stages) ? "true" : "false";

        if ($is_publish == $publish) {
            switch ($publish) {
                case "true":
                    $this->redis->sRem(getenv('REDIS_EVENTS') . $event . ':publish:stages', $contest->id . '-' . $stage->id);
                    $response = new Model_Response_Stage('STAGE_UN_PUBLISH_SUCCESS', 'success');
                    break;
                case "false":
                    $this->redis->sAdd(getenv('REDIS_EVENTS') . $event . ':publish:stages', $contest->id . '-' . $stage->id);
                    $response = new Model_Response_Stage('STAGE_PUBLISH_SUCCESS', 'success');
                    break;
            }
        } else {
            $response = new Model_Response_Stage('STAGE_PUBLISH_ERROR', 'error');
        }

        $this->response->body(@json_encode($response->get_response()));
    }

}