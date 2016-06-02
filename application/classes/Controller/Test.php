<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 21.03.2016
 * Time: 0:59
 */

class Controller_Test extends Dispatch {

    public $template = 'test/';

    public function action_Organization(){

        $this->template->title  = '';

        array_push( $this->css, 'css/app0.css');
        array_push( $this->js, 'js/app0.js');

        $this->template->css = $this->css;
        $this->template->js = $this->js;
        $this->template->section = View::factory('/');
    }

}
