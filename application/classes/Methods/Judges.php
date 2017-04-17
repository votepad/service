<?php

class Methods_Judges extends Model_Judge
{

    const UPDATE = "update";
    const DELETE = "delete";
    const INSERT = "insert";
    const SELECT = "select";

    /**
     * @param $id_event
     *
     * @return array result -- judges models
     */
    public static function getByEvent($id_event) {

        $judges = Dao_Judges::select()
            ->where('event', '=', $id_event)
            ->cached(Date::HOUR, 'event:' . $id_event)
            ->order_by('id', 'ASC')
            ->execute();

        if (!$judges) {
            return array();
        }

        $result = array();

        foreach($judges as $judge) {

            $model = new Model_Judge();
            $model->id       = $judge['id'];
            $model->event    = $judge['event'];
            $model->name     = $judge['name'];
            $model->password = $judge['password'];

            array_push($result, $model);

        };

        return $result;

    }

    public static function getJudge($id_event, $password) {

        $judge = Dao_Judges::select()
            ->where('event', '=', $id_event)
            ->where('password', '=', $password)
            ->limit(1)
            ->execute();

        return new Model_Judge($judge['id']);

    }

}