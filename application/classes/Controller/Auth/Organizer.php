<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth_Organizer extends Auth {

    const AUTH_MODE = 'organizer';

    /**
     * Before execution parent class
     */
    public function before()
    {
        // поля без CSRF
        $exceptions = ['logout', 'confirm'];

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

            $password = Arr::get($_POST, 'password', '');

            if (empty($password)) {
                $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

            $id = $this->recover();

            // Если сессия была уничтожена или хэш не совпал
            if (!$id) {
                $this->clearCookie();

                $response = new Model_Response_Auth('RECOVER_ERROR', 'error', array('$id' => $id));
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

            $password = $this->makeHash('md5', $password . getenv('SALT'));

            if ( !Model_Auth::checkPasswordById($id, $password, self::AUTH_MODE) ) {
                $response = new Model_Response_Auth('INVALID_INPUT_ERROR', 'error', array('$id' => $id));
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

            $response = new Model_Response_Auth('RECOVER_SUCCESS', 'success', array('id' => $id));
            $this->response->body(@json_encode($response->get_response()));
            return;

        } elseif ( isset($_POST['logout']) ) {

            $this->clearCookie();
            $this->session->destroy();
            $response = new Model_Response_Auth('LOGOUT_SUCCESS', 'success');
            $this->response->body(@json_encode($response->get_response()));
            return;

        }

        $email      = Arr::get($_POST, 'email', '');
        $password   = Arr::get($_POST, 'password', '');

        if ( empty($email) || empty($password)) {

            $this->makeAttempt();

            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;


        }

        $user = new Model_Auth();

        $password = $this->makeHash('md5', $password . getenv('SALT'));

        if (!$user->login($email, $password, self::AUTH_MODE)) {

            $this->makeAttempt();

            $response = new Model_Response_Auth('INVALID_INPUT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;

        }

        $session = Session::instance();
        $sid = $session->id();
        $id = $session->get('id');

        $hash = $this->makeHash('sha256', getenv('AUTH_ORGANIZER_SALT') . $sid . self::AUTH_MODE . $id);

        Cookie::set('secret', $hash, Date::MONTH);

        $this->saveSessionData($hash, $sid, $id);


        $response = new Model_Response_Auth('LOGIN_SUCCESS', 'success', array('id' => $id));
        $this->response->body(@json_encode($response->get_response()));

    }

    public function action_logout()
    {
        $auth = new Model_Auth();
        $auth->logout(TRUE);

        $this->redirect('/');

    }

    public function action_confirm()
    {
        $hash = $this->request->param('hash');

        $id = $this->redis->get(getenv('REDIS_CONFIRMATION_HASHES') . $hash);

        if (!$id) {
            throw new HTTP_Exception_400();
        }

        $user = new Model_User($id);
        $user->is_confirmed = 1;
        $user->update();

        $this->redis->delete(getenv('REDIS_CONFIRMATION_HASHES') . $hash);

        $this->redirect('/user/' . $id . '/settings');
    }


    /**
     * Check session token (make secret from Cookie data)
     *
     * @return null|string
     */
    private function recover()
    {
        $id    = Cookie::get('id');
        $sid    = Cookie::get('sid');
        $secret = Cookie::get('secret');

        $hash = $this->makeHash('sha256', getenv('AUTH_ORGANIZER_SALT') . $sid . self::AUTH_MODE . $id);

        if ($this->redis->get(getenv('REDIS_SESSION_HASHES') . $hash) && $hash == $secret) {

            // Создаем новую сессию
            $auth = new Model_Auth();
            $auth->recoverById($id, self::AUTH_MODE);

            $sid = $this->session->id();
            $id = $this->session->get('id');

            $this->redis->delete($hash);

            // генерируем новый хэш c новый session id
            $newHash = $this->makeHash('sha256', getenv('AUTH_ORGANIZER_SALT') . $sid . self::AUTH_MODE . $id);

            // меняем хэш в куки
            Cookie::set('secret', $newHash, Date::MONTH);

            // сохраняем в редис
            $this->saveSessionData($newHash, $sid, $id);

            return $id;
        }

        return NULL;
    }

    private function clearCookie()
    {
        Cookie::delete('sid');
        Cookie::delete('id');
        Cookie::delete('secret');
        Cookie::delete('mode');
    }

    /**
     * save session in Redis server
     *
     * @param $hash - secret code
     * @param $sid - session id
     * @param $id - user id
     */
    private function saveSessionData($hash, $sid, $id)
    {
        $this->redis->set(getenv('REDIS_SESSION_HASHES') . $hash, $sid . ':' . $id . ':' . Request::$client_ip, array('nx', 'ex' => Date::MONTH));
    }



}