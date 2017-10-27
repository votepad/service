<?php

class Methods_Results extends  Model_Result
{
    /**
     * Get All Contest by event_id
     * @param $id_event
     * @param bool $with_addition - include formula based on stages or not
     * @return array [Model_Stage]
     */
    public static function getAllByEvent($id_event, $with_addition = false) {

        $select = Dao_Results::select()
            ->where('event', '=', $id_event)
            ->limit(2)
            ->execute();

        $result['teams'] = new Model_Result();
        $result['participants'] = new Model_Result();

//        if (!empty($select)) {
//            foreach ($select as $selection) {
//                $result = new Model_Result();
//                $result->id      = $selection['id'];
//                $result->event   = $selection['event'];
//                $result->mode    = $selection['mode'];
//
//                if ($with_addition) {
//                    $result->formula = Methods_Contests::getJSONbyFormula($selection['formula']);
//                } else {
//                    $result->formula = $selection['formula'];
//                }
//
//                array_push($results, $result);
//            }
//        }

        return $result;

    }

}