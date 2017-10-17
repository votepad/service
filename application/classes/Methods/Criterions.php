<?php

class Methods_Criterions extends Model_Criterion
{
    /**
     * Get All Criterions by event_id
     * @param $id_event
     * @return array [Model_Criteria]
     */
    public static function getAllByEvent($id_event) {

        $select = Dao_Criterions::select()
            ->where('event', '=', $id_event)
            ->cached(Date::HOUR, 'event:' . $id_event)
            ->order_by('id', 'ASC')
            ->execute();

        $criterions = array();

        if ($select) {
            foreach($select as $db_selection) {
                $criterion = new Model_Criterion();
                $criterion->id          = $db_selection['id'];
                $criterion->event       = $db_selection['event'];
                $criterion->name        = $db_selection['name'];
                $criterion->description = $db_selection['description'];
                $criterion->min_score   = $db_selection['min_score'];
                $criterion->max_score   = $db_selection['max_score'];
                array_push($criterions, $criterion);
            };
        }

        return $criterions;
    }

    /**
     * Get Criterions For Formula
     * @param $event - event ID
     * @return string [JSON]
     */
    public static function getJSON($event) {

        $criterions = self::getAllByEvent($event);
        $result = array();

        foreach ($criterions as $criterion) {
            $result[] = array(
                'id'   => $criterion->id,
                'name' => $criterion->name
            );
        }

        return json_encode($result);
    }

}