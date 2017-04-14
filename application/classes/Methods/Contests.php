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

            $contest = new Model_Contest();

            if (empty($row['id'])) continue;
            foreach ($row as $fieldname => $value) {
                if (property_exists($contest, $fieldname)) $contest->$fieldname = $value;
            }

            $contest->judges = self::getJudges($contest->id);

            $contests[] = $contest;

        }

        return $contests;

    }

    public static function saveJudges($contest, $judges) {
        foreach($judges as $judge) {
            Dao_ContestsJudges::insert()
                ->set('c_id', $contest)
                ->set('j_id', $judge)
                ->execute();
        }
    }


    public static function getJudges($contest) {

        $selection = Dao_ContestsJudges::select('j_id')
            ->where('c_id', '=', $contest)
            ->execute('j_id');

        if (!$selection) {
            return array();
        }

        $selection = array_keys($selection);

        $judges = array();

        foreach ($selection as $id) {

            $judges[] = new Model_Judge($id);

        }

        return $judges;

    }

    public static function updateJudges($contest, $judges) {

        $oldJudges = Dao_ContestsJudges::select('j_id')
            ->where('c_id', '=', $contest)
            ->execute('j_id');

        if (!$oldJudges) {
            return array();
        }

        $oldJudges = array_keys($oldJudges);

        $deleted = array_diff($oldJudges, $judges);
        $added   = array_diff($judges, $oldJudges);

        self::removeJudges($contest, $deleted);
        self::saveJudges($contest, $added);
    }

    public static function removeJudges($contest, $judges) {

        if (empty($judges)) {
            return;
        }

        Dao_ContestsJudges::delete()
            ->where('c_id', '=', $contest)
            ->where('j_id', 'in', $judges)
            ->execute();

    }

}
