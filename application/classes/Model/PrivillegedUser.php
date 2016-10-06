<?php

/**
 * Class Model_PrivelegedUser
 * Contains user privelegies
 */
class Model_PrivillegedUser extends Model_User {

    /**
     * @var $role 
     */
    protected $role;

    /**
     * @var $role_name
     */
    public $role_name;

    /**
     * Model_PrivillegedUser constructor.
     * @param $id Users id
     */
    public function __construct($id = null) {

        if (!isset($id))
        {
            return $this->getCurrentUser();
        }
        else
        {
            return $this->getUser($id);
        }

    }

    /**
     * @returns Users Role identificator
     */
    private function getRole($id_user) {

        /**
         * Selection users role
         */
        $select = DB::select()->from('User_Role')
                                    ->where('id_user', '=', $id_user)
                                    ->limit(1)
                                    ->execute()
                                    ->as_array();

        $id_role = Arr::get($select, '0')['id_role'];

        /**
         * Selection roles name
         */
        $select = DB::select()->from('Roles')
                                    ->where('id_role', '=', $id_role)
                                    ->limit(1)
                                    ->execute()
                                    ->as_array();

        $this->role_name = Arr::get($select, '0')['role_name'];
        
        return $id_role;
    }

    /**
     * @return bool|ORM_User
     * @throws Kohana_Exception
     */
    private function getCurrentUser() {

        $session = Session::Instance();

        $user = new ORM_User();
        $user->where('id', '=', $session->get('id_user'))
            ->find();

        $this->id_user   = $user->id;
        $this->lastname  = $user->lastname;
        $this->name      = $user->name;
        $this->surname   = $user->surname;
        $this->email     = $user->email;
        $this->phone     = $user->number;
        $this->role      = Model_Role::getRolePermissions($this->getRole($user->id));

        return $this;
    }

    /**
     * @param $id
     * @return $this
     * @throws Kohana_Exception
     */
    private function getUser($id) {

        $user = new ORM_User();
        $user->where('id', '=', $id)
            ->find();

        $this->id_user   = $user->id;
        $this->lastname  = $user->lastname;
        $this->name      = $user->name;
        $this->surname   = $user->surname;
        $this->email     = $user->email;
        $this->phone     = $user->number;
        $this->role      = Model_Role::getRolePermissions($this->getRole($user->id));

        return $this;
    }

    /**
     * Checks privillegies
     */
    public function hasPrivillege($permission) {

        if ($this->role->hasPermission($permission)) {

            return true;

        } else {

            return false;
        }
    }

}