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

            $formula = '[';

            foreach (json_decode($contest->formula) as $stageID => $coeff) :

                $stage = new Model_Stage($stageID);

                if ($stage->id) :
                    $formula .= '{"id":"' . $stageID  . '","name":"' . $stage->name . '","coeff":"' . $coeff . '","type":"' . $stage->mode . '"},';
                endif;

            endforeach;

            $contest->formula = substr($formula, 0, -1);

            if (strlen($contest->formula) != 0)
                $contest->formula .= ']';

            $contest->judges = self::getJudges($contest->id);

            $contests[] = $contest;

        }

        return $contests;

    }


    public static function getJSON($event) {

        $contests = self::getByEvent($event);

        $result = array();

        foreach ($contests as $contest) {

            $result[] = array(
                'id' => $contest->id,
                'name' => $contest->name,
            );

        }

        return json_encode($result);

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

    public static function removeDependencies($contest) {

        Dao_ContestsJudges::delete()
            ->where('c_id', '=', $contest)
            ->execute();

    }

    public static function getStages($formula) {

        $formula = json_decode($formula);

        $stages = array();
        foreach ($formula as $id => $coef) {
            $stages[] = new Model_Stage($id);
        }

        return $stages;

    }

    public static function getByJudge($judge, $getOnlyIds = false) {

        $selection = Dao_ContestsJudges::select('c_id')
            ->where('j_id', '=', $judge)
            ->execute('c_id');

        if (!$selection) {
            return array();
        }

        $selection = array_keys($selection);

        if ($getOnlyIds) {
            return $selection;
        }

        $contests = array();

        foreach ($selection as $id) {

            $contests[] = new Model_Contest($id);

        }

        return $contests;


    }

}
