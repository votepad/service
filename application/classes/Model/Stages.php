<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 03.04.2016
 * Time: 15:14
 */

class Model_Stages extends Model {

    public $substance;
    public $id;
    public $subId;

    function __construct()
    {
    }

    function __clone()
    {
    }

    function __sleep()
    {
    }

    function insertStages($name, $description, $id_event)
    {
        $insert = DB::insert('Stages', array(
            'name', 'description', 'id_event'
        ))->values(array(
            $name, $description, $id_event
        ))->execute();

        $select = DB::select('id')->from('Stages')->where('name', '=', $name)
                                ->and_where('description', '=', $description)
                                ->limit(1)
                                ->execute()->as_array();

        $select = Arr::get($select, '0');
        return $select['id'];
    }

    function insertCriteria($name, $maxScore, $id_stage) {

        $insert = DB::insert('Criteria', array(
            'name', 'maxscore', 'id_stage'
        ))->values(array(
            $name, $maxScore, $id_stage
        ))->execute();

        return $insert;
    }

    private static function get($id = 0, $id_event)
    {
        $select = DB::select()->from('Stages')->where('id_event', '=', $id_event);

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

    public static function getStage($id, $id_event)
    {
        return self::get($id, $id_event);
    }

    public static function getCriteriasByStageId($id_stage)
    {
        $select = DB::select()->from('Criteria')->where('id_stage', '=', $id_stage)->execute()->as_array();
        return $select;
    }

    public static function updateStageByFieldName($field, $value, $id)
    {
        $update = DB::update('Stages')->set(array(
            $field  => $value
        ))->where('id', '=', $id)->execute();

        return $update;
    }

    public static function updateCriteriaByFieldName($field, $value, $id)
    {
        $update = DB::update('Criteria')->set(array(
            $field  => $value
        ))->where('id', '=', $id)->execute();

        return $update;
    }

    public static function deleteStagesById($id)
    {
        $delete = DB::delete('Stages')->where('id', '=', $id)->execute();
        $deleteCriterias = DB::delete('Criteria')->where('id_stage', '=', $id)->execute();

        return true;
    }

    public static function deleteCriteria($id)
    {
        $select = DB::select()->from('Criteria')->where('id', '=', $id)->execute()->as_array();
        $select = Arr::get($select, '0');

        $id_stage = $select['id_stage'];
        $select = DB::select()->from('Criteria')->where('id_stage', '=', $id_stage)->execute()->as_array();

        if (count($select) == 1)
            $delete = DB::delete('Stages')->where('id', '=', $select[0]['id_stage'])->execute();

        $delete = DB::delete('Criteria')->where('id', '=', $id)->execute();
        return $delete;
    }


    public static function block($id)
    {
        $select = DB::select()->from('BlockedStages')->where('id_stage', '=', $id)->limit(1)->execute();

        if ( count($select) == 0 ) {
            $insert = DB::insert('BlockedStages', array(
                'id_stage', 'block',
            ))->values(array(
                $id, '0',
            ))->execute();
        }
        else
        {
            $stage = Arr::get($select, '0');
            if ( $stage['block'] == 1) {
                $update = DB::update('BlockedStages')->set(array(
                    'block' => '0',
                ))->where('id_stage', '=', $id)->execute();
            }
            else {
                $update = DB::update('BlockedStages')->set(array(
                    'block' => '1',
                ))->where('id_stage', '=', $id)->execute();
            }
        }

        return true;
    }

    public static function stageStatus($stage)
    {
        $select = DB::select()->from("BlockedStages")->where('id_stage', '=', $stage)->limit(1)->execute()->as_array();
        return Arr::get($select, '0')['block'];
    }
}