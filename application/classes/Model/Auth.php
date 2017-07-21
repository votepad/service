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
    private $_session_driver = 'native';

    public function __construct()
    {
        $this->_session = Dispatch::sessionInstance($this->_session_driver);
    }

    public function login($identifier, $password, $mode)
    {

        switch ($mode) {
            case Controller_Auth_Organizer::AUTH_MODE:
                $select = Dao_Users::select()
                    ->where('email', '=', $identifier)
                    ->where('password', '=', $password)
                    ->limit(1)
                    ->execute();
                break;

            case Controller_Auth_Judge::AUTH_MODE:
                $select = Dao_Judges::select()
                    ->where('event', '=', $identifier)
                    ->where('password', '=', $password)
                    ->limit(1)
                    ->execute();

        }

        if (Arr::get($select, 'id'))
        {
            $this->complete($select, $mode);
            return true;
        }

        return false;
    }

    public function recoverById($id, $mode)
    {
        switch ($mode) {
            case Controller_Auth_Organizer::AUTH_MODE:
                $select = Dao_Users::select('*')
                    ->where('id', '=', $id)
                    ->limit(1)
                    ->execute();
                break;
            case Controller_Auth_Judge::AUTH_MODE:
                $select = Dao_Judges::select('*')
                    ->where('id', '=', $id)
                    ->limit(1)
                    ->execute();
                break;
        }

        if (Arr::get($select, 'id')) {
            $this->complete($select, $mode);
            return true;
        }

        return false;
    }

    public function logout($destroy = FALSE)
    {
        if ($destroy === TRUE)
        {
            // Destroy the session completely
            $this->_session->destroy();
        }
        else
        {
            // Remove the user from the session
            $this->_session->delete();

        }

        return false;
    }

    private function complete($select, $mode) {

        $this->_session->set('id', $select['id']);
        $this->_session->set('mode', $mode);
        $this->_session->set('name', $select['name']);

        if ($mode == Controller_Auth_Organizer::AUTH_MODE) {
            $this->_session->set('email', $select['email']);
        }

        $sessionId = $this->_session->id();
        Cookie::set('id', $select['id'], Date::MONTH);
        Cookie::set('sid', $sessionId, Date::MONTH);
        Cookie::set('mode', $mode, Date::MONTH);

    }

    public static function checkPasswordById($id, $password, $mode)
    {
        switch ($mode) {
            case Controller_Auth_Organizer::AUTH_MODE:
                $select = Dao_Users::select('*')
                    ->where('id', '=', $id)
                    ->where('password', '=', $password)
                    ->limit(1)
                    ->execute();
                break;
            case Controller_Auth_Judge::AUTH_MODE:
                $select = Dao_Judges::select('*')
                    ->where('id', '=', $id)
                    ->where('password', '=', $password)
                    ->limit(1)
                    ->execute();
                break;
        }

        if (Arr::get($select, 'id')) {
            return true;
        }

        return false;
    }
}