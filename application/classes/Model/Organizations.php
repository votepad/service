<?php

/**
 *
 */

class Model_Organizations extends Model
{
    public $id;
    public $name;
    public $website;
    public $user_created;
    public $phone;

    public function __construct()
    {
        $this->orm_organization = new ORM_Organizations();
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

    public function update_organization($id, $fields = array())
    {

    }


}