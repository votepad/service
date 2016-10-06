<?php

/**
 * Class Model_Roles
 * Contains user roles and permisions
 */
class Model_Role {

    protected $permissions;

    /** Initialise permission variable */
    protected function __construct() {
        $this->permissions = array(); 
    }

    /**
     * @param $role - target role
     * @returns [Array] Array object of target role permissions
     */
    public static function getRolePermissions($id_role) {

        $role = new Model_Role();

        /**
         * Sql query for role permissitions
         */
        $query = "SELECT t2.permission_description FROM Role_Permission as t1
                    JOIN Permissions as t2 ON t1.id_permission = t2.id_permission
                    WHERE t1.id_role = $id_role";

        $select = DB::query(Database::SELECT, $query);
        $result = $select->execute()->as_array();

        /**
         * @var  $keys
         * @var  $value
         */
        foreach($result as $keys => $value) {
            foreach($value as $key => $permission) {
                $role->permissions[$permission] = true;
            }
        }   

        return $role;
    }

    /**
     * if permission is allowed
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission) {
        return isset($this->permissions[$permission]);
    }
    
}