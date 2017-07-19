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
    public $template = 'main';

    protected $profile = null;

    public function before()
    {

        parent::before();

        if (!self::isLogged()) throw new HTTP_Exception_401();

        $id = $this->request->param('id');
        $profile = new Model_User($id);

        if (!$profile->id) throw new HTTP_Exception_404();

        $this->profile = $profile;
        $this->profile->isOwner = $this->user && $this->user->id == $id;

        if ($this->request->action() == 'index') {
            if ($this->profile->isOwner) {
                $this->request->action('updates');
            } else {
                $this->request->action('events');
            }
        }


        $this->template->title       = $profile->name. ' ' . $profile->surname;
        $this->template->description = "Просмотреть профиль " . $profile->name. ' ' . $profile->surname . " на сайте votepad.ru. VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря Votepad становиться проще и быстрее провести подсчет результатов!";
        $this->template->keywords    = "Профиль, Электронное голосование, Выставление баллов, Результат, Рейтинг, Страница с результатами, votepad, profile, voting, results, rating";

        $this->template->header = View::factory('globalblocks/header')
            ->set('header_menu', View::factory('profile/blocks/header_menu'))
            ->set('header_menu_mobile', View::factory('profile/blocks/header_menu_mobile'));
    }


    /**
     * Profile Page - show updates
     */
    public function action_updates()
    {
        $this->template->mainSection = View::factory('profile/pages/main')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());
    }

    /**
     * Profile Page - show profile published events
     */
    public function action_events()
    {
        $this->template->mainSection = View::factory('profile/pages/main')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());
    }

    /**
     * Profile Page - show profile draft events
     */
    public function action_drafts()
    {
        $this->template->mainSection = View::factory('profile/pages/main')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());
    }

    /**
     * Profile Page - show profile settings
     */
    public function action_settings()
    {
        $this->template->mainSection = View::factory('profile/pages/main')
            ->set('profile', $this->profile)
            ->set('action', $this->request->action());
    }

}
