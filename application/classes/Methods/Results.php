<?php

class Methods_Results extends  Model_Result
{
    /**
     * Get Participants and Teams Results by event_id
     * @param $id_event
     * @param bool $with_addition - include formula based on stages or not
     * @return array [Model_Stage]
     */
    public static function getAllByEvent($id_event, $with_addition = false) {

        $select_part = Dao_Results::select()
            ->where('event', '=', $id_event)
            ->where('mode', '=', 1)
            ->limit(1)
            ->execute();

        $select_team = Dao_Results::select()
            ->where('event', '=', $id_event)
            ->where('mode', '=', 2)
            ->limit(1)
            ->execute();

        $result['participants'] = new Model_Result();
        $result['teams'] = new Model_Result();

        if ($select_part) {
            $result['participants']->id = $select_part['id'];
            $result['participants']->event = $select_part['event'];
            $result['participants']->mode  = $select_part['mode'];
            if ($with_addition) {
                $result['participants']->formula = Methods_Contests::getJSONbyFormula($select_part['formula']);
            } else {
                $result['participants']->formula = $select_part['formula'];
            }
        }

        if ($select_team) {
            $result['teams']->id = $select_team['id'];
            $result['teams']->event = $select_team['event'];
            $result['teams']->mode  = $select_team['mode'];

            if ($with_addition) {
                $result['teams']->formula = Methods_Contests::getJSONbyFormula($select_team['formula']);
            } else {
                $result['teams']->formula = $select_team['formula'];
            }
        }

        return $result;
    }

}