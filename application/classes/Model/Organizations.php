<?php

/**
 * Class Model_Organizations
 * @author ProNWE team
 * @copyright Khaydarov Murod
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

    public static function getByName($name)
    {
        $organization = new ORM_Organizations();

        $organization->where('name', '=', $name)
            ->find();

        if ($organization->loaded())
        {
            return $organization->id;
        }

        return false;
    }

    public static function update_organization($id, $fields = array())
    {
        $organization = self::get($id);

        foreach ($fields as $key => $values) {
            $organization->$key = $values;
        }

        $organization->save();
    }

    public static function delete_organization($id) {

        $organization = self::get($id);
        $organization->delete();
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

    public static function get_team($id)
    {
        $team = DB::select('*')->from('Users')
            ->where('id_organization', '=', $id)
            ->execute()
            ->as_array();

        return $team;
    }

}