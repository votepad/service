<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_User
 * @author ProNWE team
 * @copyright Khaydarov Murod
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
         $user->number   = $this->phone;

         $user->save();

         return $this;
     }

    /**
     * @param $id
     * @return Id organization
     */
    public function getUserOrganization($id)
    {
        $select = DB::select('id_organization')->from('User_Organizations')
                        ->where('id_user', '=', $id)
                        ->limit(1)
                        ->execute()
                        ->as_array();

        return Arr::get($select, '0')['id_organization'];
    }

}