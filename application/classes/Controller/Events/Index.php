<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Events_Index
 *
 * @copyright Votepad Team
 * @author Khaydarov Murod
 * @author Turov Nikolay
 *
 * @version 2.0.0
 */
class Controller_Events_Index extends Dispatch
{
    public $template = 'main';

    /**
     * @var $event [Model_Event] - default value is null. Keeps cached render
     */
    protected $event = null;

    /**
     * @const ACTION_NEW [String] - page of creating new event
     */
    const ACTION_NEW = 'event_new';

    /**
     * @const ACTION_NEW [String] - page of creating new event
     */
    const INVITE_ASSISTANT = 'invite_assistant';

    /**
     * @const ACTION_LANDING [String] - landing page of event
     */
    const ACTION_LANDING = 'landing';

    /**
     * @const ACTION_RESULTS [String] - page with full information of event results
     */
    const ACTION_RESULTS = 'results';


    public function before()
    {
        parent::before();

        $action = $this->request->action();

        if ($action == self::ACTION_NEW)
            return;

        $id = $this->request->param('id');
        $this->event = new Model_Event($id);

        /**
         * Meta Dates
         */
        $this->template->title = $this->event->name;
        $this->template->description = $this->event->description;
        $this->template->keywords = $this->event->tags;

        if (!$this->event->id)
            throw new HTTP_Exception_404;

        switch ($action) {
            case self::INVITE_ASSISTANT:
            case self::ACTION_LANDING:
            case self::ACTION_RESULTS:
                break;
            default:

                /** need authorization */
                if (!self::isLogged()) {
                    throw new HTTP_Exception_401;
                }

                /** do not allow */
                if (!$this->event->isAssistant($this->user->id)) {
                    throw new HTTP_Exception_403;
                }

                if (!$this->event->code || !Model_Event::getEventByCode($this->event->code)) {
                    $this->event->code = $this->event->generateCodeForJudges($this->event->id);
                    $this->event->update();
                }

                break;
        }

        /**
         * Data for template of module content
         */
        $data = array(
            'event'     => $this->event,
            'action'    => $action,
            'section'   => $this->request->param('section')
        );

        $this->template->mainSection = View::factory('events/content', $data);

    }


    /**
     * Action Event New - page of creating new event
     */
    public function action_event_new()
    {
        if (!self::isLogged())
            throw new HTTP_Exception_403;

        $this->template->title = "Новое мероприятие";
        $this->template->mainSection = View::factory('events/pages/event-new');
    }


    /**
     * SETTINGS submodule
     * action_settings - page of editing main info of event
     */
    public function action_info()
    {
        $this->template->mainSection->page = View::factory('events/pages/settings-info')
            ->set('event', $this->event);
    }


    /**
     * SETTINGS submodule
     * action_assistants - page where event creator can menage access for users who can edit event
     */
    public function action_assistants()
    {

        $this->event->assistants = $this->event->getAllAssistants();

        $requests_ids =  $this->redis->sMembers(getenv('REDIS_EVENTS') . $this->event->id . ':assistants.requests');
        $requests = array();

        foreach ($requests_ids as $id) {
            array_push($requests, new Model_User($id));
        }

        $this->template->mainSection->page = View::factory('events/pages/settings-assistants')
            ->set('event', $this->event)
            ->set('requests', $requests);
    }


    /**
     * INVITE_ASSISTANT
     * Action that check inviting hash and send request to enter to the event
     */
    public function action_invite_assistant()
    {
        $hash = $this->request->param('hash');
        if (!$this->event->checkInviteLink($hash))
            throw new HTTP_Exception_404;

        if (!self::isLogged())
            throw new HTTP_Exception_401;

        if ($this->event->isAssistant($this->user->id))
            throw new HTTP_Exception_403;

        $this->redis->sAdd(getenv('REDIS_EVENTS') . $this->event->id . ':assistants.requests', $this->user->id);
        $this->template->mainSection = View::factory('events/pages/invite-assistants')
            ->set('event', $this->event);
    }


    /**
     * CONTROL submodule
     * action_scores - show all scores and edit them
     */
    public function action_scores()
    {
        $this->event->results = Methods_Results::getResults($this->event->id);
        $this->event->judges = Methods_Judges::getAllByEvent($this->event->id);
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

        $this->template->mainSection->page = View::factory('events/pages/control-scores')
            ->set('event', $this->event);
    }



    /**
     * SCENARIO submodule
     * action_criterions - action that open page where users can edit information about criterions
     */
    public function action_criterions()
    {
        $criterions = Methods_Criterions::getAllByEvent($this->event->id);

        $this->template->mainSection->page = View::factory('events/pages/scenario-criterions')
            ->set('event', $this->event)
            ->set('criterions', $criterions);
    }


    /**
     * SCENARIO submodule
     * action_stages - action that open page where users can edit information about stages
     */
    public function action_stages()
    {
        $stages = Methods_Stages::getAllByEvent($this->event->id, true);
        $members = $this->getMembers($this->event->id);
        $criterions = Methods_Criterions::getJSON($this->event->id);

        $this->template->mainSection->page = View::factory('events/pages/scenario-stages')
            ->set('event', $this->event)
            ->set('stages', $stages)
            ->set('members', $members)
            ->set('criterions', $criterions);
    }


    /**
     * SCENARIO submodule
     * action_contests - action that open page where users can edit information about contests
     */
    public function action_contests()
    {
        $judges     = Methods_Judges::getAllByEvent($this->event->id);
        $stagesJSON = Methods_Stages::getJSON($this->event->id);
        $stages     = Methods_Stages::getAllByEvent($this->event->id, false);
        $contests   = Methods_Contests::getAllByEvent($this->event->id, true);

        $this->template->mainSection->page = View::factory('events/pages/scenario-contests')
            ->set('event', $this->event)
            ->set('judges', $judges)
            ->set('stagesJSON', $stagesJSON)
            ->set('stages', $stages)
            ->set('contests', $contests);
    }


    /**
     * SCENARIO submodule
     * action_result - action that open page where users can edit information about result
     */
    public function action_result()
    {
        $results      = Methods_Results::getAllByEvent($this->event->id, true);
        $contestsJSON = Methods_Contests::getJSON($this->event->id);

        $this->template->mainSection->page = View::factory('events/pages/scenario-results')
            ->set('event', $this->event)
            ->set('results', $results)
            ->set('contestsJSON', $contestsJSON);
    }


    /**
     * MEMBERS submodule
     * action_judges - action that open page where users can edit information about judges
     */
    public function action_judges()
    {
        $judges = Methods_Judges::getAllByEvent($this->event->id);

        $this->template->mainSection->page = View::factory('events/pages/members-judges')
            ->set('event', $this->event)
            ->set('judges', $judges);
    }


    /**
     * MEMBERS submodule
     * action_participants - action that open page where users can edit information about participants
     */
    public function action_participants()
    {
        $participants = Methods_Participants::getAllByEvent($this->event->id);

        $this->template->mainSection->page = View::factory('events/pages/members-participants')
            ->set('event', $this->event)
            ->set('participants', $participants);
    }


    /**
     * MEMBERS submodule
     * action_teams - action that open page where users can edit information about teams
     */
    public function action_teams()
    {
        $teams = Methods_Teams::getAllByEvent($this->event->id);

        $this->template->mainSection->page = View::factory('events/pages/members-teams')
            ->set('event', $this->event)
            ->set('teams', $teams);

    }



    /**
     * LANDING submodule
     * action_landing - shows landing of event page
     * - action is available for all users.
     */
    public function action_landing()
    {
        if ($this->event->type == 0) {
            throw new HTTP_Exception_404;
        }

        $this->event->results = Methods_Results::getResults($this->event->id);
        $this->event->members = $this->getMembers($this->event->id);

        $api = Kohana::$config->load('api');
        $token = array_keys(get_object_vars($api))[0];

        $scores = Request::factory('/access_token/' . $token . '/method/getResults?')
            ->query('id_event', $this->event->id)
            ->method(Request::GET)
            ->execute()->body();

        $scores = json_decode($scores, true);
        $this->event->scores = $scores['data'];

        $this->template = View::factory('event-landing/main')
            ->set('page', 'landing')
            ->set('event', $this->event);
    }


    /**
     * LANDING submodule
     * action_results - shows full information about event result
     * - action is available for all users.
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
     * @param $id_event - event ID
     * @return array
     */
    private function getMembers($id_event)
    {
        $members = array();

        $members['teams'] = Methods_Teams::getAllByEvent($id_event);
        $members['participants'] = Methods_Participants::getAllByEvent($id_event);

        return $members;
    }

}