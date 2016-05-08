<?php
/**
 * Created by PhpStorm.
 * User: behzodqurbonov
 * Date: 29.04.16
 * Time: 14:40
 */

class Controller_Miss extends Controller {

    //public $template = 'miss/miss';

    public function action_index() {
        /*$this->template->title          = 'Miss ITMO';
        $this->template->description    = 'Главный сайт мероприятия Мисс ИТМО 2016';
        $this->template->keywords       = 'missitmo';*/

        $view = View::factory('miss/miss')
                            ->set('assets', 'http://pronwe.local/assets/');
        echo $view;
    }

    public function action_participants() {
        $view = View::factory('miss/participants')
            ->set('assets', 'http://pronwe.local/assets/');

        echo $view;
    }

    public function action_partners() {
        $view = View::factory('miss/partners')
            ->set('assets', 'http://pronwe.local/assets/');

        echo $view;
    }


}