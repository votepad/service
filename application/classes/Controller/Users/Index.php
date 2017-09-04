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
     * Profile owner
     * @var null
     */
    public $profile = null;

    /**
     * Action to which only profile owner has access
     * @var array
     */
    private $privateActions = array('drafts','updates','settings');


    public function before()
    {

        parent::before();

        $action = $this->request->action();

        if (!self::isLogged())
            throw new HTTP_Exception_401();

        $id = $this->request->param('id');
        $profile = new Model_User($id);

        if (!$profile->id) throw new HTTP_Exception_404();

        $this->profile = $profile;
        $this->profile->isOwner = $this->user && $this->user->id == $id;

        if ($action == 'index') {
            if ($this->profile->isOwner) {
                $this->request->action('updates');
            } else {
                $this->request->action('events');
            }
        }

        if (!$this->profile->isOwner) {
            if ($this->profile->private == 1 || in_array($this->request->action(), $this->privateActions)) {
                throw new HTTP_Exception_403();
            }
        }

        $this->template->title       = $profile->name;
        $this->template->description = "Просмотреть профиль " . $profile->name . " на сайте votepad.ru. VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря Votepad становиться проще и быстрее провести подсчет результатов!";
    }


    /**
     * User Page - show updates
     */
    public function action_updates()
    {
        $this->template->mainSection = View::factory('profile/content')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());

        $this->template->mainSection->page = View::factory('profile/pages/updates');
    }

    /**
     * User Page - show profile published events
     */
    public function action_events()
    {
        $this->template->mainSection = View::factory('profile/content')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());

        $this->template->mainSection->page = View::factory('profile/pages/events');
    }

    /**
     * User Page - show profile draft events
     */
    public function action_drafts()
    {
        $this->template->mainSection = View::factory('profile/content')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());

        $this->template->mainSection->page = View::factory('profile/pages/drafts');
    }

    /**
     * User Page - show profile settings
     */
    public function action_settings()
    {
        $this->template->mainSection = View::factory('profile/content')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());

        $this->template->mainSection->page = View::factory('profile/pages/settings');
    }

}
