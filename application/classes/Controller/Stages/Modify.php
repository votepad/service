<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Stages_Modify extends Dispatch {

    public function before() {

        $this->auto_render = false;
        parent::before();
        $this->checkCsrf();

    }

    /**
     * Add stage to Event
     */
    public function action_add()
    {

        $id_event = $this->request->param('id_event');

        /** @var $referrer - URL to redirect */
        $referrer = $this->request->referrer();

        $stage = new Model_Stage();
        $stage->name         = Arr::get($_POST, 'name');
        $stage->description  = Arr::get($_POST, 'description');
        $stage->formula      = Arr::get($_POST, 'formula');
        $stage->event        = $id_event;

        $members = array();
        switch(Arr::get($_POST, 'partORteamORgroup')) {
            case 'participants':
                $stage->mode = Methods_Stages::MEMBERS_PARTICIPANTS;
                $members =  Arr::get($_POST, 'participants');
                break;
            case 'teams':
                $stage->mode = Methods_Stages::MEMBERS_TEAMS;
                $members =  Arr::get($_POST, 'teams');
                break;
            case 'groups':
                $stage->mode = Methods_Stages::MEMBERS_GROUPS;
                $members =  Arr::get($_POST, 'groups');
                break;

        }

        $stage = $stage->save();
        Methods_Stages::saveMembers($stage->id, $members);

        $this->redirect($referrer);

    }

    /**
     * Change team information
     */
    public function action_edit()
    {

        $id           = Arr::get($_POST, 'stage_id');
        $members      = Arr::get($_POST, 'members');

        $stage = new Model_Stage($id);

        if (!$stage->id) {
            throw new HTTP_Exception_404();
        }

        $stage->name        = Arr::get($_POST, 'name', $stage->name);
        $stage->description = Arr::get($_POST, 'description', $stage->description);
        $stage->update();

        Methods_Stages::updateMembers($stage->id, $members);

        $this->redirect($this->request->referrer());

    }

}
