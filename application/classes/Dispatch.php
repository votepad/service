<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 22.02.2016
 * Time: 12:33
 */

class Dispatch extends Controller_Template
{
    const POST = 'POST';
    const GET  = 'GET';
    const REDIS_SALTS_KEY = 'votepad:salts:';

    /** @var string - Path to template */
    public $template = '';

    /** @var $errors - Page erros */
    protected $errors;

    /** @var  $memcache - Memcache */
    protected $memcache;

    /** @var $redis - Redis instance */
    protected $redis;

    /** @var  $session - Session singleton instance */
    protected $session;

    /** @var  $user - Current user */
    public    $user;

    function before()
    {
        $GLOBALS['SITE_NAME']   = "Votepad";
        $GLOBALS['FROM_ACTION'] = $this->request->action();

        // XSS clean in POST and GET requests
        self::XSSfilter();

        $driver = 'native';
        $this->session = self::sessionInstance($driver);
        $this->setGlobals();

        // XSS clean in POST and GET requests
        self::XSSfilter();

        parent::before();

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
//        echo View::factory('profiler/stats');

        parent::after();
    }

    /**
    * Sanitizes GET and POST params
    * @uses HTMLPurifier
    * @todo Rewrite under ProNWE
    */
    public function XSSfilter()
    {
        /**
         * @var array Исключения для полей с визуальным редактором
         */
        $exceptionsAllowingHTML = array( 'contest_text', 'results_contest' );
        /**
         * Exception for CodeX Editor that has own sanitize methods in vendor package
         * @var array
         */
        $exceptionsForCodexEditor = array('article_json');
        foreach ($_POST as $key => $value){
            if (is_array($value)) {
                foreach ($value as $sub_key => $sub_value) {
                    $sub_value = stripos( $sub_value, 'سمَـَّوُوُحخ ̷̴̐خ ̷̴̐خ ̷̴̐خ امارتيخ ̷̴̐خ') !== false ? '' : $sub_value ;
                    $_POST[$key][$sub_key] = Security::xss_clean(HTML::chars($sub_value));
                }
                continue;
            }
            $value = stripos($value, 'سمَـَّوُوُحخ ̷̴̐خ ̷̴̐خ ̷̴̐خ امارتيخ ̷̴̐خ') !== false ? '' : $value ;
            /**
             * $exceptionsAllowingHTML — allow html tags (does not fire HTML Purifier)
             * $exceptionsForCodexEditor — do nothing
             */
            if ( in_array($key, $exceptionsAllowingHTML) === false && in_array($key, $exceptionsForCodexEditor) === false){
                $_POST[$key] = Security::xss_clean(HTML::chars($value));
            } elseif (in_array($key, $exceptionsForCodexEditor) === false) {
                $_POST[$key] = strip_tags(trim($value), '<br><em><del><p><a><b><strong><i><strike><blockquote><ul><li><ol><img><tr><table><td><th><span><h1><h2><h3><iframe><div><code>');
            }
        }
        foreach ($_GET  as $key => $value) {
            $value = stripos( $value, 'سمَـَّوُوُحخ ̷̴̐خ ̷̴̐خ ̷̴̐خ امارتيخ ̷̴̐خ') !== false ? '' : $value ;
            $_GET[$key] = Security::xss_clean(HTML::chars($value));
        }
    }

    /**
     * Return "True" if user is logged
     * @return bool
     */
    public static function isLogged()
    {
        $session = Session::Instance();

        return !empty($session->get('uid')) ||  !empty($session->get('j_id'));

    }

    /**
     * Return True if user had logged
     * @return bool
     */
    public static function hadLogged()
    {
        $secret = Cookie::get('secret', '');
        $uid = Cookie::get('uid', '');
        $sid = Cookie::get('sid', '');

        if ($secret && $uid && $sid) {
            return true;
        }

        return false;
    }

    /**
     * Can user login or not
     */
    public static function canLogin()
    {
        $isLogged  = self::isLogged();
        $hadLogged = self::hadLogged();

        $canLogin = false;

        if ($isLogged || (!$isLogged && $hadLogged))
            $canLogin = true;

        return $canLogin;
    }

    /**
     * Redis connection
     */
    public static function redisInstance()
    {
        $config = Kohana::$config->load('redis.default');

        $redis = new Redis();
        $redis->connect($config['hostname'], $config['port']);
        $redis->auth($config['password']);
        $redis->select(0);

        return $redis;
    }

    public static function memcacheInstance()
    {
        return Cache::instance('memcache');
    }

    public static function sessionInstance($driver)
    {
        return Session::instance($driver);
    }

    private function setGlobals()
    {
        if (self::canLogin()) {

            $uid = $this->session->get('uid') ?: (int) Cookie::get('uid');
            $user = new Model_User($uid);

        } else {

            $user = null;

        }

        View::set_global('user', $user);
        $this->user = $user;


        View::set_global('isLogged', self::isLogged());
        View::set_global('canLogin', self::canLogin());

        $address = Arr::get($_SERVER, 'HTTP_ORIGIN');

        View::set_global('assets', $address . DIRECTORY_SEPARATOR. 'assets' . DIRECTORY_SEPARATOR);
        View::set_global('website', $address);

        $this->memcache = self::memcacheInstance();
        $this->redis    = self::redisInstance();

        $this->setSaltsToRedis();

    }

    private function setSaltsToRedis() {

        $this->redis->set(self::REDIS_SALTS_KEY . 'organizer', Controller_Auth_Organizer::AUTH_ORGANIZER_SALT);
        $this->redis->set(self::REDIS_SALTS_KEY . 'judge', Controller_Auth_Judge::AUTH_JUDGE_SALT);

    }

    protected function makeHash($algo, $string) {
        return hash($algo, $string);
    }

    protected function checkCsrf()
    {
        /** Check CSRF */
        if (!isset($_POST['csrf']) || !empty($_POST['csrf']) && !Security::check(Arr::get($_POST, 'csrf', ''))) {
            throw new HTTP_Exception_403();
        }

        return true;
    }
}