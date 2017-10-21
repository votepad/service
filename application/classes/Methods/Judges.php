<?php

class Methods_Judges extends Model_Judge
{

    /**
     * Get all judges by event ID
     * @param $id_event
     * @return array [Model_Judge]
     */
    public static function getAllByEvent($id_event) {

        $select = Dao_Judges::select()
            ->where('event', '=', $id_event)
            ->order_by('id', 'ASC')
            ->execute();

        $judges = array();

        if ($select) {
            foreach($select as $db_selection) {
                $judge = new Model_Judge();
                $judge->id        = $db_selection['id'];
                $judge->event     = $db_selection['event'];
                $judge->name      = $db_selection['name'];
                $judge->password  = $db_selection['password'];
                $judge->dt_create = $db_selection['dt_create'];
                array_push($judges, $judge);
            };
        }

        return $judges;

    }


    /**
     * Get judge by event ID and password
     * @param $id_event
     * @param $password
     * @return Model_Judge
     */
    public static function getJudge($id_event, $password) {

        $judge = Dao_Judges::select()
            ->where('event', '=', $id_event)
            ->where('password', '=', $password)
            ->limit(1)
            ->execute();

        return new Model_Judge($judge['id']);

    }

}