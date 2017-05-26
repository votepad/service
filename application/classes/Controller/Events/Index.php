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

            $action = $this->request->action();

            switch ($action) {
                case 'results':
                case 'landing':
                    break;
                default:

                    /** do not allow */
                    if (!self::isLogged() || !$this->event->isAssistant($this->user->id)) {
                        $this->redirect('event/' . $this->event->id);
                    }

                    break;
            }

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
        $this->event->contests = $this->getContests($this->event->id, true, true);
        $this->event->members = $this->getMembers($this->event->id);
        $api = Kohana::$config->load('api');

        $token = array_keys(get_object_vars($api))[0];

        $scores = Request::factory('/access_token/' . $token . '/method/getResults?')
            ->query('id_event', $this->event->id)
            ->query('criterions', true)
            ->query('judges', true)
            ->method(Request::GET)
            ->execute()->body();

        $scores = json_decode($scores, true);
        $this->event->scores = $scores['data'];

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
        $this->event->contests = $this->getContests($this->event->id, true);

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
        $stages = Methods_Stages::getByEvent($this->event->id);
        $members = $this->getMembers($this->event->id);
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
     * LANDING submodule
     * Action is available for all users.
     * Shows main information about event
     */
    public function action_landing()
    {
        $this->event->members = $this->getMembers($this->event->id);

        $this->event->result_max_score = $this->getResultMaxScore($this->event->id);

        $api = Kohana::$config->load('api');
        $token = array_keys(get_object_vars($api))[0];

        $scores = Request::factory('/access_token/' . $token . '/method/getResults?')
            ->query('id_event', $this->event->id)
            ->query('stages', true)
            ->method(Request::GET)
            ->execute()->body();

        $scores = json_decode($scores, true);
        $this->event->scores = $scores['data'];


        // TODO убрать говнокод
        $this->event->contests = $this->getContests($this->event->id, false, true);
        $this->event->contestsCount = count($this->event->contests);


        $this->template = View::factory('events/landing/main')
            ->set('event', $this->event);

        $this->template->mainSection = View::factory('events/landing/pages/main_content')
            ->set('event', $this->event)
            ->set('organization', $this->organization);
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

        $this->event->contests = $this->getContests($this->event->id, false, true);
        $this->event->members = $this->getMembers($this->event->id);

        $api = Kohana::$config->load('api');
        $token = array_keys(get_object_vars($api))[0];

        $scores = Request::factory('/access_token/' . $token . '/method/getResults?')
            ->query('id_event', $this->event->id)
            ->query('stages', true)
            ->method(Request::GET)
            ->execute()->body();

        $scores = json_decode($scores, true);
        $this->event->scores = $scores['data'];


        $this->template->mainSection = View::factory('events/landing/pages/results')
            ->set('event', $this->event)
            ->set('organization', $this->organization);

    }

    /**
     * Get All Members (teams and participants)
     * @param $id - id_event
     * @return array
     */
    private function getMembers($id)
    {
        $members = array();

        $members['teams'] = Methods_Teams::getByEvent($id);
        $members['participants'] = Methods_Participants::getByEvent($id);

        return $members;
    }


    /**
     * Get All Contests with Stages with Criterions
     * @param $id - id_event
     * @return array
     */
    private function getContests($id, $with_members = false, $with_publish_result = false)
    {
        $contests = Methods_Contests::getByEvent($id);

        if ($with_publish_result) {
            $get_result = $this->redis->sMembers('votepad.orgs:' . $this->organization->id . ':events:' . $this->event->id . ':result.publish');
            $arr_result = array();
            foreach ($get_result as $result) {
                list($contest, $stage) = split('-', $result);
                $arr_result[$contest][$stage] = true;
            }
        }

        foreach ($contests as $contestKey => $contest) {
            $contest_max_score = 0;
            $stages_coeff = json_decode($contest->formula, true);

            foreach ($contest->stages as $stageKey => $stage) {

                if ($stage->id) {

                    $criterions = Methods_Stages::getCriterions($stage->formula);

                    if ($with_members)
                        $members = Methods_Stages::getMembers($stage->id, $stage->mode);

                    $stage_max_score = 0;
                    $crit_coeff = json_decode($stage->formula, true);

                    foreach ($criterions as $criterionKey => $criterion) {
                        $stage_max_score += $criterion->max_score * $crit_coeff[$criterion->id];
                        $contest_max_score += $criterion->max_score * $crit_coeff[$criterion->id] * $stages_coeff[$stageKey]["coeff"];
                    }

                    $contests[$contestKey]->stages[$stageKey]->criterions = $criterions;
                    $contests[$contestKey]->stages[$stageKey]->max_score = $stage_max_score;

                    if ($with_members) {
                        $contests[$contestKey]->stages[$stageKey]->members = $members;
                    }

                    if ($with_publish_result) {
                        if (Arr::get($arr_result, $contest->id) && Arr::get($arr_result[$contest->id], $stage->id)) {
                            $contests[$contestKey]->stages[$stageKey]->is_publish = $arr_result[$contest->id][$stage->id];
                        } else {
                            $contests[$contestKey]->stages[$stageKey]->is_publish = false;
                        }
                    }

                }
            }

            $contests[$contestKey]->max_score = $contest_max_score;

            if ($with_publish_result) {
                if (Arr::get($arr_result, $contest->id)) {
                    $contests[$contestKey]->is_publish = count($contest->stages) == count($arr_result[$contest->id]);
                } else {
                    $contests[$contestKey]->is_publish = false;
                }
            }
        }

        return $contests;
    }


    /**
     * Get Result Max Score (participants and teams)
     * @param $id - id_event
     * @return array
     */
    private function getResultMaxScore($id)
    {
        $max_score = array();
        $max_score["teams"] = 0;
        $max_score["participants"] = 0;

        $contests = Methods_Contests::getByEvent($id);

        foreach ($contests as $contestKey => $contest) {

            $stages_coeff = json_decode($contest->formula, true);

            foreach ($contest->stages as $stageKey => $stage) {

                if ($stage->id) {

                    $criterions = Methods_Stages::getCriterions($stage->formula);
                    $crit_coeff = json_decode($stage->formula, true);

                    foreach ($criterions as $criterionKey => $criterion) {
                        if ($stage->mode == 1) {
                            $max_score["participants"] += $criterion->max_score  * $crit_coeff[$criterion->id] * $stages_coeff[$stageKey]["coeff"];
                        } else {
                            $max_score["teams"] += $criterion->max_score  * $crit_coeff[$criterion->id] * $stages_coeff[$stageKey]["coeff"];
                        }
                    }
                }
            }

            $max_score['participants'] *= count($contest->judges);
            $max_score['teams'] *= count($contest->judges);

        }

        return $max_score;
    }

}
