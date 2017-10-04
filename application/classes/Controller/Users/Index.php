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


    public function before()
    {
        parent::before();

        $id = $this->request->param('id');
        $this->profile = new Model_User($id);

        if (!$this->profile->id || !self::isLogged())
            throw new HTTP_Exception_404();

        $this->profile;
        $this->profile->isOwner = $this->user && $this->user->id == $id;

        if (!$this->profile->isOwner && $this->profile->private == 1)
            throw new HTTP_Exception_403();

        $this->template->title       = 'Профиль ' . $this->profile->name. ' | Votepad';
        $this->template->description = "Просмотреть профиль " . $this->profile->name . " на сайте votepad.ru. VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря Votepad становиться проще и быстрее провести подсчет результатов!";

        $this->template->header = View::factory('globalblocks/header')
            ->set('header_menu', View::factory('profile/blocks/header_menu'))
            ->set('header_menu_mobile', View::factory('profile/blocks/header_menu_mobile'));
    }

    /**
     * Main Profile Page
     */
    public function action_index()
    {
        $this->template->mainSection = View::factory('profile/content')
            ->set('profile', $this->profile);
    }
}
