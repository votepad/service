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

        $result = array();

        foreach ($contests as $contest) {

            $result[] = array(
                'id' => $contest->id,
                'name' => $contest->name,
            );

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
