<?php

/**
 *
 */

class Model_Organizations extends Model
{
    public function __construct()
    {
    }

    public static function new_organization($name, $website, $user_created, $phone)
    {
        $organization = new ORM_Organizations();

        $organization->name         = $name;
        $organization->website      = $website;
        $organization->phone        = $phone;
        $organization->user_created = $user_created;
        $organization->dt_created   = DB::expr('Now()');

        return $organization->save();
    }

    public static function update_organization($id, $fields = array())
    {

    }

    public static function get($id)
    {
        $organization = new ORM_Organizations();

        $organization->where('id','=', $id)
                    ->find();

        if ($organization->loaded())
        {
            return $organization;
        }

        return false;
    }

    public static function get_creator($id)
    {
        $user = new ORM_User();

        $user->where('id', '=', $id)
            ->find();

        if ($user->loaded())
        {
            return $user;
        }

        return false;
    }

    /**
     * @todo
     * @param $id
     */
    public static function get_events($id)
    {

    }

}