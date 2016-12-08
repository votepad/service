<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Events_Index
 * All pages which has relationship with Events will be here
 *
 * @author Khaydarov Murod
 * @author Khaydarov Murod <murod.haydarov@gmail.com>
 * @copyright Khaydarov Murod
 *
 * @author Turov Nikolay
 *
 * @version 0.2.2
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
     * action_new - action that open page where users create new event
     */
    public function action_new()
    {
        $team = Model_Organizations::team($this->organization->id);
        $this->template->team = $team;
    }

    /**
     * action_managemain - action that open page where is a main panel for manage event
     */
    public function action_event()
    {
        $this->template->main_section = View::factory('events/manage/main');
        $this->template->left = View::factory('events/manage/left_navigation')
                ->set('organizationPage', $this->organization->website)
                ->set('eventPage', $this->event->page);
    }

    /**
     * action_maininfo - action that open page where users can edit main information about event
     */
    public function action_landing()
    {
        $this->template->main_section = View::factory('events/manage/maininfo');
        $this->template->leftnav = View::factory('events/manage/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_controlmain - action that open page where users can admonostrate event
     */
    public function action_controlmain()
    {
        $this->template->main_section = View::factory('events/control/main');
//        $this->template->leftnav = '';
    }


    /**
     *
     * PATTERN submodule.
     * Main information about this submodule, instruction.
     */
    public function action_main()
    {
        $this->template->main_section = View::factory('events/pattern/main');
        $this->template->left = View::factory('/events/pattern/left_navigation')
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
        $this->template->left = View::factory('/events/pattern/left_navigation')
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
        $this->template->left = View::factory('/events/pattern/left_navigation')
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
        $this->template->left = View::factory('/events/pattern/left_navigation')
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
        $this->template->left = View::factory('/events/pattern/left_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }

    /**
     * MEMBERS submodule
     * Information about appended members, instruction how to work with this submodule
     */
    public function action_info()
    {
        $this->template->main_section = View::factory('events/members/main');

        $this->template->left = View::factory('events/members/left_navigation')
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
        $this->template->left = View::factory('events/members/left_navigation')
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

        $this->template->main_section = View::factory('events/members/participants');
        $this->template->left = View::factory('events/members/left_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }


    /**
     * MEMBERS submodule
     * action_teams - action that open page where users can edit information about teams
     */
    public function action_teams()
    {
        $participants = Methods_Participants::getParticipantsFromEvent($this->event->id);
        $teams = Methods_Teams::getAllTeams($this->event->id);

        $this->template->main_section = View::factory('events/members/teams')
            ->set('event', $this->event)
            ->set('participants', $participants)
            ->set('teams', $teams);

        $this->template->left = View::factory('events/members/left_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }


    /**
     * MEMBERS submodule
     * action_groups - action that open page where users can edit information about groups
     */
    public function action_groups()
    {
        $this->template->main_section = View::factory('events/members/groups');
        $this->template->left = View::factory('events/members/left_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }


    /**
     * Action is available for all users.
     * Shows main information about event
     *
     */
    public function action_eventpage()
    {
        $this->template->main_section = View::factory('events/page/main');
        $this->template->left = View::factory('/events/blocks/left_navigation')
            ->set('organizationPage', $this->organization->website)
            ->set('eventPage', $this->event->page);
    }

    /**
     * action_edit - action that open page where users can edit landing page
     */
    public function action_edit()
    {
        $this->template->main_section = View::factory('events/page/edit');
        $this->template->leftnav = View::factory('events/page/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


}
