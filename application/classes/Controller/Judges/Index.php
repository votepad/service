<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @author Khaydarov Murod
 */


class Controller_Judges_Index extends Dispatch {

    public $template = 'events/judge-panel/panel-1';

    public function action_panel1()
    {
        array_push( $this->css, 'vendor/fontawesome/css/font-awesome.min.css');
        array_push( $this->css, 'css/judge.panel.css');

        array_push( $this->js,  'vendor/jquery.steps/jquery.steps.js');
        array_push( $this->js,  'js/judge.panel.js');
        array_push( $this->js,  'js/app.js');

        $this->template->css    = $this->css;
        $this->template->js     = $this->js;
    }

}


?>