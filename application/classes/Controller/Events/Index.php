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
            $data = array(
                'event'     => $this->event,
                'action'    => $this->request->action(),
                'section'=> $this->request->param('section')
            );

            $this->template->header = View::factory('globalblocks/header')
                ->set('header_menu', View::factory('events/blocks/header_menu',$data))
                ->set('header_menu_mobile', View::factory('events/blocks/header_menu_mobile',$data));

        }

    }


    /**
     * MANAGE submodule
     * action_settings - change main-info
     */
    public function action_settings()
    {
        if (!$this->event->isAssistant($this->user->id) || !self::isLogged()) {
            $this->redirect('event/' . $this->event->id);
        }

        $this->template->mainSection = View::factory('events/settings/content')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

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

    }


    /**
     * CONTROL submodule
     * action_scores - show all scores and edit them
     */
    public function action_scores()
    {
        if (!$this->event->isAssistant($this->user->id) || !self::isLogged()) {
            $this->redirect('event/' . $this->event->id);
        }

        $this->event->contests = $this->getContests($this->event->id);

        $this->template->mainSection = View::factory('events/control/scores')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

    }

    /**
     * CONTROL submodule
     * action_plan - block/unblock member, stage or contest
     */
    public function action_plan()
    {
        if (!$this->event->isAssistant($this->user->id) || !self::isLogged()) {
            $this->redirect('event/' . $this->event->id);
        }

        $this->event->contests = $this->getContests($this->event->id);

        $this->template->mainSection = View::factory('events/control/plan')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

    }


    /**
     * PATTERN submodule
     * action_criterias - criteria CRUD
     */
    public function action_criterias()
    {
        if (!$this->event->isAssistant($this->user->id) || !self::isLogged()) {
            $this->redirect('event/' . $this->event->id);
        }

        $this->template->mainSection = View::factory('events/scenario/criterias')
            ->set('event', $this->event)
            ->set('organization', $this->organization);
    }


    /**
     * PATTERN submodule
     * action_stages - stage CRUD
     */
    public function action_stages()
    {
        if (!$this->event->isAssistant($this->user->id) || !self::isLogged()) {
            $this->redirect('event/' . $this->event->id);
        }

        $stages = Methods_Stages::getByEvent($this->event->id);
        $members = array(
            'participants' => Methods_Participants::getByEvent($this->event->id),
            'teams'        => Methods_Teams::getAllTeams($this->event->id),
            //'groups'       => Methods_Participants::getByEvent($this->event->id)
        );
        $criterions = Methods_Criterions::getJSON($this->event->id);

        $this->template->mainSection = View::factory('events/scenario/stages')
            ->set('event', $this->event)
            ->set('organization', $this->organization)
            ->set('stages', $stages)
            ->set('members', $members)
            ->set('criterions', $criterions);

    }


    /**
     * PATTERN submodule
     * action_contests - contest CRUD
     */
    public function action_contests()
    {

        $this->event->judges = Methods_Judges::getByEvent($this->event->id);
        $this->event->stagesJSON = Methods_Stages::getJSON($this->event->id);
        $this->event->stages = Methods_Stages::getByEvent($this->event->id);
        $this->event->contests = Methods_Contests::getByEvent($this->event->id);

        $this->template->mainSection = View::factory('events/scenario/contests')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

    }


    /**
     * PATTERN submodule
     *
     * action_result - result CRUD
     */
    public function action_result()
    {

        $this->event->result = Methods_Results::getByEvent($this->event->id);
        $this->event->contestsJSON = Methods_Contests::getJSON($this->event->id);

        $this->template->mainSection = View::factory('events/scenario/results')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

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
        $parcipants = Methods_Participants::getByEvent($this->event->id);

        $this->template = View::factory('events/landing/main')
            ->set('event', $this->event);

        $this->template->mainSection = View::factory('events/landing/pages/content')
            ->set('event', $this->event)
            ->set('organization', $this->organization)
            ->set('participants', $parcipants);
    }

    /**
     * LANDING submodule
     * Action is available for all users.
     * Shows main information about event
     */
    public function action_results()
    {
        $this->template = View::factory('events/landing/main')
            ->set('event', $this->event);


        $this->event->contests = $this->getContests($this->event->id);


        $this->template->mainSection = View::factory('events/landing/pages/results')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

    }



    private function getContests($id)
    {
        $contests = Methods_Contests::getByEvent($id);

        foreach ($contests as $key => $contest) {
            $contests[$key]->stages = Methods_Contests::getStages($contest->formula);

            foreach ($contest->stages as $key2 => $stage) {
                $contests[$key]->stages[$key2]->members = Methods_Stages::getMembers($stage->id, $stage->mode);
                $contests[$key]->stages[$key2]->criterions = Methods_Stages::getCriterions($stage->formula);
            }

        }

        return $contests;
    }
}
