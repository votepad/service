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

        if ( count($select) == 0 || !isset($select) ) {
            $insert = DB::insert('Scores', array(
              'id_event', 'id_participant', 'id_stage', 'id_judge', 'score'
            ))->values(array(
                $id_event, $id_participant, $id_stage, $id_judge, $score
            ))->execute();
        }
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
        return Arr::get($select, '0')['score'] ?: 0;
    }

    public static function getTotalScore($id_event, $id_judge, $id_participant) {
        $select = DB::select(array(DB::expr('SUM(`score`)'), 'total'))->from('Scores')->where('id_event', '=', $id_event)
            ->and_where('id_judge', '=', $id_judge)
            ->and_where('id_participant', '=', $id_participant)
            ->execute()
            ->as_array();

        return Arr::get($select, '0')['total'] ?: 0;
    }

    public static function getAdditionalScores($id_event, $id_stage, $participant) {

        if ($id_stage != 0) {
        $select = DB::select(array(DB::expr('SUM(`score`)'), 'total'))->from('Scores')
                        ->where('id_event', '=', $id_event)
                        ->and_where('id_stage', '=', $id_stage)
                        ->and_where('id_participant', '=', $participant)
                        ->and_where('id_judge', '=', '0')
                        ->execute()
                        ->as_array();
        }
        else {
            $select = DB::select(array(DB::expr('SUM(`score`)'), 'total'))->from('Scores')
                ->where('id_event', '=', $id_event)
                ->and_where('id_participant', '=', $participant)
                ->and_where('id_judge', '=', '0')
                ->execute()
                ->as_array();
        }
        return Arr::get($select, '0')['total'] ?: 0;
    }

}