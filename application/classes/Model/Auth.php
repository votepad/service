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

    public function login($email, $password, $remember = false)
    {
        $select = DB::select('*')->from('Users')
            ->where('email', '=', $email)
            ->and_where('password', '=', $password)
            ->limit(1)
            ->execute()->current();

        if (Arr::get($select, 'id'))
        {
            $this->_session = Session::instance();
            $this->complete($select);
        }

        return $select;
    }

    public function logout($email, $destroy = FALSE)
    {
        if ($destroy === TRUE)
        {
            // Destroy the session completely
            Session::instance()->destroy();
        }
        else
        {
            // Remove the user from the session
            Session::instance()->delete();

        }

        // Double check
        return false;
    }

    private function complete($select) {

        $this->_session->set('id_user', $select['id']);
        $this->_session->set('lastname', $select['lastname']);
        $this->_session->set('name', $select['name']);
        $this->_session->set('email', $select['email']);
        $this->_session->set('role', $select['role']);

    }
}