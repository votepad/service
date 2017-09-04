<?php

/**
 * Class Controller_Welcome
 *
 * @copyright Votepad Team
 *
 * @author Khaydarov Murod
 * @author Turov Nikolay
 *
 * @version
 *
 */

class Controller_Welcome extends Dispatch
{
    public $template = 'welcome/main';
    protected $events = null;

    public function before()
    {
        parent::before();
    }

    /**
     * Welcome Page
     */
    public function action_index()
    {
        $this->get_events();

        $this->template->section = View::factory('welcome/landing')
                ->set('events', $this->events);

    }

    /**
     * VotePad Features
     */
    public function action_features()
    {
        $this->template->title = "Возможности | Votepad";
        $this->template->description = "";
        $this->template->keywords = "";
        $this->template->section = View::factory('welcome/features');
    }


    public function action_reset()
    {
        $hash = $this->request->param('hash');
        $id = $this->redis->get(getenv('REDIS_RESET_HASHES') . $hash);

        if (!$id) {
            throw new HTTP_Exception_400();
        }

        $this->get_events();

        $this->template->title = "Сброс пароля";
        $this->template->section = View::factory('welcome/landing')
            ->set('events', $this->events);
    }


    private function get_events()
    {
        $select = Dao_Events::select('id')
            ->order_by('id', 'DESC')
            ->execute();

        $this->events = array();

        if ( $select ) {
            foreach ($select as $eventId) {
                $this->events[] = new Model_Event($eventId['id']);
            }
        }

    }

}
