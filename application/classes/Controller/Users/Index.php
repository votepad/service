<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Users_Index
 *
 * @copyright Votepad Team
 * @author Turov Nikolay
 * @version 0.2.0
 */

class Controller_Users_Index extends Dispatch
{
    public $template = 'main';

    /**
     * @const ACTION_RESET [String] - reset user password
     */
    const ACTION_RESET = 'reset';

    /**
     * Profile owner
     * @var null
     */
    public $profile = null;


    public function before()
    {
        parent::before();

        if ($this->request->action() == self::ACTION_RESET)
            return;

        $id = $this->request->param('id');
        $this->profile = new Model_User($id);

        if (!$this->profile->id)
            throw new HTTP_Exception_404();

        $this->profile->isOwner = self::isLogged() && $this->user && $this->user->id == $id;

        if (!$this->profile->isOwner && $this->profile->private == 1)
            throw new HTTP_Exception_403();

        $this->template->title       = 'Профиль ' . $this->profile->name;
        $this->template->description = "Просмотреть профиль " . $this->profile->name . " на сайте votepad.ru. VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря Votepad становиться проще и быстрее провести подсчет результатов!";

        $this->template->mainSection = View::factory('profiles/content')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());
    }

    /**
     * Main Profile Page
     * - show all published events
     */
    public function action_index()
    {
        $events = $this->profile->getEvents();

        $this->template->mainSection->page = View::factory('profiles/pages/events')
            ->set('events', $events)
            ->set('profile', $this->profile);
    }

    /**
     * Show unpublished events
     * @throws HTTP_Exception_403
     */
    public function action_drafts()
    {
        if (!$this->profile->isOwner)
            throw new HTTP_Exception_403;

        $this->template->mainSection->page = View::factory('profiles/pages/drafts')
            ->set('profile', $this->profile);
    }

    /**
     * Show unpublished events
     * @throws HTTP_Exception_403
     */
    public function action_settings()
    {
        if (!$this->profile->isOwner)
            throw new HTTP_Exception_403;

        $this->template->mainSection->page = View::factory('profiles/pages/settings')
            ->set('profile', $this->profile);
    }

    /**
     * Reset User Password
     * @throws HTTP_Exception_400
     */
    public function action_reset()
    {
        $hash = $this->request->param('hash');

        $id = $this->redis->get(getenv('REDIS_RESET_HASHES') . $hash);
        if (!$id)
            throw new HTTP_Exception_400();

        $this->template = View::factory('profiles/pages/reset');
    }
}
