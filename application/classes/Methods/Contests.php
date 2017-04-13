<?php

class Methods_Contests extends Model_Contest
{

    public static function getByEvent($id_event) {

        $selection = Dao_Contests::select()
            ->where('event', '=', $id_event)
            ->execute();

        if (!$selection) {
            return array();
        }

        $contests = array();

        foreach ($selection as $row) {

            $contest = new Model_Team();

            if (empty($row['id'])) continue;
            foreach ($row as $fieldname => $value) {
                if (property_exists($contest, $fieldname)) $contest->$fieldname = $value;
            }

            $contests[] = $contest;

        }

        return $contests;

    }


}
