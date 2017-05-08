<?php
/**
 * Class Organizations_Index
 * All pages which has relationship with Organizations will be here
 * @copyright Khaydarov Murod
 * @author Turov Nikolay
 * @version 0.2.1
 */

class Controller_Organizations_Index extends Dispatch
{

    /**
     * @const ACTION_NEW [String]
     */
    const ACTION_NEW = 'new';

    /**
     * @const ACTION_NEW [String]
     */
    const ACTION_NEW_EVENT = 'new_event';


    /**
     * @var $organization [String] - default value is null. Keeps cached render
     */
    protected $organization = null;

    public $template = 'main';

    public function before()
    {

        parent::before();

        /**
         * @var $id - organization identificator
         */
        $id = $this->request->param('id');

        $this->organization = new Model_Organization($id);

        if (!$this->organization->id
                && $this->request->action() != self::ACTION_NEW
                || $this->organization->is_removed) {

            throw new HTTP_Exception_404();

        }

        /**
         * Organization info
         */
        $this->template->organization = $this->organization;

        $this->template->title = $this->organization->name;
        $this->template->description = $this->organization->description;

        /** Header */
        $data = array(
            'organization'  => $this->organization,
            'action'        => $this->request->action()
        );
        $this->template->header = View::factory('globalblocks/header')
            ->set('header_menu_mobile', View::factory('organizations/blocks/header_menu_mobile', $data))
            ->set('header_menu', View::factory('organizations/blocks/header_menu', $data));

    }

    /**
     * action_new - open new organization form
     * Doesn't need any variables
     */
    public function action_new()
    {
        if (!$this->isLogged()) {

            throw new HTTP_Exception_403;

        }
        $this->template->title = "Новая организация";
        $this->template->mainSection = View::factory('organizations/new');
    }

    /**
     * EVENTS submodule
     * action_show - shows events of target organization
     */
    public function action_show()
    {

        $events = Methods_Organizations::getAllEvents($this->organization->id);

        $this->template->mainSection = View::factory('organizations/events/content')
            ->set('organization', $this->organization)
            ->set('events', $events);

        $this->template->mainSection->jumbotron_navigation = View::factory('organizations/events/jumbotron_navigation')
            ->set('isSendRequest', $this->redis->sMembers('votepad.orgs:'.$this->organization->id.':join.requests'))
            ->set('organization', $this->organization);

    }


    /**
     * SETTINGS submodule
     * action_main - main information about target organization
     */
    public function action_main()
    {

        if (!$this->organization->isOwner($this->user->id ? $this->user->id : 0)) {
            throw new HTTP_Exception_403();
        }

        $this->template->mainSection = View::factory('organizations/settings/maininfo')
            ->set('organization', $this->organization);

    }


    /**
     * SETTINGS submodule
     * action_team - shows team of target organization
     */
    public function action_team()
    {

        if (!$this->organization->isOwner($this->user ? $this->user->id : 0)) {
            throw new HTTP_Exception_403();
        }

        $this->organization->team = $this->organization->getTeam();
        $requests_ids = $this->redis->sMembers('votepad.orgs:'.$this->organization->id.':join.requests');

        $this->organization->requests = array();

        foreach ($requests_ids as $id) {
            array_push($this->organization->requests, new Model_User($id));
        }

        $this->template->mainSection = View::factory('organizations/settings/coworkers')
            ->set('organization', $this->organization);

    }

    /**
     * NEW EVENT
     * action_new - action that open page where users create new event
     */
    public function action_new_event()
    {

        $this->template->title = "Новое мероприятие";

        $this->template->mainSection = View::factory('events/new')
            ->set('idOrg', $this->organization->id);

    }


}
