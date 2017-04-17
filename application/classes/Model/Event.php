<?php defined('SYSPATH') or die('No direct script access.');

class Model_Event extends Model
{


    /**
     * @var $id [INT]
     */
    public $id;

    /**
     * @var $organization [Number] id
     */
    public $organization;

    /**
     * @var $creator [Number] id
     */
    public $creator;

    /**
     * @var $name [String]
     */
    public $name;

    /**
     * @var $uri [String]
     */
    public $uri;

    /**
     * @var $description [Text]
     */
    public $description;

    /**
     * @var $branding [Text] - path to cover
     */
    public $branding;

    /**
     * @var $tags [JSON]
     */
    public $tags;

    /**
     * @var $address [String]
     */
    public $address;


    /**
     * @var $dt_start [Date] - Beggining time
     */
    public $dt_start;

    /**
     * @var $dt_end [Date] - The time of finish
     */
    public $dt_end;

    /**
     * @var $is_published [Bool]
     */
    public $is_published = 0;

    /*
     * @var $dt_create [Date]
     */
    public $dt_create;

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

        $select = Dao_Events::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }

    /**
     * Saves User to Database
     */
    public function save()
    {

        $this->dt_create = Date::formatted_time('now', 'Y-m-d');

        $insert = Dao_Events::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert->execute();

        return $this->get_($result);

    }

    /**
     * Updates event data in database
     *
     * @return Model_Event
     */
    public function update()
    {

        $insert = Dao_Events::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $insert->where('id', '=', $this->id);

        $insert->execute();

        return $this->get_($this->id);

    }



    public function addAssistant($id) {

        Dao_UsersEvents::insert()
            ->set('u_id', $id)
            ->set('e_id', $this->id)
            ->clearcache('EventUsers:' . $this->id)
            ->clearcache('UserEvents:' . $id)
            ->execute();

    }

    public function getAssistants() {

        $selection = Dao_UsersEvents::select('u_id')
            ->where('e_id', '=', $this->id)
            ->cached(Date::MINUTE * 5, 'EventUsers:' . $this->id)
            ->execute('u_id');

        $users = array();
        foreach ($selection as $id => $value) {

            array_push($users, new Model_User($id));

        }

        return $users;

    }

    public function removeAssistant($id) {

        Dao_UsersEvents::delete()
            ->where('u_id', '=', $id)
            ->where('e_id', '=', $this->id)
            ->clearcache('EventUsers:' . $this->id)
            ->clearcache('UserEvents:' . $id)
            ->execute();

    }

    public function isAssistant($id) {

        return (bool) Dao_UsersEvents::select('u_id')
            ->where('u_id', '=', $id)
            ->where('e_id', '=', $this->id)
            ->clearcache('EventUsers:' . $this->id)
            ->clearcache('UserEvents:' . $id)
            ->limit(1)
            ->execute();

    }


    public function getInviteLink() {

        $hash = hash('sha256', $this->organization . $_SERVER['SALT'] . $this->id);
        return '/event/' . $this->id . '/invite/' . $hash;

    }

    public function isCreator($id) {
        return $id == $this->creator;
    }

    /**
     * Get Element By Field Name - for simple request
     * @param $field
     * @param $value
     * @return Model_Event
     */
    public static function getByFieldName($field, $value)
    {

        $event = Dao_Events::select()
            ->where($field, '=', $value)
            ->limit(1)
            ->execute();

        return $event;

    }

}
