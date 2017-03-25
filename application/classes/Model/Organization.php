<?php

/**
 * Class Model_Organizations
 * @author Votepad team
 * @copyright Khaydarov Murod
 * @version 0.2.0
 */

class Model_Organization extends Model
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
     * @var $description
     */
    public $description;

    /**
     * @var $uri
     */
    public $uri;

    /**
     * @var $website
     */
    public $website;

    /**
     * @var $dt_created
     */
    public $dt_create;

    /**
     * @var $is_removed
     */
    public $is_removed = 0;

    /**
     * @var $owner
     */
    public $owner;

    /**
     * @var $cover
     */
    public $cover = 'no-cover.png';

    /**
     * @var $logo
     */
    public $logo = 'no-logo.png';

    /**
     * Model_Organization constructor.
     * get org info if data exist
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

        $select = Dao_Organizations::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }

    /**
     * Saves org data to Database
     */
    public function save()
    {

        Dao_UsersOrganizations::insert()
            ->set('u_id', $this->owner)
            ->set('o_id', $this->id)
            ->execute();

        $this->dt_create = Date::formatted_time('now', 'Y-m-d');

        $insert = Dao_Organizations::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $id = $insert->execute();

        return $this->get_($id);

    }

    /**
     * Updates org data in database
     *
     * @return Model_Organization
     */
    public function update()
    {

        $insert = Dao_Organizations::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->where('id', '=', $this->id);
        $insert->clearcache($this->id);

        $id = $insert->execute();

        return $this->get_($id);

    }

    /**
     * @public
     *
     * For simple requests, like to get basic information.
     *
     * @param $field
     * @param $value
     */
    public static function getByFieldName($field, $value)
    {

        $id = Dao_Organizations::select('id')
                    ->where($field, '=', $value)
                    ->execute();

        return new self($id);

    }

    /**
     * Sets is_removed = 1
     */
    public function remove() {

        $this->is_removed = 1;

        return $this->update();

    }

    /**
     * Sets is_removed = 0
     */
    public function reestablish() {

        $this->is_removed = 0;

        return $this->update();

    }

    /**
     * Checking owner user
     */
    public function isOwner($id) {

        return $this->owner == $id;

    }

    public function addMember($id) {

        $user = new Model_User($id);

        if (!$user->id) {

            return false;

        }

        Dao_UsersOrganizations::insert()
            ->set('u_id', $user->id)
            ->set('o_id', $this->id)
            ->clearcache('org:' . $this->id)
            ->clearcache('user:' . $user->id)
            ->execute();

        return true;

    }

    public function removeMember($id) {

        Dao_UsersOrganizations::delete()
            ->where('u_id', '=' , $id)
            ->where('o_id', '=', $this->id)
            ->clearcache('org:' . $this->id)
            ->clearcache('user:' . $id)
            ->execute();

        return true;

    }

    public function isMember($id) {

        return (bool) Dao_UsersOrganizations::select('u_id')
            ->where('u_id', '=', $id)
            ->where('o_id', '=', $this->id)
            ->limit(1)
            ->execute();

    }

    public function getTeam() {

        $ids = Dao_UsersOrganizations::select('u_id')
            ->where('o_id', '=', $this->id)
            ->cached(Date::MINUTE * 5, 'org:' . $this->id)
            ->execute('u_id');

        $team = array();

        foreach ($ids as $id => $value) {
            array_push($team, new Model_User($id));
        }

        return $team;

    }

}
