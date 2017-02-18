<?php
/**
 * Class Organizations_Index
 * All pages which has relationship with Organizations will be here
 * @author Pronwe team
 * @copyright Khaydarov Murod
 * @copyright Turov Nikolay
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
           * Jumbotron
           */
          $this->template->jumbotron = View::factory('organizations/blocks/jumbotron')
              ->set('organization', $this->organization);


          /**
           * Header
           * + header navigation
           */
           $this->template->header = View::factory('/organizations/blocks/header')
                ->set('auth_modal', View::factory('welcome/blocks/auth_modal'))
                ->set('organization', $this->organization);




          $this->template->navigation = View::factory('organizations/blocks/navigation')
              ->set('id', $this->organization->id);

          /**
           * get all menus of top navigation bar
           */
          $this->template->menus = $menus = Kohana::$config->load('topnav')->as_array();

        }

    }

    /**
     * New organization form
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
     * Shows events of target organization
     */
    public function action_show()
    {

        $this->template->main_section = '';


    }

    /**
     * Organizations team
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

    /**
     * Main information about target organization
     */
    public function action_main()
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
        $this->template->main_section = View::factory('organizations/settings/main')
                ->set('organization', $this->organization)
                ->set('topmenu', $topmenu);

        //$isLogged = Dispatch::isLogged();
        $owner    = Model_PrivillegedUser::getUserOrganization($this->session->get('id_user')) == $this->organization->id;

        if (!$isLogged || !$owner) {
            $this->redirect('/organization/' . $this->organization->id);
        }
    }

}
