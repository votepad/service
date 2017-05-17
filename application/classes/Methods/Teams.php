<?php

class Methods_Teams extends Model_Team
{

    const UPDATE = "update";
    const DELETE = "delete";
    const INSERT = "insert";
    const SELECT = "select";

    public static function getByEvent($id_event) {

        $teams = Dao_Teams::select()
            ->where('event', '=', $id_event)
            ->order_by('id', 'ASC')
            ->execute();

        if (!$teams) {
            return array();
        }

        $result = array();

        foreach($teams as $team) {

            $model = new Model_Team();
            $model->id          = $team['id'];
            $model->event       = $team['event'];
            $model->name        = $team['name'];
            $model->description = $team['description'];
            $model->logo        = $team['logo'];

            array_push($result, $model);

        };

        return $result;

    }


    public static function addParticipant($participant, $team)
    {

        return Dao_Participants::update()
            ->where('id', '=', $participant)
            ->set('team', $team)
            ->execute();

    }

    public static function getAllTeams($id_event) {

        $selection = Dao_Teams::select()
            ->where('event', '=', $id_event)
            ->execute();

        if (!$selection) {
            return array();
        }

        $teams = array();

        foreach ($selection as $row) {

            $team = new Model_Team();

            if (empty($row['id'])) continue;
            foreach ($row as $fieldname => $value) {
                if (property_exists($team, $fieldname)) $team->$fieldname = $value;
            }

            $team->participants = self::getTeamParticipants($team->id);

            $teams[] = $team;

        }

        return $teams;

    }

    public static function getParticipantsWhitOutTeam($event) {

        $selection = Dao_Participants::select()
            ->where('event', '=', $event)
            ->where('team', 'is', NULL)
            ->execute('id');

        $participants = array();

        if (!$selection) {
            return $participants;
        }

        foreach ($selection as $row) {

            $participant = new Model_Participant();

            if (empty($row['id'])) continue;
            foreach ($row as $fieldname => $value) {
                if (property_exists($participant, $fieldname)) $participant->$fieldname = $value;
            }

            $participants[] = $participant;

        }

        return $participants;

    }

    public static function getTeamParticipants($team, $only_ids = false) {

        $selection = Dao_Participants::select()
            ->where('team', '=', $team)
            ->execute('id');

        $participants = array();

        if (!$selection) {
            return $participants;
        }

        if ($only_ids) {
            return array_keys($selection);
        }

        foreach ($selection as $row) {

            $participant = new Model_Participant();

            if (empty($row['id'])) continue;
            foreach ($row as $fieldname => $value) {
                if (property_exists($participant, $fieldname)) $participant->$fieldname = $value;
            }

            $participants[] = $participant;

        }

        return $participants;

    }

    public static function updateParticipants($team, $participants) {

        $teamParticipants = self::getTeamParticipants($team, true);

        $deleted = array_diff($teamParticipants, $participants);

        if (!empty($participants)) {

            Dao_Participants::update()
                ->set('team', $team)
                ->where('id', 'in', $participants)
                ->execute();
        }

        if (!empty($deleted)) {
            Dao_Participants::update()
                ->set('team', NULL)
                ->where('id', 'in', $deleted)
                ->execute();
        }

    }

    /**
     * When we delete a team, we should delete all participants
     * @param $id - Event id
     */
    public static function removeParticipants($team){

        Dao_Participants::update()
            ->set('team', NULL)
            ->where('team', '=', $team)
            ->execute();

    }

}
