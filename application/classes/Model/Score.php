<?php
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 16.04.2016
 * Time: 13:47
 */

class Model_Score extends Model {

    public static function set($id_event, $id_participant, $id_stage, $id_judge, $score)
    {
        $select = DB::select()->from('Scores')->where('id_event', '=', $id_event)
                    ->and_where('id_participant', '=', $id_participant)
                    ->and_where('id_stage', '=', $id_stage)
                    ->and_where('id_judge', '=', $id_judge)
                    ->execute();

        if ( count($select) == 0)
            $insert = DB::insert('Scores', array(
              'id_event', 'id_participant', 'id_stage', 'id_judge', 'score'
            ))->values(array(
                $id_event, $id_participant, $id_stage, $id_judge, $score
            ))->execute();

        else {
            $update = DB::update('Scores')->set(array(
                'score' => $score
            ))->where('id_event', '=', $id_event)
                ->and_where('id_participant', '=', $id_participant)
                ->and_where('id_stage', '=', $id_stage)
                ->and_where('id_judge', '=', $id_judge)
                ->execute();
        }
    }

    public static function getScore($id_event, $id_stage, $id_judge, $id_participant) {
        $select = DB::select()->from('Scores')->where('id_event', '=', $id_event)
                ->and_where('id_stage', '=', $id_stage)
                ->and_where('id_judge', '=', $id_judge)
                ->and_where('id_participant', '=', $id_participant)
                ->limit(1)
                ->execute()
                ->as_array();
        return Arr::get($select, '0')['score'];
    }
}