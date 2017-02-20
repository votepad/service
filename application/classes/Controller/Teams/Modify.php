<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Teams_Modify extends Dispatch {

    public function before() {

        $this->auto_render = false;

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

        $team = new Model_Teams();
        $team->name         = Arr::get($_POST, 'name');
        $team->description  = Arr::get($_POST, 'description');
        $team->id_event     = $id_event;

        /** Upload logo of team */
        $files = new Model_Uploader();
        $filename = $files->saveImage(Arr::get($_FILES, 'logo'), 'uploads/teams/');
        $team->logo = 'm_' . $filename;

        /** Save and return id */
        $id_team = $team->save();

        $participants = Arr::get($_POST, 'participants');

        /**
         * Append participants to this created team
         */
        foreach ($participants as $participant) {

            Methods_Teams::addParticipantsToTeam($participant, $id_team);

        }

        $this->redirect($referrer);

    }

}