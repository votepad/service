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
     * @var $organization [String] - default value is null. Keeps cached render
     */
    protected $organization = null;

    /**
     * @var $event [String] - default value is null. Keeps cached render
     */
    protected $event = null;


    /**
     * Global Template
     */
    public $template = 'main';

    /**
     * Function that calls before main action
     */
    public function before()
    {

        parent::before();

        $id = $this->request->param('id');
        $event = new Model_Event($id);

        if ($event->id) {

            $this->event = $event;
            $this->organization = new Model_Organization($event->organization);

            if (!$event->code || !Model_Event::getEventByCode($event->code)) {
                $this->event->code = $event->generateCodeForJudges($event->id);
                $this->event->update();
            }

            /**
             * Meta Dates
             */
            $this->template->title = $event->name;
            $this->template->description = $event->description;
            $this->template->keywords = $event->tags;


            /**
             * Header
             */
            $this->template->header = View::factory('globalblocks/header')
                ->set('header_menu', View::factory('events/blocks/header_menu',array('event' => $this->event)))
                ->set('header_menu_mobile', View::factory('events/blocks/header_menu_mobile',array('event' => $this->event)));

        }

    }


    /**
     * MANAGE submodule
     * action_settings - change main-info
     */
    public function action_settings()
    {
        $this->template->mainSection = View::factory('events/settings/content')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

        $this->template->mainSection->jumbotron_navigation = View::factory('events/settings/jumbotron_navigation')
            ->set('event', $this->event);
    }


    /**
     * MANAGE submodule
     * action_settings - change main-info
     */
    public function action_info()
    {
        $this->template->mainSection = View::factory('events/settings/info')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

        $this->template->mainSection->jumbotron_navigation = View::factory('events/settings/jumbotron_navigation')
            ->set('event', $this->event);

    }


    /**
     * MANAGE submodule
     * action_assistants - action that open page where users can edit assistants
     */
    public function action_assistants()
    {

        $this->event->assistants = $this->event->getAssistants();

        if (empty($this->user) || !$this->organization->isMember($this->user->id)) {
            throw new HTTP_Exception_403();
        }

        $requests_ids =  $this->redis->sMembers('votepad.orgs:' . $this->event->organization . ':events:' . $this->event->id . ':assistants.requests');
        $requests = array();

        foreach ($requests_ids as $id) {
            array_push($requests, new Model_User($id));
        }

        $this->template->mainSection = View::factory('events/settings/assistants')
            ->set('event', $this->event)
            ->set('organization', $this->organization)
            ->set('requests', $requests)
            ->set('invite_link', $this->event->getInviteLink());

        $this->template->mainSection->jumbotron_navigation = View::factory('events/settings/jumbotron_navigation')
            ->set('event', $this->event);

    }


    /**
     * CONTROL submodule
     * action_control - administrate event
     */
    public function action_control()
    {
        $this->template->jumbotron_navigation = "";

        $this->template->mainSection = View::factory('events/control/main');
    }


    /**
     * PATTERN submodule
     * action_criterias - criteria CRUD
     */
    public function action_criterias()
    {
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation');

        $this->template->mainSection = View::factory('events/pattern/criterias');
    }


    /**
     * PATTERN submodule
     * action_stages - stage CRUD
     */
    public function action_stages()
    {
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->mainSection = View::factory('events/pattern/stages');
    }


    /**
     * PATTERN submodule
     * action_contests - contest CRUD
     */
    public function action_contests()
    {
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->mainSection = View::factory('events/pattern/contests');
    }


    /**
     * PATTERN submodule
     *
     * action_result - result CRUD
     */
    public function action_result()
    {
        $this->template->jumbotron_navigation = View::factory('/events/pattern/jumbotron_navigation')
            ->set('event', $this->event);

        $this->template->mainSection = View::factory('events/pattern/results');
    }


    /**
     * MEMBERS submodule
     * action_judges - action that open page where users can edit information about judges
     */
    public function action_judges()
    {
        $this->template->mainSection = View::factory('events/members/judges')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

        $this->template->mainSection->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
            ->set('event', $this->event);
    }


    /**
     * MEMBERS submodule
     * action_participants - action that open page where users can edit information about participants
     */
    public function action_participants()
    {

        $this->template->mainSection = View::factory('events/members/participants')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

        $this->template->mainSection->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
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
        $participantsWoTeam = Methods_Teams::getParticipantsWhitOutTeam($this->event->id);

        $this->template->mainSection = View::factory('events/members/teams')
            ->set('event', $this->event)
            ->set('organization', $this->organization)
            ->set('participants', $participantsWoTeam)
            ->set('teams', $teams);

        $this->template->mainSection->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
            ->set('event', $this->event);

    }


    /**
     * MEMBERS submodule
     * action_groups - action that open page where users can edit information about groups
     */
//    public function action_groups()
//    {
//        //$teams = Methods_Teams::getAllTeams($this->event->id);
//        //$participants = Methods_Participants::getParticipantsFromEvent($this->event->id);
//        //$groups = Methods_Groups::getAllGroups($this->event->id);
//
//        $this->template->mainSection = View::factory('events/members/groups')
//            ->set('event', $this->event)
//            ->set('organization', $this->organization);
//            //->set('teams', $teams)
//            //->set('participants', $participants)
//            //->set('groups', $groups);
//
//        $this->template->mainSection->jumbotron_navigation = View::factory('events/members/jumbotron_navigation')
//            ->set('event', $this->event);
//    }


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
