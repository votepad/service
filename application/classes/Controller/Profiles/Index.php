<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Profiles_Index
 *
 * @copyright Votepad Team
 * @author Turov Nikolay
 * @version 0.2.0
 */

class Controller_Profiles_Index extends Dispatch
{
    const ACTION_CONFIRM_EMAIL = 'confirm';

    public $template = 'main';

    protected $profile = null;

    private $privateActions = array('drafts','updates','settings');

    public function before()
    {

        parent::before();

        if (!self::isLogged()) throw new HTTP_Exception_401();

        $action = $this->request->action();

        if ($action == self::ACTION_CONFIRM_EMAIL) return;

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
            if ($this->profile->private == 1 || in_array($this->request->action(), $this->privateActions))
                throw new HTTP_Exception_403();
        }

        $this->template->title       = $profile->name;
        $this->template->description = "Просмотреть профиль " . $profile->name . " на сайте votepad.ru. VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря Votepad становиться проще и быстрее провести подсчет результатов!";
        $this->template->keywords    = "Профиль, Электронное голосование, Выставление баллов, Результат, Рейтинг, Страница с результатами, votepad, profile, voting, results, rating";
    }


    /**
     * Profile Page - show updates
     */
    public function action_updates()
    {
        $this->template->mainSection = View::factory('profile/content')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());

        $this->template->mainSection->page = View::factory('profile/pages/updates');
    }

    /**
     * Profile Page - show profile published events
     */
    public function action_events()
    {
        $this->template->mainSection = View::factory('profile/content')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());

        $this->template->mainSection->page = View::factory('profile/pages/events');
    }

    /**
     * Profile Page - show profile draft events
     */
    public function action_drafts()
    {
        $this->template->mainSection = View::factory('profile/content')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());

        $this->template->mainSection->page = View::factory('profile/pages/drafts');
    }

    /**
     * Profile Page - show profile settings
     */
    public function action_settings()
    {
        $this->template->mainSection = View::factory('profile/content')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());

        $this->template->mainSection->page = View::factory('profile/pages/settings');
    }



    public function action_confirm()
    {
        $hash = $this->request->param('hash');

        $id = $this->redis->get($_SERVER['CONFIRMATION_EMAIL_HASHES'] . $hash);

        if (!$id) {
            $this->redirect('/');
        }

        $user = new Model_User($id);
        $user->isConfirmed = 1;
        $user->update();

        $this->redis->delete($_SERVER['CONFIRMATION_EMAIL_HASHES'] . $hash);

        $this->redirect('/user/' . $id . '/settings');
    }


}
