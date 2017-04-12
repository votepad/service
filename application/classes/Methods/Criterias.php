<?php

class Methods_Criterias extends Model_Criteria
{
    const UPDATE = "update";
    const DELETE = "delete";
    const INSERT = "insert";
    const SELECT = "select";


    /**
     * @param $id_event
     * @return array criterias
     */
    public static function getByEvent($id_event) {

        $criterias = Dao_Criteria::select()
            ->where('event', '=', $id_event)
            ->clearcache('event:' . $id_event)
            ->cached(Date::HOUR, 'event:' . $id_event)
            ->order_by('id', 'ASC')
            ->execute();

        if (!$criterias) {
            return array();
        }

        $result = array();

        foreach($criterias as $criteria) {
            $model = new Model_Criteria();
            $model->id          = $criteria['id'];
            $model->event       = $criteria['event'];
            $model->name        = $criteria['name'];
            $model->description = $criteria['description'];
            $model->min_score   = $criteria['min_score'];
            $model->max_score   = $criteria['max_score'];
            array_push($result, $model);
        };

        return $result;
    }

}