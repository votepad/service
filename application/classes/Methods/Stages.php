<?php

class Methods_Stages extends  Model_Stage
{

    const CHARACTER_PARTICIPANTS = 1;
    const CHARACTER_TEAMS        = 2;
    const CHARACTER_GROUPS       = 3;

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

            $stage->characters = self::getCharacters($stage->id, $stage->mode);

            $stages[] = $stage;

        }

        return $stages;

    }

    public static function saveCharacters($stage, $characters, $mode) {

        foreach ($characters as $character) {
            Dao_StagesCharacters::insert()
                ->set('s_id', $stage)
                ->set('c_id', $character)
                ->execute();
        }

    }


    public static function getCharacters($stage, $mode) {

        $characters_ids = Dao_StagesCharacters::select('c_id')
            ->where('s_id', '=', $stage)
            ->execute('c_id');

        if (!$characters_ids) {
            return array();
        }

        $characters_ids = array_keys($characters_ids);

        switch ($mode) {
            case self::CHARACTER_PARTICIPANTS:
                $characters = Dao_Participants::select();
                $model = new Model_Participant();
                break;
            case self::CHARACTER_TEAMS:
                $characters = Dao_Teams::select();
                $model = new Model_Team();
                break;
            /*case self::CHARACTER_GROUPS:
                $characters = Dao_Groups::select();
                break;*/
            default:
                return array();
        }

        $characters = $characters
                        ->where('id', 'in', $characters_ids)
                        ->execute();

        if (!$characters) {
            return array();
        }

        $result = array();

        foreach($characters as $character) {

            foreach ($character as $fieldname => $value) {
                if (property_exists($model, $fieldname)) $model->$fieldname = $value;
            }

            array_push($result, $model);

        };

        return $result;

    }

    public static function removeDependencies($stage) {

        Dao_StagesCharacters::delete()
            ->where('s_id', '=', $stage)
            ->execute();

    }

}