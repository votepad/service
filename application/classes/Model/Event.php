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
     * @var $title [String]
     */
    public $title;

    /**
     * @var $uri [String]
     */
    public $uri;

    /**
     * @var $description [Text]
     */
    public $description;

    /**
     * @var $tags [JSON]
     */
    public $tags;

    /**
     * @var $cover [Text]
     */
    //public $cover;

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

        $id = $insert->execute();

        return $this->get_($id);

    }

    /**
     * Updates user data in database
     *
     * @return Model_User
     */
    public function update()
    {

        $insert = Dao_Events::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $insert->where('id', '=', $this->id);

        $id = $insert->execute();

        return $this->get_($id);

    }



}
