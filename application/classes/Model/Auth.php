<?php

/**
 * Class Model_Auth
 * @author ProNWE team
 * @copyright Khaydarov Murod
 * Methods
 *  - login
 *  - logOut
 */

class Model_Auth extends Model {

    private $_session = null;

    private $_session_driver = 'cookie';

    public function login($email, $password, $remember = false)
    {
        $select = Dao_Users::select('*')
            ->where('email', '=', $email)
            ->where('password', '=', $password)
            ->limit(1)
            ->cached(DATE::DAY*30, 'users', array('users') )
            ->execute();

        if (Arr::get($select, 'id'))
        {
            $this->_session = Dispatch::sessionInstance($this->_session_driver);
            $this->complete($select);
        }

        return $select;
    }

    public function logout($email, $destroy = FALSE)
    {
        if ($destroy === TRUE)
        {
            // Destroy the session completely
            Session::instance($this->_session_driver)->destroy();
        }
        else
        {
            // Remove the user from the session
            Session::instance($this->_session_driver)->delete();

        }

        return false;
    }

    private function complete($select) {

        $this->_session->set('id_user', $select['id']);
        $this->_session->set('lastname', $select['lastname']);
        $this->_session->set('name', $select['name']);
        $this->_session->set('email', $select['email']);

    }
}