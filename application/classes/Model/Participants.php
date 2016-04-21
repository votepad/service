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

    public static function getParticipantsByPosition($event, $stage)
    {
        /*
         *
         * Generating this SQL query with Query Builder Kohana.
         */
        $sql = "SELECT *
            FROM  `Participants`
            JOIN  `Positions`
            WHERE  `Participants`.id =  `Positions`.id_participant
            AND  `Participants`.id_event =  `Positions`.id_event
            AND `Participants`.id_event = :event
            AND `Positions`.id_stage = :stage
            ORDER BY `Positions`.position";

        $select = DB::query(Database::SELECT, $sql)->parameters(array(
            ':event' => $event,
            ':stage' => $stage,
        ), false)->execute()->as_array();

        if ( count($select) == 0 )
            return self::getAll($event);
        else
            return $select;
    }

    public static function updateParticipantByFieldName($field, $value, $id)
    {
        $update = DB::update('Participants')->set(array(
            $field  => $value
        ))->where('id', '=', $id)->execute();

        return $update;
    }

    public static function deleteParticipantById($id)
    {
        $delete = DB::delete('Participants')->where('id', '=', $id)->execute();
        return $delete;
    }

    public static function setPosition($event, $stage, $participant, $position)
    {
        $select = DB::select()->from('Positions')->where('id_event', '=', $event)
                                                ->and_where('id_stage', '=', $stage)
                                                ->and_where('id_participant', '=', $participant)
                                                ->limit(1)
                                                ->execute()
                                                ->as_array();
        if ( count($select) == 0) {
            $insert = DB::insert('Positions', array(
                'id_event', 'id_stage', 'id_participant', 'position',
            ))->values(array(
                $event, $stage, $participant, $position
            ))->execute();
        }
        else {
            $update = DB::update('Positions')->set(array(
                'position' => $position
                ))->where('id_event', '=', $event)
                ->and_where('id_stage', '=', $stage)
                ->and_where('id_participant', '=', $participant)
                ->execute();
        }

        return true;
    }

    public static function block($id, $id_stage, $id_event) {
        $select = DB::select()->from('BlockedParticipants')->where('id_participant', '=', $id)
                ->and_where('id_stage', '=', $id_stage)->execute()->as_array();

        if (count($select) == 0) {
            $insert = DB::insert('BlockedParticipants', array(
                'id_event', 'id_participant', 'id_stage',
            ))->values(array(
                $id_event, $id, $id_stage
            ))->execute();            
        }
    }

    public static function getBlocked($id_stage) {
        $select = DB::select()->from('BlockedParticipants')->where('id_stage', '=', $id_stage)->execute()->as_array();
        return $select;
    }

}