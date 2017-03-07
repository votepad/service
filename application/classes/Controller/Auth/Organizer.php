<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth_Organizer extends Auth {

    const AUTH_ORGANIZER_SALT = 'votepadrusalt';
    const AUTH_MODE = 'organizer';

    /**
     * Before execution parent class
     */
    public function before()
    {
        // поля без CSRF
        $exceptions = ['logout'];

        if (!in_array($this->request->action(), $exceptions)) {

            // check CSRF
            $this->checkCsrf();

        }

        // Do not allow render
        $this->auto_render = false;
        parent::before();
    }

    public function action_auth()
    {

        if (!$this->request->is_ajax()) {
            return;
        }

        if ( isset($_POST['recover']) ) {

            $uid = $this->recover();

            // Если сессия была уничтожена или хэш не совпал
            if (!$uid) {
                $this->clearCookie();

                $response = new Model_Response_Auth('RECOVER_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;


            }

            $response = new Model_Response_Auth('RECOVER_SUCCESS', 'success', array('id' => $uid));
            $this->response->body(@json_encode($response->get_response()));
            return;


        } else if ( isset($_POST['logout'])) {

            $this->clearCookie();
            $this->session->destroy();

            $response = new Model_Response_Auth('LOGOUT_SUCCESS', 'success');
            $this->response->body(@json_encode($response->get_response()));
            return;

        }

        $email      = Arr::get($_POST, 'email', '');
        $password   = Arr::get($_POST, 'password', '');
        $remember   = false;

        if ( empty($email) || empty($password)) {

            $this->makeAttempt();

            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;


        }

        $user = new Model_Auth();

        if (!$user->login($email, $password, $remember)) {

            $this->makeAttempt();


            $response = new Model_Response_Auth('INVALID_INPUT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;

        }

        $session = Session::instance();
        $sid = $session->id();
        $uid = $session->get('uid');

        $hash = $this->makeHash('sha256', self::AUTH_ORGANIZER_SALT . $sid . self::AUTH_MODE . $uid);

        Cookie::set('secret', $hash, Date::DAY);

        $this->saveSessionData($hash, $sid, $uid);


        $response = new Model_Response_Auth('LOGIN_SUCCESS', 'success', array('id' => $uid));
        $this->response->body(@json_encode($response->get_response()));

    }

    public function action_logout()
    {
        $auth = new Model_Auth();
        $auth->logout(TRUE);

        $referer = $this->request->referrer();
        $this->redirect($referer);

    }

    /**
     * Check session token (make secret from Cookie data)
     *
     * @return null|string
     */
    private function recover()
    {
        $uid    = Cookie::get('uid');
        $sid    = Cookie::get('sid');
        $secret = Cookie::get('secret');

        $hash = $this->makeHash('sha256', self::AUTH_ORGANIZER_SALT . $sid . self::AUTH_MODE . $uid);

        if ($this->redis->get($hash) && $hash == $secret) {

            // Создаем новую сессию
            $auth = new Model_Auth();
            $auth->recoverById($uid);

            $sid = $this->session->id();
            $uid = $this->session->get('uid');

            $this->redis->delete($hash);

            // генерируем новый хэш c новый session id
            $newHash = $this->makeHash('sha256', self::AUTH_ORGANIZER_SALT . $sid . self::AUTH_MODE . $uid);

            // меняем хэш в куки
            Cookie::set('secret', $newHash, Date::DAY);

            // сохраняем в редис
            $this->saveSessionData($newHash, $sid, $uid);

            return $uid;
        }

        return NULL;
    }

    private function clearCookie()
    {
        Cookie::delete('sid');
        Cookie::delete('uid');
        Cookie::delete('secret');
    }

    /**
     * save session in Redis server
     *
     * @param $hash - secret code
     * @param $sid - session id
     * @param $uid - user id
     */
    private function saveSessionData($hash, $sid, $uid)
    {
        $this->redis->set($hash, $sid . ':' . $uid . ':' . Request::$client_ip, array('nx', 'ex' => 3600 * 24));
    }


}