<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Dispatch
 * @author ProNWE team
 * @copyright Khaydarov Murod`
 */

class Dispatch extends Controller_Template
{
    public $template = '';

    protected $errors;
    protected $_session;
    public $user;

    const POST = 'POST';
    const GET  = 'GET';

    function before()
    {
        /**$this->css = [
            "vendor/simple-line-icons/css/simple-line-icons.css",
            "vendor/fontawesome/css/font-awesome.min.css",
            "vendor/bootstrap/dist/css/bootstrap.css",
        ];

        array_push($this->css, 'vendor/whirl/dist/whirl.css');
        array_push($this->css, 'vendor/animate.css/animate.min.css');
        array_push($this->css, 'css/app.css');
        array_push($this->css, 'css/pronwe.css');

        $this->js = [
            "vendor/jquery/dist/jquery.js",
            "vendor/jquery.localize-i18n/dist/jquery.localize.js",
            "vendor/slimScroll/jquery.slimscroll.min.js",
        ];*/

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

        $this->_session = Session::instance();
        $this->setGlobals();

        parent::before();

        // XSS clean in POST and GET requests
//        self::XSSfilter();

    }

    public static function isLogged()
    {
        $session = Session::Instance();
        if ( empty($session->get('id_user')) )
            Controller::redirect('auth/');
    }

    private function setGlobals()
    {
        if (!empty($this->_session->get('id_user'))) {

            $id = $this->_session->get('id_user');

            $user = new ORM_User();
            $user->where('id', '=', $id)
                ->find();

            /** Authentificated User is visible in all pages */
            View::set_global('user', $user);
        }
        
        $address = 'http://' . $_SERVER['SERVER_NAME'] ;
        View::set_global('assets', $address . '/assets/');
    }
}