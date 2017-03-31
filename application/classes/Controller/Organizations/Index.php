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
     * @var $organization [String] - default value is null. Keeps cached render
     */
    protected $organization = null;


    public function before()
    {
        switch ($this->request->action()) {

            /**
             * default template
             */
            default :
                $this->template = 'main';
                break;
        }

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

        $isOwner = $isMember = false;

        if ($this->organization->id) {

            if ($this->user) {
                $isOwner  = $this->organization->isOwner($this->user->id);
                $isMember = $this->organization->isMember($this->user->id);
            }

            /**
             * Meta Dates
             */
            $this->template->title = $this->organization->name;
            $this->template->description = $this->organization->description;

        }

        /** Header */
        $data = array(
            'organization' => $this->organization,
            'isOwner' => $isOwner,
            'isMember' => $isMember
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

        $this->template->mainSection = View::factory('organizations/new');
    }

    /**
     * EVENTS submodule
     * action_show - shows events of target organization
     */
    public function action_show()
    {
        /**
         * Jumbotron Navigation
         */
        $this->template->jumbotron_navigation = View::factory('organizations/events/jumbotron_navigation')
            ->set('isMember', $this->isMember)
            ->set('isOwner', $this->isOwner)
            ->set('userID', $this->user->id)
            ->set('id', $this->organization->id);

        $this->template->mainSection = View::factory('organizations/events/main')
            ->set('organization', $this->organization)
            ->set('isSendRequest', $this->redis->sMembers('votepad.orgs:'.$this->organization->id.':join.requests'));

    }


    /**
     * SETTINGS submodule
     * action_main - main information about target organization
     */
    public function action_main()
    {

        if (!$this->isOwner) {
            throw new HTTP_Exception_403();
        }

        /**
         * Jumbotron Navigation
         */
        $this->template->jumbotron_navigation = View::factory('organizations/settings/jumbotron_navigation')
            ->set('id', $this->organization->id);


        /**
         * Main Section
         */
        $this->template->main_section = View::factory('organizations/settings/main')
                ->set('organization', $this->organization);

    }


    /**
     * SETTINGS submodule
     * action_team - shows team of target organization
     */
    public function action_team()
    {

        if (!$this->isOwner) {
            throw new HTTP_Exception_403();
        }

        $this->organization->team = $this->organization->getTeam();
        $requests_ids = $this->redis->sMembers('votepad.orgs:'.$this->organization->id.':join.requests');

        $this->organization->requests = array();

        foreach ($requests_ids as $id) {
            array_push($this->organization->requests, new Model_User($id));
        }

        /**
         * Jumbotron Navigation
         */
        $this->template->jumbotron_navigation = View::factory('organizations/settings/jumbotron_navigation')
            ->set('id', $this->organization->id);


        /**
         * Main Section
         */
        $this->template->main_section = View::factory('organizations/settings/coworkers')
                ->set('organization', $this->organization);


    }

}
