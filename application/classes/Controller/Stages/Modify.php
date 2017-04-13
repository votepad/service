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

        $characters = array();
        switch(Arr::get($_POST, 'partORteamORgroup')) {
            case 'participants':
                $stage->mode = Methods_Stages::CHARACTER_PARTICIPANTS;
                $characters =  Arr::get($_POST, 'participants');
                break;
            case 'teams':
                $stage->mode = Methods_Stages::CHARACTER_TEAMS;
                $characters =  Arr::get($_POST, 'teams');
                break;
            case 'groups':
                $stage->mode = Methods_Stages::CHARACTER_GROUPS;
                $characters =  Arr::get($_POST, 'groups');
                break;

        }

        $stage = $stage->save();
        Methods_Stages::saveCharacters($stage->id, $characters, $stage->mode);

        $this->redirect($referrer);

    }

    /**
     * Change team information
     */
    public function action_edit()
    {
        $name         = Arr::get($_POST, 'name');
        $description  = Arr::get($_POST, 'description');
        $participants = Arr::get($_POST, 'participants');
        $logo         = Arr::get($_POST, 'logo');
        $id_team      = Arr::get($_POST, 'id_team');

        $team = new Model_Team($id_team);

        if (!$team) {
            throw new HTTP_Exception_500();
        }

        $team->name        = $name;
        $team->description = $description;
        $team->logo        = $logo;

        $team->update();

        Methods_Teams::updateParticipants($id_team, $participants);

        $this->redirect($this->request->referrer());

    }

}
