<?php
/**
 * Class Organizations_Index
 * All pages which has relationship with Organizations will be here
 * @author Pronwe team
 * @copyright Khaydarov Murod
 * @author Turov Nikolay
 * @version 0.1.2
 */

class Controller_Organizations_Index extends Dispatch
{

    /**
     * @const ACTION_NEW [String]
     */
    const ACTION_NEW = 'new';

    /**
     * @const ACTION_SHOW [String]
     */
    const ACTION_SHOW = 'show';

    /**
     * @const ACTION_SHOW_ALL [String]
     */
    const ACTION_SHOW_ALL = 'showAll';

    /**
     * @var $organization [String] - default value is null. Keeps cached render
     */
    protected $organization = null;

    /**
     * Function that calls before main action
     *
     * - Defines main template of actions
     * - Gets organization info
     * - Caches organization render
     */
    public function before()
    {
        switch ($this->request->action()) {
            /**
             * Two types of creating orgs: Logged and Not logged
             */
            case self::ACTION_NEW :
                $this->template = 'organizations/new_not_logged';
                break;

            /**
             * default template
             */
            default :
                $this->template = 'organizations/main';
                break;
        }

        parent::before();

        /**
         * @var $id - organization identificator
         */
        $id = $this->request->param('id');

        $this->organization = Model_Organizations::get($id, 0);

        if (!$this->organization && $this->request->action() != self::ACTION_NEW) {
            throw new HTTP_Exception_404();
        }

        /**
         * Organization info
         */
        $this->template->organization = $this->organization;

        if ($this->organization != false) {

            /**
            * Header
            * + header navigation (Logged && ! Logged)
            * + authorization modal
            */
            $this->template->header = View::factory('/organizations/blocks/header')
                ->set('auth_modal', View::factory('welcome/blocks/auth_modal'))
                ->set('organization', $this->organization);


            /**
            * Jumbotron Wrapper
            * - without navigation
            */
            $this->template->jumbotron_wrapper = View::factory('organizations/blocks/jumbotron_wrapper')
                ->set('organization', $this->organization);

            /**
            * Get all menus items in Jumbotron Navigation
            */
            $this->template->menus = Kohana::$config->load('topnav')->as_array();


            /**
            * Footer
            */
            $this->template->footer = View::factory('organizations/blocks/footer');


        }

    }


    /**
     *
     * action_new - open new organization form
     * Doesn't need any variables
     */
    public function action_new()
    {
        $isUserAuthenitfied = !empty($this->session->get('id_user'));
        if ($isUserAuthenitfied) {
            throw new HTTP_Exception_404;
        }
    }


    /**
     * EVENTS submodule
     * action_show - shows events of target organization
     */
    public function action_show()
    {
        /**
        * Jumbotron Navigation
        * - searching events on page
        */
        $this->template->jumbotron_navigation = View::factory('organizations/events/jumbotron_navigation')
            ->set('id', $this->organization->id);;

        $this->template->main_section = '';


    }


    /**
     * SETTINGS submodule
     * action_main - main information about target organization
     */
    public function action_main()
    {
        /**
        * Jumbotron Navigation
        * - show all tabs of SETTINGS submodule - menu with roles
        */
        $this->template->jumbotron_navigation = View::factory('organizations/settings/jumbotron_navigation')
            ->set('menus', $this->template->menus)
            ->set('id', $this->organization->id);



        $topmenu = View::factory('organizations/blocks/topmenu')
            ->set('menus', $this->template->menus)
            ->set('id', $this->organization->id);

        /**
         * Content of target menu
         */
        $this->template->main_section = View::factory('organizations/settings/main')
                ->set('organization', $this->organization)
                ->set('topmenu', $topmenu);

        $isLogged = Dispatch::isLogged();
        $owner    = Model_PrivillegedUser::getUserOrganization($this->session->get('id_user')) == $this->organization->id;

        if (!$isLogged || !$owner) {
            $this->redirect('/organization/' . $this->organization->id);
        }
    }


    /**
     * SETTINGS submodule
     * action_team - shows team of target organization
     */
    public function action_team()
    {
        /** @var $topmenu
         * Top menu with roles
         */
        $topmenu = View::factory('organizations/blocks/topmenu')
            ->set('menus', $this->template->menus)
            ->set('id', $this->organization->id);

        /**
         * Content of target menu
         */
        $this->template->main_section = View::factory('organizations/settings/team')
            ->set('organization', $this->organization)
            ->set('topmenu', $topmenu);

        $isLogged = Dispatch::isLogged();
        $owner    = Model_PrivillegedUser::getUserOrganization($this->session->get('id_user')) == $this->organization->id;

        if (!$isLogged || !$owner) {
            $this->redirect('/organization/' . $this->organization->id);
        }
    }

}
