<?php

class Methods_Stages extends  Model_Stage
{

    const MEMBERS_PARTICIPANTS = 1;
    const MEMBERS_TEAMS        = 2;
    const MEMBERS_GROUPS       = 3;

    public static function getByEvent($event) {

        $selection = Dao_Stages::select()
            ->where('event', '=', $event)
            ->execute();

        if (!$selection) {
            return array();
        }

        $stages = array();

        foreach ($selection as $row) {

            $stage = new Model_Stage();

            if (empty($row['id'])) continue;

            foreach ($row as $fieldname => $value) {
                if (property_exists($stage, $fieldname)) $stage->$fieldname = $value;
            }

            $formula = '[';

            foreach (json_decode($stage->formula) as $criterionID => $coeff) :

                $criterion = new Model_Criterion($criterionID);
                $formula .= '{"id":"' . $criterionID . '","name":"' . $criterion->name . '","coeff":"' . $coeff . '"},';

            endforeach;

            $stage->formula = substr($formula, 0, -1);

            if (strlen($stage->formula) != 0)
                $stage->formula .= ']';

            $stage->members = self::getMembers($stage->id, $stage->mode);

            $stages[] = $stage;

        }

        return $stages;

    }

    public static function getJSON($event) {

        $stages = self::getByEvent($event);

        $result = array();

        foreach ($stages as $stage) {

            $result[] = array(
                'id' => $stage->id,
                'name' => $stage->name
            );

        }

        return json_encode($result);

    }

    public static function saveMembers($stage, $members) {

        foreach ($members as $member) {
            Dao_StagesMembers::insert()
                ->set('s_id', $stage)
                ->set('m_id', $member)
                ->execute();
        }

    }


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
            /*case self::MEMBERS_GROUPS:
                $members = Dao_Groups::select();
                break;*/
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
                /*case self::MEMBERS_GROUPS:
                    $members = Dao_Groups::select();
                    break;*/
             }

            foreach ($member as $fieldname => $value) {
                if (property_exists($model, $fieldname)) $model->$fieldname = $value;
            }

            array_push($result, $model);

        };

        return $result;

    }

    public static function updateMembers($stage, $members) {

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

    public static function removeMembers($stage, $members) {

        if (empty($members)) {
            return;
        }

        Dao_StagesMembers::delete()
            ->where('s_id', '=', $stage)
            ->where('m_id', 'in', $members)
            ->execute();

    }

    public static function removeDependencies($stage) {

        Dao_StagesMembers::delete()
            ->where('s_id', '=', $stage)
            ->execute();

    }

    public static function getCriterions($formula) {

        $formula = json_decode($formula);

        $criterion = array();

        foreach ($formula as $id => $coef) {
            $criterion[] = new Model_Criterion($id);
        }

        return $criterion;

    }

}