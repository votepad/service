<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Events_Index
 * All pages which has relationship with Events will be here
 *
 * @author Khaydarov Murod
 * @copyright Khaydarov Murod
 *
 * @author Turov Nikolay
 *
 * @version 0.2.4
 */
class Controller_Events_Index extends Dispatch
{
    /**
     * @const ACTION_NEW [String] - for creating a new event
     */
    const ACTION_NEW        = 'New';

    /**
     * @const ACTION_SHOW_ALL [String] - Show all action
     */
    const ACTION_SHOW_ALL   = 'showAll';

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
     *
     * - Defines main template of actions
     * - Gets organization info
     * - Gets event info
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
             *  Show Events on Organization page
             */
            case self::ACTION_SHOW_ALL :
                $this->template = 'events/all';
                break;

            /**
             * Default template for others pages
             */
            default :
                $this->template = 'events/main';
                break;
        }

        parent::before();


        $organizationPage = $this->request->param('organizationpage');
        $this->organization = Model_Organizations::getByFieldName('website', $organizationPage);

        /**
         * Organization info
         */
        $this->template->organization = $this->organization;


        /**
         * @var 'eventpage' - event website
         */
        $eventPage = $this->request->param('eventpage');
        $this->event = Model_Events::getByFieldName('page', $eventPage);

        /**
         * Event info
         */
        $this->template->event = $this->event;

        if (!$this->organization && !$this->event) {
            throw new HTTP_Exception_404();
        }

        $this->template->top = View::factory('/events/blocks/top_navigation')
            ->set('organizationPage', $organizationPage)
            ->set('eventPage', $eventPage);

    }

    /**
     * NEW EVENT
     * action_new - action that open page where users create new event
     */
    public function action_new()
    {
        /**
        * Header
        * + header navigation (Logged && ! Logged)
        * + authorization modal
        */
        $this->template->header = View::factory('/organizations/blocks/header')
            ->set('auth_modal', View::factory('welcome/blocks/auth_modal'));

        /**
        * Footer
        */
        $this->template->footer = View::factory('organizations/blocks/footer');

        $org = new Model_Organization($this->organization->id);
        $this->template->team = $org->getTeam();
    }


    /**
     * MANAGE submodule
     * action_managemain - action that open page where is a main panel for manage event
     */
    public function action_event()
    {
        $this->template->main_section = View::factory('events/manage/main');
        $this->template->jumbotron_navigation = View::factory('events/manage/jumbotron_navigation')
                ->set('organizationPage', $this->organization->website)
                ->set('eventPage', $this->event->page);
    }


    /**
     * MANAGE submodule
     * action_settings - action that open page where users can edit main information about event
     */
    public function action_settings()
    {
        $this->template->main_section = View::factory('events/manage/settings');
        $this->template->jumbotron_navigation = View::factory('events/manage/jumbotron_navigation')
                ->set('organizationPage', $this->organization->website)
                ->set('eventPage', $this->event->page);
    }

    /**
     * CONTROL submodule
     * action_before - administrate event before the start
     */
    public function action_before()
    {
        $this->template->main_section = View::factory('events/control/before');
        $this->template->jumbotron_navigation = View::factory('events/control/jumbotron_navigation')
                ->set('organizationPage', $this->organization->website)
                ->set('eventPage', $this->event->page);
    }


    /**
     * CONTROL submodule
     * action_during - administrate event in real time
     */
    public function action_during()
    {
        $this->template->main_section = View::factory('events/control/during');
        $this->template->jumbotron_navigation = View::factory('events/control/jumbotron_navigation')
                ->set('organizationPage', $this->organization->website)
                ->set('eventPage', $this->event->page);
    }


    /**
     * CONTROL submodule
     * action_after - administrate event after the end
     */
    public function action_after()
    {
        $this->template->main_section = View::factory('events/control/after');
        $this->template->jumbotron_navigation = View::factory('events/control/jumbotron_navigation')
                ->set('organizationPage', $this->organization->website)
                ->set('eventPage', $this->event->page);
    }

    /**
     * PATTERN submodule
     * criteria CRUD
     */
    public function action_criterias()
    {
        $this->template->main_section = View::factory('events/pattern/criterias');
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }

    /**
     * PATTERN submodule
     * stage CRUD
     */
    public function action_stages()
    {
        $this->template->main_section = View::factory('events/pattern/stages');
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }

    /**
     * PATTERN submodule
     * contest CRUD
     */
    public function action_contests()
    {
        $this->template->main_section = View::factory('events/pattern/contests');
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }

    /**
     * PATTERN submodule
     *
     * Creating pattern of event.
     */
    public function action_results()
    {
        $this->template->main_section = View::factory('events/pattern/results');
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }


    /**
     * MEMBERS submodule
     * action_judges - action that open page where users can edit information about judges
     */
    public function action_judges()
    {
        $this->template->main_section = View::factory('events/members/judges');
        $this->template->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }


    /**
     * MEMBERS submodule
     * action_participants - action that open page where users can edit information about participants
     */
    public function action_participants()
    {
        $participants = Methods_Participants::getParticipantsFromEvent($this->event->id);

        $this->template->main_section = View::factory('events/members/participants')
            ->set('event', $this->event);

        $this->template->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
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

        $this->template->main_section = View::factory('events/members/teams')
            ->set('event', $this->event)
            ->set('participants', $participantsWithoutTeam)
            ->set('teams', $teams);

        $this->template->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
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

        $this->template->main_section = View::factory('events/members/groups')
            ->set('event', $this->event)
            ->set('teams', $teams)
            ->set('participants', $participants)
            ->set('groups', $groups);

        /** @var jumbotron_navigation */
        $this->template->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }


    /**
     * LANDING submodule
     * Action is available for all users.
     * Shows main information about event
     */
    public function action_landing()
    {
        $this->template->main_section = View::factory('events/landing/main');
        $this->template->jumbotron_navigation = '';
    }


}
