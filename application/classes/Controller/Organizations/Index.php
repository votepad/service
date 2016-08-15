<?php
/**
 * Class Organizations_Index
 * All pages which has relationship with Organizations will be here
 * @author Pronwe team
 * @copyright Khaydarov Murod
 */

class Controller_Organizations_Index extends Dispatch
{
    protected $id_organization = null;

    public function before()
    {
        switch ($this->request->action()) {
            /**
             * Рассматриваем 2 случая добавления организации - Авторизованный и неавторизованный
             */
            case 'new' :

                if (self::isLogged()) {
                    $this->template = 'organizations/new_logged';
                } else {
                    $this->template = 'organizations/new_not_logged';
                }

                break;

            /**
             * Шаблон для организаций (по умолчанию)
             */
            default :
                $this->template = 'organizations/main';
                break;
        }

        parent::before();

        /** @var $id - organization identificator */
        $this->template->id = $this->id_organization = $this->request->param('id');
    }

    /** New organization form */
    public function action_new()
    {

    }

    /** Shows organization */
    public function action_show()
    {
        $this->template->main_section = View::factory('organizations/events/all');
    }

    /** Shows list of organizations */
    public function action_showAll()
    {

    }

    /**
     * Organizations Settings
     */
    public function action_balance()
    {
        $this->template->main_section = View::factory('organizations/settings/balance')
            ->set('id', $this->id_organization);
    }

    public function action_logs()
    {
        $this->template->main_section = View::factory('organizations/settings/logs')
            ->set('id', $this->id_organization);
    }

    public function action_team()
    {
        $this->template->main_section = View::factory('organizations/settings/team')
            ->set('id', $this->id_organization);
    }

    /**
     * @todo
     * Перепроверить кэширование в Kohana. Сейчас использует файловый драйвер
     * Возможно нужно будет перейти на memcacheimp
     */
    public function action_main()
    {
        $organization_cached = $this->_cache->get('organization_' . $this->id_organization);

        if (isset($organization_cached)) {
            $organization = $organization_cached;
        } else {
            $organization = Model_Organizations::get($this->id_organization);
            $this->_cache->set('organization_' . $this->id_organization, $organization);
        }

        if ($organization !== false)
        {
            $creator = Model_Organizations::get_creator($organization->user_created);
        }

        $this->template->main_section = View::factory('organizations/settings/main')
                ->set('id', $this->id_organization)
                ->set('organization', $organization)
                ->set('creator', $creator);
    }

}