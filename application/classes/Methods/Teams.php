<?php

class Methods_Teams extends Model_Team
{

    const UPDATE = "update";
    const DELETE = "delete";
    const INSERT = "insert";
    const SELECT = "select";


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
    public static function removeTeam($id) {

        Model_Teams::delete($id);
        self::removeParticipantFromTeam($id);

    }

    /**
     * @param $id_team
     * @param null $id_participant - which participant delete from team
     */
    public static function removeParticipantFromTeam($id_team, $id_participant = null) {

        if (!isset($id_participant)) {
            $delete = DB::delete('Teams_Participants')
                ->where('id_team', '=', $id_team)
                ->execute();
        } elseif (!isset($id_team)) {
            $delete = DB::delete('Teams_Participants')
                ->where('id_participant', '=', $id_participant)
                ->execute();
        } else {
            $delete = DB::delete('Teams_Participants')
                ->where('id_team', '=', $id_team)
                ->where('id_participant', '=', $id_participant)
                ->execute();
        }
    }

    /**
     * Updates team information
     *
     * @param $id_team
     * @param $name
     * @param $desciption
     * @param $logo
     * @param $participants
     */
    public static function editTeamInformation($id_team, $name, $desciption, $logo, $participants)
    {

        try {
            $model = Model_Teams::get($id_team);

            $model->name = $name;
            $model->description = $desciption;
            $model->logo = $logo ?: $model->logo;

            $model->save($id_team);

            /**
             * Getting array of current existed identities
             */
            $currentParticipants = Methods_Participants::getParticipantsFromTeams($id_team);
            $currentParticipantIds = array_map("Methods_Common::getObjectIdentities", $currentParticipants);

            /**
             * get differencies
             * that are in new list.
             * We should add them
             */
            $participantsThatAreInNewList = array_diff($participants, $currentParticipantIds);

            /**
             * Now, save participants that are in new list
             */
            foreach ($participantsThatAreInNewList as $participant) {
                self::addParticipantsToTeam($participant, $id_team);
            }

            /**
             * get differencies between current list and old one.
             * That ids we should remove
             */
            $participantsThatAreNotInNewList = array_diff($currentParticipantIds, $participants);

            /**
             * remove old ids from database
             */
            foreach ($participantsThatAreNotInNewList as $participant) {
                self::removeParticipantFromTeam($id_team, $participant);
            }

            return true;

        } catch (Exception $e) {
            echo Debug::vars($e);
        }

    }

    /**
     *
     * getting amount of participant ids
     *
     * @param $teams
     * @return [Array] $participantId;
     */
    public static function getAllParticipantsFromTeams($teams) {

        $allparticipants = array();

        foreach($teams as $team) {
            $fromOneTeam = $participants[] = array_map("Methods_Common::getObjectIdentities", Methods_Participants::getParticipantsFromTeams($team));

            foreach ($fromOneTeam as $ids) {
                array_push($allparticipants, $ids);
            }
        }

        return $allparticipants;
    }

    public static function getSetOfTeams($teamsId) {

        $result = array();

        foreach ($teamsId as $team) {
            array_push($result, self::get($team));
        }

        return $result;
    }

}
