<?php


class Controller_Judges_Panels_Index extends Dispatch {

    public $template = 'events/judge-panel/panel-2';

    public function action_panel2()
    {
        array_push( $this->css, 'css/judge.panel-2.css');
        array_push( $this->js,  'vendor/jquery.steps/jquery.steps.js');
        array_push( $this->js,  'js/judge.panel-2.js');

        $this->template->css    = $this->css;
        $this->template->js     = $this->js;
    }


}