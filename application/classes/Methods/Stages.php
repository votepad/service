<?php

class Methods_Stages extends  Model_Stage
{

    const MEMBERS_PARTICIPANTS = 1;
    const MEMBERS_TEAMS        = 2;


    /**
     * Get All Stages by event_id
     * @param $id_event
     * @param bool $with_addition - include formula based on criterions and members or not
     * @return array [Model_Stage]
     */
    public static function getAllByEvent($id_event, $with_addition = false)
    {
        $select = Dao_Stages::select()
            ->where('event', '=', $id_event)
            ->execute();

        $stages = array();

        if ($select) {

            foreach ($select as $selection) {

                $stage = new Model_Stage();

                foreach ($selection as $fieldname => $value) {
                    if (property_exists($stage, $fieldname)) $stage->$fieldname = $value;
                }

                if ($with_addition) {

                    $formula = array();

                    foreach (json_decode($stage->formula) as $criterionID => $coeff) {
                        $criterion = new Model_Criterion($criterionID);
                        if ($criterion->id) {
                            $formula[] = array(
                                "id" => $criterionID,
                                "name" => $criterion->name,
                                "coeff" => $coeff
                            );
                        }
                    }

                    $stage->formula = json_encode($formula);
                    $stage->members = self::getMembers($stage->id, $stage->mode);
                }

                array_push($stages, $stage);

            }

        }

        return $stages;
    }


    /**
     * Get Stages For Formula
     * @param $event - event ID
     * @return string [JSON]
     */
    public static function getJSON($event) {

        $stages = self::getAllByEvent($event);

        $result = array();

        foreach ($stages as $stage) {

            $result[] = array(
                'id' => $stage->id,
                'name' => $stage->name,
                'type' => $stage->mode
            );

        }

        return json_encode($result);
    }


    /**
     * Get JSON by formula
     * @param $formula - [{'id':'coeff'}]
     * @return string [JSON]
     */
    public static function getJSONbyFormula($formula)
    {
        $result = array();

        foreach (json_decode($formula) as $stageID => $coeff) {

            $stage = new Model_Stage($stageID);

            if ($stage->id) {
                $result[] = array(
                    "id" => $stageID,
                    "name" => $stage->name,
                    "coeff" => $coeff,
                    "type" => $stage->mode
                );
            }

        }

        return json_encode($result);
    }


    /**
     * Add Dependence Stage-Member
     * @param $stage - stage_id
     * @param $members - array of member_id
     */
    public static function saveMembers($stage, $members)
    {
        foreach ($members as $member) {

            Dao_StagesMembers::insert()
                ->set('s_id', $stage)
                ->set('m_id', $member)
                ->execute();

        }
    }


    /**
     * Get Members By Stage Id
     * @param $stage - stage_id
     * @param $mode - 1 || 2 => (participants || teams)
     * @return array
     */
    public static function getMembers($stage, $mode) {

        $members_ids = Dao_StagesMembers::select('m_id')
            ->where('s_id', '=', $stage)
            ->execute('m_id');

        if (!$members_ids) {
            return array();
        }

        $members_ids = array_keys($members_ids);

        switch ($mode) {
            case self::MEMBERS_PARTICIPANTS:
                $members = Dao_Participants::select();
                break;
            case self::MEMBERS_TEAMS:
                $members = Dao_Teams::select();
                break;
            default:
                return array();
        }

        $members = $members
            ->where('id', 'in', $members_ids)
            ->execute();

        if (!$members) {
            return array();
        }

        $result = array();

        foreach($members as $member) {

            switch ($mode) {
                case self::MEMBERS_PARTICIPANTS:
                    $model = new Model_Participant();
                    break;
                case self::MEMBERS_TEAMS:
                    $model = new Model_Team();
                    break;
             }

            foreach ($member as $fieldname => $value) {
                if (property_exists($model, $fieldname)) $model->$fieldname = $value;
            }

            array_push($result, $model);

        };

        return $result;

    }


    /**
     * Update Members by stage id
     * @param $stage - stage ID
     * @param $members - array of members ID
     * @return array
     */
    public static function updateMembers($stage, $members)
    {
        $oldMembers = Dao_StagesMembers::select('m_id')
            ->where('s_id', '=', $stage)
            ->execute('m_id');

        if (!$oldMembers) {
            return array();
        }

        $oldMembers = array_keys($oldMembers);

        $deleted = array_diff($oldMembers, $members);
        $added   = array_diff($members, $oldMembers);

        self::removeMembers($stage, $deleted);
        self::saveMembers($stage, $added);
    }


    /**
     * Remove Dependence Stage-Member
     * @param $stage - stage ID
     * @param $member - member ID
     */
    public static function removeMembers($stage, $member)
    {
        if (empty($member)) return;

        Dao_StagesMembers::delete()
            ->where('s_id', '=', $stage)
            ->where('m_id', 'in', $member)
            ->execute();
    }


    /**
     * Remove All Dependence Stage-Member
     * @param $stage - stage ID
     */
    public static function removeAllMembers($stage)
    {
        Dao_StagesMembers::delete()
            ->where('s_id', '=', $stage)
            ->execute();
    }





    public static function getCriterions($formula)
    {
        $formula = json_decode($formula);

        $criterion = array();

        foreach ($formula as $id => $coef) {
            $criterion[] = new Model_Criterion($id);
        }

        return $criterion;

    }

}