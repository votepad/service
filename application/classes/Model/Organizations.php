<?php

/**
 * Class Model_Organizations
 * @author ProNWE team
 * @copyright Khaydarov Murod
 */

class Model_Organizations extends Model
{
    /**
     * @var $id
     */
    public $id;

    /**
     * @var $name
     */
    public $name;

    /**
     * @var $website
     */
    public $website;

    /**
     * @var $officialSite
     */
    public $officialSite;

    /**
     * @var $phone
     */
    public $phone;

    /**
     * @var $dt_created
     */
    public $dt_created;

    /**
     * @var $dt_update
     */
    public $dt_update;

    /**
     * @var $is_removed
     */
    public $is_removed;

    /**
     * @var $user_created
     */
    public $creator;

    /**
     * @var $team
     */
    public $team;

    /**
     * @var $cover
     */
    public $cover;

    /**
     * @var $logo
     */
    public $logo;

    /**
     * Model_Organizations constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param null $id
     * @return $this
     * @throws Kohana_Exception
     */
    public function save($id = null)
    {
        $organization = new ORM_Organizations();

        if (isset($id)) {
            $organization->where('id', '=', $id)
                        ->find();

        } else {

            $organization->dt_created  = DB::expr('Now()');

        }

        $organization->name         = $this->name;
        $organization->website      = $this->website;
        $organization->officialSite = $this->officialSite;
        $organization->phone        = $this->phone;
        $organization->dt_update    = DB::expr('Now()');
        $organization->is_removed   = $this->is_removed;
        $organization->logo         = $this->logo ?: NULL;
        $organization->cover        = $this->cover ?: NULL;
        
        $organization->save();

        $this->id = $organization->id;

        return $this;
    }

    /**
     * @param $id
     * @param $is_removed
     * @return bool
     * @throws Kohana_Exception
     */
    public static function get($id, $is_removed)
    {
        $organization = new ORM_Organizations();

        $organization->where('id','=', $id)
                    ->and_where('is_removed', '=', $is_removed)
                    ->find();

        if ($organization->loaded())
        {
            $target = new Model_Organizations();

            $target->id           = $organization->id;
            $target->name         = $organization->name;
            $target->website      = $organization->website;
            $target->officialSite = $organization->officialSite;
            $target->phone        = $organization->phone;
            $target->dt_update    = $organization->dt_update;
            $target->is_removed   = $organization->is_removed;
            $target->creator      = $target->getCreator($organization->id);
            $target->team         = $target->getTeam($organization->id);
            $target->cover        = $organization->cover;
            $target->logo         = $organization->logo;

            return $target;

        }

        return false;
    }

    /**
     * Creates a row in Users_Organization table
     *
     * @param $id_user
     * @param $id_organization
     */
    public static function addUsersOrganization($id_user, $id_organization) {

        $insert = DB::insert('User_Organizations', array('id_user', 'id_organization'))
                    ->values(array($id_user, $id_organization))
                    ->execute();

        if ($insert) {
            return $insert;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public static function delete_organization($id) {

        $organization = self::get($id, 1);

        if ($organization->loaded())
        {
            $organization->is_removed = 1;
            $organization->save();

            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public static function reestablish_organization($id) {

        $organization = self::get($id, 0);

        if ($organization->loaded())
        {
            $organization->is_removed = 0;
            $organization->save();

            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @returns $id_user
     */
    private function getCreator($id)
    {
        $select = DB::select('id_user')->from('User_Organizations')
            ->where('id_organization', '=', $id)
            ->limit(1)
            ->execute()
            ->as_array();

        $id_user = Arr::get($select, '0')['id_user'];

        return new Model_PrivillegedUser($id_user);
    }

    private function getTeam($id)
    {
        $users = array();

        $select = DB::select()->from('User_Organizations')
            ->where('id_organization', '=', $id)
            ->execute()
            ->as_array();

        foreach ($select as $key => $value) {
            $users[] = new Model_PrivillegedUser($value['id_user']);
        }

        return $users;
    }

}