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

        $id = $this->request->param('id');
        $profile = new Model_User($id);

        if (!$profile->id) throw new HTTP_Exception_404();

        $this->profile = $profile;
        $this->profile->isOwner = $this->user && $this->user->id == $id;

        $this->template->title       = $profile->name. ' ' . $profile->surname;
        $this->template->description = "Просмотреть профиль " . $profile->name. ' ' . $profile->surname . " на сайте votepad.ru. VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря Votepad становиться проще и быстрее провести подсчет результатов!";
        $this->template->keywords    = "Профиль, Электронное голосование, Выставление баллов, Результат, Рейтинг, Страница с результатами, votepad, profile, voting, results, rating";

        $this->template->header = View::factory('globalblocks/header')
            ->set('header_menu', View::factory('profile/blocks/header_menu'))
            ->set('header_menu_mobile', View::factory('profile/blocks/header_menu_mobile'));
    }


    /**
     * Main Profile Page
     */
    public function action_index()
    {
        $this->template->mainSection = View::factory('profile/pages/main')
            ->set('profile', $this->profile);
    }
}
