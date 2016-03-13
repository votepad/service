<?php
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 13.03.2016
 * Time: 13:01
 */

class Controller_Events_Index extends Dispatch {

    public $template = 'main';

    public function action_index()
    {

    }

    public function action_new()
    {
        array_push( $this->css, 'vendor/chosen_v1.2.0/chosen.min.css');
        array_push( $this->js,  'vendor/chosen_v1.2.0/chosen.jquery.min.js');

        $this->template->aside      = View::factory('aside');
        $this->template->section    = View::factory('events/new-event');

        $this->template->css    = $this->css;
        $this->template->assets = $this->assets;
        $this->template->js     = $this->js;
    }
}