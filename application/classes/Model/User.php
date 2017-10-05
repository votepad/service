<?php

/**
 * Class Model_User
 * @author Votepad team
 * @version 0.3.0
 */

class Model_User extends Model {

    public $id;
    public $name;
    public $email;
    public $phone;
    public $avatar = 'no-avatar.png';
    public $branding = 'no-branding.png';
    public $private;
    public $is_confirmed;
    public $dt_create;

    /**
     * Model_User constructor.
     * get user info if data exist
     */
    public function __construct($id = null) {

        if ( !empty($id) ) {
            $this->get_($id);
        }

    }

    private function fill_by_row($db_selection) {

        if (empty($db_selection['id'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }

        return $this;

    }

    private function get_($id) {

        $select = Dao_Users::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }

    /**
     * Saves User to Database
     */
    public function save()
    {
        $this->dt_create = Date::formatted_time('now', 'Y-m-d');
        $this->private = 0;
        $this->is_confirmed = 0;

        $insert = Dao_Users::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert->execute();

        return $this->get_($result);
    }

    /**
     * Updates user data in database
     *
     * @return Model_User
     */
    public function update()
    {
        $insert = Dao_Users::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $insert->where('id', '=', $this->id);

        $insert->execute();

        return $this->get_($this->id);
    }

    public function checkPassword ($pass) {
        $selection = Dao_Users::select(array('password'))
            ->where('id', '=', $this->id)
            ->limit(1)
            ->execute();

        $password = $selection['password'];

        return $password == $pass;
    }

    public function changePassword ($newpass) {

        $insert = Dao_Users::update()
            ->set('password', $newpass)
            ->where('id', '=', $this->id)
            ->clearcache($this->id)
            ->execute();

        return $insert;

    }

    /**
     * @param $type
     * @return array [Model_Event]
     */
    public function getEvents($type)
    {
        $ids = Dao_UsersEvents::select('e_id')
            ->where('u_id', '=', $this->id)
            ->cached(Date::MINUTE * 5, 'UserEvents_' . $this->id)
            ->execute('e_id');

        $events = array();

        if (!empty($ids)) {
            foreach ($ids as $id => $value) {
                $event = new Model_Event($id);
                if ($event->type == $type) {
                    $events[] = $event;
                }
            }
        }

        return $events;
    }

    /**
     * Checks for existence by searching field
     *
     * @param $value
     * @param string $field
     * @return bool True or False
     */
    public static function isUserExist($value, $field = 'email') {
        $select = Dao_Users::select('id')
            ->where($field, '=', $value)
            ->limit(1)
            ->execute();

        if (!empty($select['id'])) {
            return true;
        } else {
            return false;
        }
    }


    public static function getByEmail($email) {
        $select = Dao_Users::select()
            ->where('email', '=', $email)
            ->limit(1)
            ->execute();

        $user = new Model_User();
        return $user->fill_by_row($select);
    }

}