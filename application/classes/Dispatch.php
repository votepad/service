<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 22.02.2016
 * Time: 12:33
 */

class Dispatch extends Controller_Template {

    public $template = '';

    public $css = array();
    public $js = array();

    protected $assets;

    function before() {

        $this->assets = "http://localhost/pronwe/assets/";

        $this->css = [
            "simple-line-icons.css",
        ];

        $this->js = [
            "jquery.js",
            "jquery.localize.js",
            "jquery.slimscroll.min.js",
            "jquery-2.2.0.min.js",
            "modernizr.custom.js",
            "screenfull.js",
        ];

        parent::before();
    }

}