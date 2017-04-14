<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_Stage
 * CRUD
 */
class Model_Stage extends Model {

    public $id;
    public $event;
    public $name;
    public $description;
    public $formula;
    public $mode;

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

        $select = Dao_Stages::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }

    /**
     * Saves Stage to Database
     */
    public function save()
    {

        $this->dt_create = Date::formatted_time('now', 'Y-m-d');

        $insert = Dao_Stages::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert->execute();

        return $this->get_($result);

    }

    /**
     * Updates Stage data in database
     *
     * @return Model_Stage
     */
    public function update()
    {

        $insert = Dao_Stages::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $insert->where('id', '=', $this->id);

        $insert->execute();

        return $this->get_($this->id);

    }

    public function delete() {

        $delete = Dao_Stages::delete()
            ->where('id', '=', $this->id)
            ->clearcache($this->id)
            ->execute();

        return $delete;

    }

}