<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Events_Index
 * All pages which has relationship with Events will be here
 *
 * @copyright Votepad Team
 * @author Khaydarov Murod
 * @author Turov Nikolay
 *
 * @version 0.2.5
 */
class Controller_Events_Index extends Dispatch
{
    /**
     * @const ACTION_NEW [String] - for creating a new event
     */
    const ACTION_NEW        = 'new';


    /**
     * @var $organization [String] - default value is null. Keeps cached render
     */
    protected $organization = null;

    /**
     * @var $event [String] - default value is null. Keeps cached render
     */
    protected $event = null;

    /**
     * Function that calls before main action
     */
    public function before()
    {
        switch ($this->request->action()) {

            /**
             * Creating a new event
             */
            case self::ACTION_NEW :
                $this->template = 'events/new';
                break;

            /**
             * Default template for others pages
             */
            default :
                $this->template = 'events/main';
                break;
        }

        parent::before();

        $this->idOrg = $this->request->param('id_org');
        $id = $this->request->param('id_event');
        $event = new Model_Event($id);

        if ($event) {

            $this->event = $event;
            $this->organization = new Model_Organization($event->organization);

            /**
             * Meta Dates
             */
            $this->template->title = $event->title;
            $this->template->description = $event->description;
            $this->template->tags = $event->tags;


            /**
             * Header
             */
            $this->template->header = View::factory('globalblocks/header')
                ->set('header_menu', View::factory('events/blocks/header_menu', array('event' => $event)))
                ->set('header_menu_mobile', View::factory('events/blocks/header_menu_mobile', array('event' => $event)))
                ->set('auth_modal', View::factory('globalblocks/auth_modal'));


            /**
             * Jumbotron Wrapper
             */
            $this->template->jumbotron_wrapper = View::factory('events/blocks/jumbotron_wrapper')
                ->set('event', $event)
                ->set('organization', $this->organization);


            /**
             * Footer
             */
            $this->template->footer = View::factory('globalblocks/footer');

        }

    }

    /**
     * NEW EVENT
     * action_new - action that open page where users create new event
     */
    public function action_new()
    {

        $this->template->header = View::factory('globalblocks/header')
            ->set('header_menu', '')
            ->set('header_menu_mobile', '')
            ->set('auth_modal', View::factory('globalblocks/auth_modal'));

        $this->template->footer = View::factory('globalblocks/footer');

        $this->template->idOrg = $this->idOrg;

    }


    /**
     * MANAGE submodule
     * action_settings - change main-info
     */
    public function action_settings()
    {
        $this->template->jumbotron_navigation = View::factory('events/settings/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->main_section = View::factory('events/settings/main')
            ->set('event', $this->event);
    }


    /**
     * MANAGE submodule
     * action_assistants - action that open page where users can edit assistants
     */
    public function action_assistants()
    {
        $this->template->jumbotron_navigation = View::factory('events/settings/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->main_section = View::factory('events/settings/assistants')
            ->set('event', $this->event);
    }


    /**
     * CONTROL submodule
     * action_control - administrate event
     */
    public function action_control()
    {
        $this->template->jumbotron_navigation = "";

        $this->template->main_section = View::factory('events/control/main');
    }


    /**
     * PATTERN submodule
     * action_criterias - criteria CRUD
     */
    public function action_criterias()
    {
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation');

        $this->template->main_section = View::factory('events/pattern/criterias');
    }


    /**
     * PATTERN submodule
     * action_stages - stage CRUD
     */
    public function action_stages()
    {
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->main_section = View::factory('events/pattern/stages');
    }


    /**
     * PATTERN submodule
     * action_contests - contest CRUD
     */
    public function action_contests()
    {
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->main_section = View::factory('events/pattern/contests');
    }


    /**
     * PATTERN submodule
     *
     * action_results - results CRUD
     */
    public function action_results()
    {
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->main_section = View::factory('events/pattern/results');
    }


    /**
     * MEMBERS submodule
     * action_judges - action that open page where users can edit information about judges
     */
    public function action_judges()
    {
        $this->template->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->main_section = View::factory('events/members/judges');
    }


    /**
     * MEMBERS submodule
     * action_participants - action that open page where users can edit information about participants
     */
    public function action_participants()
    {
        $participants = Methods_Participants::getParticipantsFromEvent($this->event->id);

        $this->template->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->main_section = View::factory('events/members/participants')
            ->set('event', $this->event);
    }


    /**
     * MEMBERS submodule
     * action_teams - action that open page where users can edit information about teams
     */
    public function action_teams()
    {
        /**
         * getting all teams from event
         * and make an array of their IDs
         */
        $teams = Methods_Teams::getAllTeams($this->event->id);
        $teamsId = array_map("Methods_Common::getObjectIdentities", $teams);

        /** $allparticipants - array of participant from all teams */
        $allparticipants = Methods_Teams::getAllParticipantsFromTeams($teamsId);

        /** @var $participants - array of participants from whole event */
        $participants = Methods_Participants::getParticipantsFromEvent($this->event->id);
        $participantIds = array_map("Methods_Common::getObjectIdentities", $participants);

        /** @var $freeParticipants - array of participants that not included in teams */
        $freeParticipants = array_diff($participantIds, $allparticipants);
        $participantsWithoutTeam = Methods_Participants::getSetOfParticipants($freeParticipants);

        $teams = Methods_Teams::getAllTeams($this->event->id);

        $this->template->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->main_section = View::factory('events/members/teams')
            ->set('event', $this->event)
            ->set('participants', $participantsWithoutTeam)
            ->set('teams', $teams);
    }


    /**
     * MEMBERS submodule
     * action_groups - action that open page where users can edit information about groups
     */
    public function action_groups()
    {
        $teams = Methods_Teams::getAllTeams($this->event->id);
        $participants = Methods_Participants::getParticipantsFromEvent($this->event->id);
        $groups = Methods_Groups::getAllGroups($this->event->id);

        $this->template->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->main_section = View::factory('events/members/groups')
            ->set('event', $this->event)
            ->set('teams', $teams)
            ->set('participants', $participants)
            ->set('groups', $groups);
    }


    /**
     * LANDING submodule
     * Action is available for all users.
     * Shows main information about event
     */
    public function action_landing()
    {
        $this->template = View::factory('events/landing/main');
    }


}
