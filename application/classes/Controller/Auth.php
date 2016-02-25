<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 22.02.2016
 * Time: 12:32
 */

class Controller_Auth extends Dispatch {

    public $template = 'auth/auth';

    function action_signin()
    {
        array_push( $this->css, 'font-awesome.min.css');
        array_push( $this->css, 'ownPronwe.css');
        array_push( $this->css, 'auth.css');


        $this->template->css = $this->css;
        $this->template->js = $this->js;
        $this->template->assets = $this->assets;



    }

}

?>