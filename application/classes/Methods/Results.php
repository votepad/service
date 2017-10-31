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

        return $result;
    }


    /**
     * Get Results with Scores, Contest, Stages, Criterions, Members
     * @param $id_event - event ID
     * @return array
     */
    public static function getResults($id_event, $full = true)
    {
        $redis = Dispatch::redisInstance();

        $results = Methods_Results::getAllByEvent($id_event);

        if ($full == false) {
            return $results;
        }

        $publish_contents = $redis->sMembers(getenv('REDIS_EVENTS') . $id_event . ':publish:contests');
        $publish_stages   = $redis->sMembers(getenv('REDIS_EVENTS') . $id_event . ':publish:stages');

        foreach ($results as $resultKey => $result) {

            if ($result->id) {

                $result_formula = json_decode($result->formula, true);

                $contests = array();

                foreach ($result_formula as $contestID => $coeff) {
                    array_push($contests, new Model_Contest($contestID));
                }

                $results[$resultKey]->contests = $contests;

                foreach ($contests as $contestKey => $contest) {

                    if ($contest->id) {

                        $contest_formula = json_decode($contest->formula, true);

                        $stages = array();

                        foreach ($contest_formula as $stageID => $coeff) {
                            array_push($stages, new Model_Stage($stageID));
                        }

                        $results[$resultKey]->contests[$contestKey]->stages = $stages;
                        $results[$resultKey]->contests[$contestKey]->judges = Methods_Contests::getJudges($contest->id);
                        $results[$resultKey]->contests[$contestKey]->publish = in_array($contest->id, $publish_contents);

                        foreach ($stages as $stageKey => $stage) {

                            if ($stage->id) {

                                $stage_formula = json_decode($stage->formula, true);

                                $criterions = array();

                                foreach ($stage_formula as $criterionID => $coeff) {
                                    array_push($criterions, new Model_Criterion($criterionID));
                                }

                                $results[$resultKey]->contests[$contestKey]->stages[$stageKey]->criterions = $criterions;
                                $results[$resultKey]->contests[$contestKey]->stages[$stageKey]->publish = in_array($contest->id . '-' . $stage->id, $publish_stages);

                            }

                        }

                    }

                }

            }

        }

        return $results;




        foreach ($contests as $contestKey => $contest) {

            if ($contest->id) {

                $contest_coeff = json_decode($result->formula, true);

                $stages = array();

                foreach (json_decode($contest->formula) as $stageID => $coeff) {
                    array_push($stages, new Model_Stage($stageID));
                }

                $contest->stages = $stages;

                $contest_max_score = 0;
                $stages_coeff = json_decode($contest->formula, true);

                foreach ($contest->stages as $stageKey => $stage) {

                    if ($stage->id) {

                        $criterions = Methods_Criterions::getCriterions($stage->formula);

                        $stage_max_score = 0;
                        $crit_coeff = json_decode($stage->formula, true);

                        foreach ($criterions as $criterionKey => $criterion) {
                            $stage_max_score   += $criterion->max_score * $crit_coeff[$criterion->id];
                            $contest_max_score += $criterion->max_score * $crit_coeff[$criterion->id] * $stages_coeff[$stageKey]["coeff"];
                        }

                        $stage_max_score *= count($contest->judges);

                        $contests[$contestKey]->stages[$stageKey]->criterions = $criterions;
                        $contests[$contestKey]->stages[$stageKey]->max_score = $stage_max_score;

                        if ($with_members) {
                            $members = Methods_Stages::getMembers($stage->id, $stage->mode);
                            $contests[$contestKey]->stages[$stageKey]->members = $members;
                        }

                        if ($with_publish_result) {
                            if (Arr::get($arr_result, $contest->id) && Arr::get($arr_result[$contest->id], $stage->id)) {
                                $contests[$contestKey]->stages[$stageKey]->is_publish = $arr_result[$contest->id][$stage->id];
                            } else {
                                $contests[$contestKey]->stages[$stageKey]->is_publish = false;
                            }
                        }

                    }

                }

                $contests[$contestKey]->max_score = $contest_max_score*count($contests[$contestKey]->judges);

                if ($with_publish_result) {
                    if (Arr::get($arr_result, $contest->id)) {
                        $contests[$contestKey]->is_publish = count($contest->stages) == count($arr_result[$contest->id]);
                    } else {
                        $contests[$contestKey]->is_publish = false;
                    }
                }
            }
        }
        return $contests;
    }

}