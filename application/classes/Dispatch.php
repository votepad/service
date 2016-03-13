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
    protected $errors;

    function before() {

        $this->assets = "http://localhost/pronwe/assets/";

        $this->css = [
            "css/simple-line-icons.css",
        ];

        array_push( $this->css, 'css/font-awesome.min.css');
        array_push( $this->css, 'vendor/whirl/dist/whirl.css');
        array_push( $this->css, 'vendor/animate.css/animate.min.css');
        array_push( $this->css, 'vendor/cropper/dist/cropper.css');
        array_push( $this->css, 'css/bootstrap.css');
        array_push( $this->css, 'css/app.css');
        array_push( $this->css, 'css/pronwe.css');


        $this->js = [
            "jquery.js",
            "jquery.localize.js",
            "jquery.slimscroll.min.js",
            "jquery-2.2.0.min.js",
            "modernizr.custom.js",
            "screenfull.js",
        ];

        array_push( $this->js, 'vendor/jquery/dist/jquery.js');
        array_push( $this->js, 'vendor/bootstrap/dist/js/bootstrap.js');
        array_push( $this->js, 'vendor/jQuery-Storage-API/jquery.storageapi.js');
        array_push( $this->js, 'vendor/jquery-localize-i18n/dist/jquery.localize.js');
        array_push( $this->js, 'vendor/cropper/dist/cropper.js');
        array_push( $this->js, 'js/app.js');
        array_push( $this->js, 'js/twitter.js');
        array_push( $this->js, 'http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU');

        parent::before();
    }

}