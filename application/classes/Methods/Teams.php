<?php

class Methods_Teams extends Model_Team
{
    /**
     * Get All Teams By event_id
     * @param $id_event
     * @return array [Model_Team]
     */
    public static function getAllByEvent($id_event) {

        $select = Dao_Teams::select()
            ->where('event', '=', $id_event)
            ->order_by('id', 'ASC')
            ->execute();

        $teams = array();

        if ($select) {
            foreach($select as $db_selection) {
                $team = new Model_Team();
                $team->id          = $db_selection['id'];
                $team->event       = $db_selection['event'];
                $team->name        = $db_selection['name'];
                $team->description = $db_selection['description'];
                $team->logo        = $db_selection['logo'];

                array_push($teams, $team);
            };
        }

        return $teams;
    }

    /**
     * Get Teams By event_id and team_name
     * @param $id_event
     * @param $name - team name
     * @return Model_Team
     */
    public static function getByEventAndName($id_event, $name) {
        $participant = Dao_Teams::select()
            ->where('event', '=', $id_event)
            ->where('name', '=', $name)
            ->limit(1)
            ->execute();

        return new Model_Team($participant['id']);
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
