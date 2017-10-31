<?php

class Methods_Contests extends Model_Contest
{


    /**
     * Get All Contests by event_id
     * @param $id_event
     * @param bool $with_addition - include formula based on staged and judges or not
     * @return array [Model_Stage]
     */
    public static function getAllByEvent($id_event, $with_addition = false) {

        $select = Dao_Contests::select()
            ->where('event', '=', $id_event)
            ->execute();

        $contests = array();

        if ($select) {

            foreach ($select as $selection) {

                $contest = new Model_Contest();

                foreach ($selection as $fieldname => $value) {
                    if (property_exists($contest, $fieldname)) $contest->$fieldname = $value;
                }

                if ($with_addition) {

                    $formula = array();

                    foreach (json_decode($contest->formula) as $stageID => $coeff) {

                        $stage = new Model_Stage($stageID);

                        if ($stage->id) {
                            $formula[] = array(
                                "id" => $stageID,
                                "name" => $stage->name,
                                "coeff" => $coeff,
                                "type" => $stage->mode
                            );
                        }

                    }

                    $contest->formula = json_encode($formula);
                    $contest->judges = self::getJudges($contest->id);
                }

                $contests[] = $contest;

            }
        }

        return $contests;

    }


    /**
     * Get Contests For Formula
     * @param $event - event ID
     * @return string [JSON]
     */
    public static function getJSON($event) {

        $contests = self::getAllByEvent($event);

        $result['participants'] = array();
        $result['teams'] = array();

        foreach ($contests as $contest) {

            switch ($contest->mode) {
                case 1:
                    array_push($result['participants'], array(
                        'id' => $contest->id,
                        'name' => $contest->name,
                        'type' => $contest->mode
                    ));
                    break;
                case 2:
                    array_push($result['teams'], array(
                        'id' => $contest->id,
                        'name' => $contest->name,
                        'type' => $contest->mode
                    ));
                    break;
            }
        }

        return $result;

    }


    /**
     * Get JSON by formula
     * @param $formula - [{'id':'coeff'}]
     * @return string [JSON]
     */
    public static function getJSONbyFormula($formula)
    {
        $result = array();

        foreach (json_decode($formula) as $contestID => $coeff) {

            $contest = new Model_Contest($contestID);

            if ($contest->id) {
                $result[] = array(
                    "id"    => $contest->id,
                    "name"  => $contest->name,
                    "coeff" => $coeff,
                    "type"  => $contest->mode
                );
            }

        }

        return json_encode($result);
    }


    /**
     * Add Dependence Contest-Judge
     * @param $contest - contest ID
     * @param $judges - array of judges ID
     */
    public static function saveJudges($contest, $judges)
    {
        foreach($judges as $judge) {
            Dao_ContestsJudges::insert()
                ->set('c_id', $contest)
                ->set('j_id', $judge)
                ->execute();
        }
    }


    /**
     * Get Judges By Contest ID
     * @param $contest - contest ID
     * @return array
     */
    public static function getJudges($contest)
    {
        $judges_id = Dao_ContestsJudges::select('j_id')
            ->where('c_id', '=', $contest)
            ->execute('j_id');

        $judges = array();

        if ($judges_id) {

            $judges_id = array_keys($judges_id);

            foreach ($judges_id as $id) {
                $judges[] = new Model_Judge($id);
            }
        }
        return $judges;
    }


    /**
     * Update Judges by contest id
     * @param $contest - contest ID
     * @param $judges - array of judges IDs
     * @return array
     */
    public static function updateJudges($contest, $judges)
    {
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


    /**
     * Remove Dependence Contest-Judge
     * @param $contest - contest ID
     * @param $judges - array of judges IDs
     */
    public static function removeJudges($contest, $judges)
    {
        if (empty($judges)) return;

        Dao_ContestsJudges::delete()
            ->where('c_id', '=', $contest)
            ->where('j_id', 'in', $judges)
            ->execute();
    }


    /**
     * Remove All Dependence Contest-Judge
     * @param $contest - contest ID
     */
    public static function removeAllJudges($contest)
    {
        Dao_ContestsJudges::delete()
            ->where('c_id', '=', $contest)
            ->execute();
    }


    /**
     * Remove All Dependence Contest-Judge
     * @param $judges - judge ID
     */
    public static function removeJudge($judges)
    {
        Dao_ContestsJudges::delete()
            ->where('j_id', '=', $judges)
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

    /**
     * Get Contests By Judge
     * @param $judge - judge ID
     * @param bool $getOnlyIds
     * @return $this|array|bool|mixed|object
     */
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
