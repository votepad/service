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
    protected $_cache;
    protected $_session;
    public    $user;

    const POST = 'POST';
    const GET  = 'GET';

    function before()
    {
        $GLOBALS['SITE_NAME']   = "ProNWE";
        $GLOBALS['FROM_ACTION'] = $this->request->action();

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

        if ($this->auto_render) {
            // Initialize with empty values
            $this->template->title = $this->title = $GLOBALS['SITE_NAME'];
            $this->template->keywords    = '';
            $this->template->description = '';
            $this->template->content     = '';
        }

    }

    /**
    * The after() method is called after your controller action.
    * In our template controller we override this method so that we can
    * make any last minute modifications to the template before anything
    * is rendered.
    */
    public function after()
    {
        echo View::factory('profiler/stats');

        parent::after();
    }

    /**
    * Sanitizes GET and POST params
    * @uses HTMLPurifier
    * @todo Rewrite under ProNWE
    */
    public function XSSfilter()
    {
        $exceptions = array( 'long_desc' , 'blog_text', 'long_description' , 'content',
                             'article_text', 'contest_text', 'results_contest' ); // Исключения для полей с визуальным редактором

        foreach ($_POST as $key => $value){

            $value = stripos( $value, 'سمَـَّوُوُحخ ̷̴̐خ ̷̴̐خ ̷̴̐خ امارتيخ ̷̴̐خ') !== false ? '' : $value ;

            if ( in_array($key, $exceptions) === false ){
                $_POST[$key] = Security::xss_clean(HTML::chars($value));
            } else {
                $_POST[$key] = Security::xss_clean( strip_tags(trim($value), '<br><em><del><p><a><b><strong><i><strike><blockquote><ul><li><ol><img><tr><table><td><th><span><h1><h2><h3><iframe><div><code>'));
            }
        }

        foreach ($_GET  as $key => $value) {
            $value = stripos( $value, 'سمَـَّوُوُحخ ̷̴̐خ ̷̴̐خ ̷̴̐خ امارتيخ ̷̴̐خ') !== false ? '' : $value ;
            $_GET[$key] = Security::xss_clean(HTML::chars($value));
        }
    }

    public static function isLogged()
    {
        $session = Session::Instance();
        if ( empty($session->get('id_user')) )
            Controller::redirect('auth/');
    }

    /**
     * @todo
     * Попробовать в бою Redis
     */
    public static function _redis()
    {

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
        View::set_global('website', $address);

        /** Set caching method */
        $this->_cache = Cache::instance();
    }
}