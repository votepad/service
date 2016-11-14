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
    public $id_user;

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

    public function __construct() {}

    /**
     * @param $id
     * Saves or Updates User to Database
     */
     public function save($id = null)
     {
         $user = new ORM_User();

         if (isset($id)) {
             $user->where('id', '=', $id)
                 ->find();
         }

         $user->lastname = $this->lastname;
         $user->name     = $this->name;
         $user->surname  = $this->surname;
         $user->email    = $this->email;
         $user->password = $this->password;
         $user->phone    = $this->phone;
         $user->done     = $this->done;

         $user->save();

         $this->id_user = $user->id;

         return $this;
     }

    /**
     * @param $id
     * @return Id organization
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