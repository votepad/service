<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 22.02.2016
 * Time: 12:33
 */

class Dispatch extends Controller_Template
{

    public $template = '';

    public $css = array();
    public $js = array();

    protected $errors;

    public $user;

    function before()
    {
        $this->css = [
            "vendor/simple-line-icons/css/simple-line-icons.css",
            "vendor/fontawesome/css/font-awesome.min.css",
        ];

        array_push($this->css, 'vendor/whirl/dist/whirl.css');
        array_push($this->css, 'vendor/animate.css/animate.min.css');
        array_push($this->css, 'css/bootstrap.css');
        array_push($this->css, 'css/app.css');
        array_push($this->css, 'css/pronwe.css');


        $this->js = [
            "vendor/jquery/dist/jquery.js",
            "vendor/jquery.localize-i18n/dist/jquery.localize.js",
            "vendor/slimScroll/jquery.slimscroll.min.js",
            "vendor/jQuery-Storage-API/jquery.storageapi.js",
        ];

        array_push($this->js, 'vendor/bootstrap/dist/js/bootstrap.js');
        array_push($this->js, 'vendor/cropper/dist/cropper.js');
        array_push($this->js, 'js/app.js');
        array_push($this->js, 'js/twitter.js');


        /** Disallow requests from other domains */

        if (Kohana::$environment === Kohana::PRODUCTION) {
            if ((Arr::get($_SERVER, 'SERVER_NAME') != '') &&
                (Arr::get($_SERVER, 'SERVER_NAME') != '')
            ) {
                exit();
            }
            /** Mark requests as secure and working with HTTPS  */
            $this->request->secure(true);
        }

        $this->setGlobals();

        parent::before();

        // XSS clean in POST and GET requests
        //self::XSSfilter();

    }

    public static function isLogged()
    {
        $session = Session::Instance();
        if ( empty($session->get('user_id')) )
            Controller::redirect('/auth');
    }

    private function setGlobals()
    {
        $this->user = Model_User::Instance();
        View::set_global('user', $this->user);

        View::set_global('assets', 'http://localhost/pronwe/assets/');
    }
}