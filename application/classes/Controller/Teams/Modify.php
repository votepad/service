<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Teams_Modify extends Dispatch {

    public function before() {

        $this->auto_render = false;
        $this->checkCsrf();
        parent::before();
    }

    /**
     * Add teams to Event
     */
    public function action_add()
    {

        $id_event = $this->request->param('id_event');

        /** @var $referrer - URL to redirect */
        $referrer = $this->request->referrer();

        $team = new Model_Team();
        $team->name         = Arr::get($_POST, 'name');
        $team->description  = Arr::get($_POST, 'description');
        $team->event        = $id_event;

        /** Save and return id */
        $team = $team->save();

        $participants = Arr::get($_POST, 'participants');

        /**
         * Append participants to this created team
         */
        foreach ($participants as $participant) {

            Methods_Teams::addParticipant($participant, $team->id);

        }

        $this->redirect($referrer);

    }

    /**
     * Change team information
     */
    public function action_edit()
    {
        $name = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $participants = Arr::get($_POST, 'participants');
        $logo = Arr::get($_POST, 'logo');
        $id_team = Arr::get($_POST, 'id_team');

        $proccess = Methods_Teams::editTeamInformation($id_team, $name, $description, $logo, $participants);

        if ($proccess) {
            $this->redirect($this->request->referrer());
        }
    }

}
