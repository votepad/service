<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @author Khaydarov Murod
 */


class Controller_Judges_Index extends Dispatch {

    public $template = 'events/judge-panel/main-jp';

    public function action_judgepanel1()
    {

        $this->template->title          = 'Вид панели 1';
        $this->template->description    = 'Описание страницы';
        $this->template->keywords       = 'C';

        array_push( $this->js,  'vendor/jquery.steps/jquery.steps.js');
        array_push( $this->js,  'js/judge-panel-1.js');
        array_push( $this->css, 'css/judge-panel-1.css');

        $this->template->css    = $this->css;
        $this->template->js     = $this->js;

        $this->template->section    = View::factory('events/judge-panel/views/judge-panel-view-1');

    }

    public function action_judgepanel2()
    {

        $this->template->title          = 'Вид панели 2';
        $this->template->description    = 'Описание страницы';
        $this->template->keywords       = 'C';

        array_push( $this->js,  'vendor/jquery.steps/jquery.steps.js');
        array_push( $this->js,  'js/judge-panel-2.js');
        array_push( $this->css, 'css/judge-panel-2.css');

        $this->template->css    = $this->css;
        $this->template->js     = $this->js;

        $this->template->section    = View::factory('events/judge-panel/views/judge-panel-view-2');

    }

}


?>