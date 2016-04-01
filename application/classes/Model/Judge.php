<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 29.03.2016
 * Time: 10:37
 */

class Model_Judge extends Model {

    public $id;
    public $name;
    public $email;
    public $position;
    public $photo;

    public $id_event;

    public function __construct($id_event = '', $name = '', $email = '', $position = '', $photo = '')
    {
        $this->id_event = $id_event;
        $this->name     = $name;
        $this->email    = $email;
        $this->position = $position;
        $this->photo    = $photo;
    }

    public function save()
    {
        $insert = DB::insert('Judges', array(
                        'id_event', 'name', 'email', 'position', 'photo'
                    ))
                    ->values(array(
                        $this->id_event, $this->name, $this->email, $this->position, $this->photo
                    ))->execute();

        return $insert;
    }

    private static function get($id = 0)
    {
        $select = DB::select()->from('Judges');

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

    public static function getJudge($id)
    {
        return self::get($id);
    }
}