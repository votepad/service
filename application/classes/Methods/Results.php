<?php

class Methods_Results extends  Model_Result
{
    /**
     * Get Participants and Teams Results by event_id
     * @param $id_event
     * @param bool $with_addition - include formula based on stages or not
     * @return array [Model_Stage]
     */
    public static function getAllByEvent($id_event, $with_addition = false) {

        $select_part = Dao_Results::select()
            ->where('event', '=', $id_event)
            ->where('mode', '=', 1)
            ->limit(1)
            ->execute();

        $select_team = Dao_Results::select()
            ->where('event', '=', $id_event)
            ->where('mode', '=', 2)
            ->limit(1)
            ->execute();

        $result['participants'] = new Model_Result();
        $result['teams'] = new Model_Result();

        if ($select_part) {
            $result['participants']->id = $select_part['id'];
            $result['participants']->event = $select_part['event'];
            $result['participants']->mode  = $select_part['mode'];

            if ($with_addition) {
                $result['participants']->formula = Methods_Contests::getJSONbyFormula($select_part['formula']);
            } else {
                $result['participants']->formula = $select_part['formula'];
            }
        }

        if ($select_team) {
            $result['teams']->id = $select_team['id'];
            $result['teams']->event = $select_team['event'];
            $result['teams']->mode  = $select_team['mode'];

            if ($with_addition) {
                $result['teams']->formula = Methods_Contests::getJSONbyFormula($select_team['formula']);
            } else {
                $result['teams']->formula = $select_team['formula'];
            }
        }

        $result['participants']->contests = array();
        $result['teams']->contests = array();

        return $result;
    }


    /**
     * Get Results with Scores, Contest, Stages, Criterions, Members
     * @param $id_event - event ID
     * @return array
     */
    public static function getResults($id_event)
    {
        $redis = Dispatch::redisInstance();

        $results = Methods_Results::getAllByEvent($id_event);

        $publish_contents = $redis->sMembers(getenv('REDIS_EVENTS') . $id_event . ':publish:contests');
        $publish_stages   = $redis->sMembers(getenv('REDIS_EVENTS') . $id_event . ':publish:stages');

        foreach ($results as $resultKey => $result) {

            if ($result->id) {

                $result_formula = json_decode($result->formula, true);
                $result_max_score = 0;
                $contests = array();

                foreach ($result_formula as $contestID => $coeff) {
                    array_push($contests, new Model_Contest($contestID));
                }

                foreach ($contests as $contestKey => $contest) {

                    if ($contest->id) {

                        $contest_formula = json_decode($contest->formula, true);
                        $contest_max_score = 0;
                        $stages = array();

                        foreach ($contest_formula as $stageID => $coeff) {
                            array_push($stages, new Model_Stage($stageID));
                        }

                        $judges = Methods_Contests::getJudges($contest->id);

                        foreach ($stages as $stageKey => $stage) {

                            if ($stage->id) {

                                $stage_formula = json_decode($stage->formula, true);
                                $stage_max_score = 0;
                                $criterions = array();

                                foreach ($stage_formula as $criterionID => $coeff) {
                                    array_push($criterions, new Model_Criterion($criterionID));
                                }


                                foreach ($criterions as $criterionKey => $criterion) {
                                    $stage_max_score   += $criterion->maxScore * $stage_formula[$criterion->id];
                                    $contest_max_score += $stage_max_score * $contest_formula[$stage->id];
                                    $result_max_score  += $contest_max_score * $result_formula[$contest->id];
                                }

                                $stage_max_score   *= count($judges);
                                $contest_max_score *= count($judges);
                                $result_max_score  *= count($judges);

                                $stages[$stageKey]->maxScore = $stage_max_score;
                                $stages[$stageKey]->criterions = $criterions;
                                $stages[$stageKey]->publish = in_array($contest->id . '-' . $stage->id, $publish_stages);

                            }

                        }

                        $contests[$contestKey]->maxScore = $contest_max_score;
                        $contests[$contestKey]->stages = $stages;
                        $contests[$contestKey]->judges = $judges;
                        $contests[$contestKey]->publish = in_array($contest->id, $publish_contents);

                    }

                    $results[$resultKey]->maxScore = $result_max_score;
                    $results[$resultKey]->contests = $contests;

                }

            }

        }

        return $results;

    }


    /**
     * Get Result Coefficient By Contest
     * @param $contest [Model_Contest]
     * @return int
     */
    public static function getResultCoeff($contest)
    {
        $results = Methods_Results::getAllByEvent($contest->event);
        $result_coeff = 1;

        foreach ($results as $result) {

            if ($result->id) {

                $formula = (array)json_decode($result->formula);

                foreach ($formula as $id => $coeff) {
                    if ($id == $contest->id) {
                        $result_coeff = $coeff;
                        break;
                    }
                }

            }

        }

        return $result_coeff;

    }

}