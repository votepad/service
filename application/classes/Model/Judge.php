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

    public static function logInAsJudge($email, $password)
    {
        $select = DB::select()->from('Judges')->where('email', '=', $email)->limit(1)->execute();
        $result = Arr::get($select, '0');

        $online = DB::select()->from('Online')->where('id_event', '=', $result['id_event'])
            ->and_where('id_judge', '=', $result['id'])
            ->execute()->as_array();

        if ( count($online) == 0 ) {

            $insert = DB::insert('Online', array(
                'id_event', 'id_judge'
            ))->values(array(
                'id_event' => $result['id_event'],
                'id_judge' => $result['id'],
            ))->execute();

        }

        return $result;
    }

    public static function JudgesOnline($id_event)
    {
        $select = DB::select()->from('Online')->where('id_event', '=', $id_event)->execute()->as_array();
        return $select;
    }

    private static function get($id = 0, $id_event)
    {
        $select = DB::select()->from('Judges')->where('id_event', '=', $id_event);

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

    public static function getJudge($id, $id_event)
    {
        return self::get($id, $id_event);
    }

    public static function updateJudgeByFieldName($field, $value, $id)
    {
        $update = DB::update('Judges')->set(array(
            $field  => $value
        ))->where('id', '=', $id)->execute();

        return $update;
    }

    public static function deleteJudgesById($id)
    {
        $delete = DB::delete('Judges')->where('id', '=', $id)->execute();
        return $delete;
    }
}