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

    private static function get($id = 0)
    {
        $select = DB::select()->from('Participants');

        if ($id == 0)
            $select = $select->execute();
        else
            $select = $select->where('id', '=', $id)->limit(1)->execute();

        return $id != 0 ? Arr::get($select, '0') : $select->as_array();
    }

    public static function getAll()
    {
        return self::get();
    }

    public static function getParticipant($id)
    {
        return self::get($id);
    }

}