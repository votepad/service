<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Class Model_User
 * @author ProNWE team
 * @copyright Khaydarov Murod
 * @version 0.2.0
 * Methods
 *  - getCurrentUser
 *  - newUser
 */

Class Model_User {

    /**
     * @var $id_user
     */
    public $id;

    /**
     * @var $lastname
     */
    public $lastname;

    /**
     * @var $name
     */
    public $name;

    /**
     * @var $surname
     */
    public $surname;

    /**
     * @var $email
     */
    public $email;

    /**
     * @var $phone
     */
    public $phone;

    /**
     * @var $avatar
     */
    public $avatar = 'no-avatar.png';

    /**
     * @var $branding
     */
    public $branding = 'no-cover.png';

    /**
     * @var $isConfirmed
     */
    public $isConfirmed;

    /**
     * @var $dt_create
     */
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

        $insert = Dao_Users::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert->execute();

        return $this->fill_by_row($result);

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

    public function getOrganizations()
    {
        $ids = Dao_UsersOrganizations::select('o_id')
            ->where('u_id', '=', $this->id)
            ->cached(Date::MINUTE * 5, 'user:' . $this->id)
            ->execute('o_id');

        $orgs = array();

        if (!empty($ids)) {
            foreach ($ids as $id => $value) {
                array_push($orgs, new Model_Organization($id));
            }
        }

        return $orgs;
    }

    /**
     * @public
     *
     * Checks for existance by searching field
     *
     * @param $field
     * @param $value
     * @returns [Bool] True or False
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

}