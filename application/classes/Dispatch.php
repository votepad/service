<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Dispatch
 *
 * @copyright Votepad Team
 * @version 0.2.0
 */

class Dispatch extends Controller_Template
{
    const POST = 'POST';
    const GET  = 'GET';

    /** @var string - Path to template */
    public $template = '';

    /** @var $errors - Page erros */
    protected $errors;

    /** @var  $memcache - Memcache */
    protected $memcache;

    /** @var $redis - Redis instance */
    protected $redis;

    /** @var $mongo - Mongo instance */
    protected $mongo;

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

        parent::before();

        if ($this->auto_render) {

            // Initialize with empty values
            $this->template->title = $this->title = $GLOBALS['SITE_NAME'];
            $this->template->description = "VotePad — это система для управления мероприятиями онлайн, обеспечивающая быструю и достоверную оценку участников мероприятия. Благодаря нашему сервису подсчет результатов становится гораздо быстрее и проще. Предлагаемые инструменты включают в себя создание сценария мероприятия любой сложности, контролирование процесса выставления баллов, получение результатов сразу после проставления их экспертным жюри, формирование протокола выставленных баллов, информирование гостей о результатах мероприятия.";
            $this->template->keywords = "Электронное голосование, Экспертное жюри, Деловые игры, Мероприятия, Конкурсы, Выставление баллов, Выбор победителя, Победитель, Результат, Рейтинг, Страница с результатами, votepad, event, competition, business game, judges, rating, vote, results";
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
        return !empty($session->get('id')) && $session->get('mode') == Controller_Auth_Organizer::AUTH_MODE;

    }

    /**
     * Return True if user had logged
     * @return bool
     */
    public static function hadLogged()
    {
        $secret   = Cookie::get('secret', '');
        $id       = Cookie::get('id', '');
        $sid      = Cookie::get('sid', '');
        $authMode = Cookie::get('mode', '');

        if ($secret && $id && $sid && $authMode == Controller_Auth_Organizer::AUTH_MODE) {
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

    public static function MongoConnection()
    {

        $mongoConfiguration = Kohana::$config->load('mongo');
        $connectionURL = "mongodb://" . $mongoConfiguration['default']['hostname'];
        $connectionOptions = $mongoConfiguration['default']['options'];

        $mongo = new MongoDB\Driver\Manager($connectionURL,$connectionOptions);

        return $mongo;
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

            $id = $this->session->get('id') ?: (int) Cookie::get('id');
            $user = new Model_User($id);

            $this->user = $user;

        }

        View::set_global('user', $this->user);

        View::set_global('isLogged', self::isLogged());
        View::set_global('canLogin', self::canLogin());

        $address = Arr::get($_SERVER, 'HTTP_ORIGIN');

        View::set_global('assets', $address . DIRECTORY_SEPARATOR. 'assets' . DIRECTORY_SEPARATOR);
        View::set_global('website', $address);

        $this->memcache = self::memcacheInstance();
        $this->redis    = self::redisInstance();
        $this->mongo    = self::MongoConnection();

        $this->setSaltsToRedis();

    }

    private function setSaltsToRedis() {

        $this->redis->set(getenv('REDIS_SALTS_KEY') . Controller_Auth_Organizer::AUTH_MODE, getenv('AUTH_ORGANIZER_SALT'));
        $this->redis->set(getenv('REDIS_SALTS_KEY') . Controller_Auth_Judge::AUTH_MODE, getenv('AUTH_JUDGE_SALT'));

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
