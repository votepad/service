<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_Participant
 * CRUD
 */
class Model_Participant extends Model {

    public $id;
    public $event;
    public $name;
    public $photo;
    public $about;

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

        $select = Dao_Participants::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }

    /**
     * Saves Participant to Database
     */
    public function save()
    {

        $this->dt_create = Date::formatted_time('now', 'Y-m-d');

        $insert = Dao_Participants::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache('event:' . $this->event);
        $result = $insert->execute();

        return $this->fill_by_row($result);

    }

    /**
     * Updates Participant data in database
     *
     * @return Model_Participant
     */
    public function update()
    {

        $insert = Dao_Participants::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $insert->clearcache('event:' . $this->event);
        $insert->where('id', '=', $this->id);

        $insert->execute();

        return $this->get_($this->id);

    }

    public function delete() {

        $delete = Dao_Participants::delete()
            ->where('id', '=', $this->id)
            ->clearcache($this->id)
            ->execute();

        return $delete;

    }

}