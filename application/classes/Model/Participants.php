<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 27.03.2016
 * Time: 10:02
 */

class Model_Participants extends Model {

    public $id;
    public $id_event;
    public $name;
    public $description;
    public $photo;

    public function __construct( $id_event = '', $name='', $description='', $photo='' )
    {
        $this->id_event     = $id_event;
        $this->name         = $name;
        $this->description  = $description;
        $this->photo        = $photo;
    }

    public function save()
    {
        $insert = DB::insert('Participants', array('id_event', 'name', 'description', 'photo'))
                            ->values(array($this->id_event, $this->name, $this->description, $this->photo))->execute();

        return $insert;
    }


    private static function get($id = 0, $id_event)
    {
        $select = DB::select()->from('Participants')->where('id_event', '=', $id_event);

        if ($id == 0)
            $select = $select->execute();
        else
            $select = $select->where('id', '=', $id)->limit(1)->execute();

        return $id != 0 ? Arr::get($select, '0') : $select->as_array();
    }

    public static function getAll($id_event)
    {
        return self::get(0, $id_event);
    }

    public static function getParticipant($id, $id_event)
    {
        return self::get($id, $id_event);
    }

    public static function updateParticipantByFieldName($field, $value, $id)
    {
        $update = DB::update('Participants')->set(array(
            $field  => $value
        ))->where('id', '=', $id)->execute();

        return $update;
    }

}