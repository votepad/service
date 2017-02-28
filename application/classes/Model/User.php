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
     * @var $isConfirmed
     */
    public $isConfirmed;

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
            ->cached(DATE::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }

    /**
     * @param $id
     * Saves or Updates User to Database
     */
     public function save($id = null)
     {

     }

    /**
     * @param $id
     * @return organization
     */
    public static function getUserOrganization($id)
    {
        $select = DB::select('id_organization')->from('User_Organizations')
                        ->where('id_user', '=', $id)
                        ->limit(1)
                        ->execute()
                        ->as_array();

        return Arr::get($select, '0')['id_organization'];
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
    public static function isUserExist($field, $value) {
        $select = DB::select('id')->from('Users')
            ->where($field, '=', $value)
            ->execute()
            ->as_array();

        if (count($select) > 0) {
            return true;
        } else {
            return false;
        }
    }

}