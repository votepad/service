<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 21.03.2016
 * Time: 0:59
 */

class Controller_Test extends Dispatch {

    //public $template = 'main';
    public $template = 'test/file';

    public function action_index()
    {
        /*$this->template->title          = 'Тестирование страницы';
        $this->template->description    = 'Тест';
        $this->template->keywords       = 'Тест';*/

        $this->template->css = $this->css;
        $this->template->js = $this->js;

        //$this->template->aside      = View::factory('aside');
        //$this->template->section    = View::factory('test/file');
    }
}