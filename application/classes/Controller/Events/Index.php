<?php

/**
* Class Events_Index
* All pages which has relationship with Events will be here
* @author NWE team
* @copyright Turov Nikolay
* @version 0.2.0
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

        /**
         * @var 'organizationpage' - organization website
         */
         $param = $this->request->param('organizationpage');
         $this->organization = Model_Organizations::getByFieldName('website', $param);

        /**
         * Organization info
         */
         $this->template->organization = $this->organization;


         /**
          * @var 'eventpage' - event website
          */
          $param = $this->request->param('eventpage');
          $this->event = Model_Events::getByFieldName('page', $param);

         /**
          * Event info
          */
          $this->template->event = $this->event;


          if ($this->organization != false && $this->event != false) {

              /**
                * Top Navigation
               */
               $this->template->topnav = View::factory('events/menu')
                    ->set('orgpage', $this->organization->website)
                    ->set('eventpage', $this->event->page);

          }

    }

    /**
     * action_new - action that open page where users create new event
     */
    public function action_new()
    {
        $team         = Model_Organizations::team($this->organization->id);
        $this->template->team         = $team;
    }


    /**
     * action_managemain - action that open page where is a main panel for manage event
     */
    public function action_managemain()
    {
        $this->template->main_section = View::factory('events/managepanel/main');
        $this->template->leftnav = View::factory('events/managepanel/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_maininfo - action that open page where users can edit main information about event
     */
    public function action_maininfo()
    {
        $this->template->main_section = View::factory('events/managepanel/maininfo');
        $this->template->leftnav = View::factory('events/managepanel/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_controlmain - action that open page where users can admonostrate event
     */
    public function action_controlmain()
    {
        $this->template->main_section = View::factory('events/control/main');
        $this->template->leftnav = '';
    }


    /**
     * action_planmain - action that open page where users can get some instructions about results,contests,stages,criterias
     */
    public function action_planmain()
    {
        $this->template->main_section = View::factory('events/plan/main');
        $this->template->leftnav = View::factory('events/plan/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_results - action that open page where users can edit formulas for final results
     */
    public function action_results()
    {
        $this->template->main_section = View::factory('events/plan/results');
        $this->template->leftnav = View::factory('events/plan/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_contests - action that open page where users can edit contsts information
     */
    public function action_contests()
    {
        $this->template->main_section = View::factory('events/plan/contests');
        $this->template->leftnav = View::factory('events/plan/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_stages - action that open page where users can edit stages information
     */
    public function action_stages()
    {
        $this->template->main_section = View::factory('events/plan/stages');
        $this->template->leftnav = View::factory('events/plan/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_criterias - action that open page where users can edit criterias information
     */
    public function action_criterias()
    {
        $this->template->main_section = View::factory('events/plan/criterias');
        $this->template->leftnav = View::factory('events/plan/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_charactersmain - action that open page where users can get some instructions about judges,participants,teams,groups
     */
    public function action_charactersmain()
    {
        $this->template->main_section = View::factory('events/characters/main');
        $this->template->leftnav = View::factory('events/characters/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }

    /**
     * action_judges - action that open page where users can edit information about judges
     */
    public function action_judges()
    {
        $this->template->main_section = View::factory('events/characters/judges');
        $this->template->leftnav = View::factory('events/characters/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_participants - action that open page where users can edit information about participants
     */
    public function action_participants()
    {
        $this->template->main_section = View::factory('events/characters/participants');
        $this->template->leftnav = View::factory('events/characters/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_teams - action that open page where users can edit information about teams
     */
    public function action_teams()
    {
        $this->template->main_section = View::factory('events/characters/teams');
        $this->template->leftnav = View::factory('events/characters/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_groups - action that open page where users can edit information about groups
     */
    public function action_groups()
    {
        $this->template->main_section = View::factory('events/characters/groups');
        $this->template->leftnav = View::factory('events/characters/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
    }


    /**
     * action_eventpage - action that open event page which can see authorizated user and not authorizated users
     */
    public function action_eventpage()
    {
        $this->template->main_section = View::factory('events/page/main');
        $this->template->leftnav = View::factory('events/page/leftnav')
                ->set('orgpage', $this->organization->website)
                ->set('eventpage', $this->event->page);
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
