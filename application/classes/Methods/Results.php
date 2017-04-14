<?php

class Methods_Results extends  Model_Result
{

    public static function getByEvent($event) {

        $selection = Dao_Results::select()
            ->where('event', '=', $event)
            ->limit(1)
            ->execute();


        $result = new Model_Result();

        if (empty($selection['id'])) {
            return $result;
        }

        foreach ($selection as $fieldname => $value) {
            if (property_exists($result, $fieldname)) $result->$fieldname = $value;
        }

        return $result;

    }

}