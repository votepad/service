<?php

class Methods_Teams extends Model_Teams
{

    const UPDATE = "update";
    const DELETE = "delete";
    const INSERT = "insert";
    const SELECT = "select";

    /**
     * @param $participant
     * @param $id_team
     * @param $id_event
     * @return bool
     */
    public static function addParticipantsToTeam($participant, $id_team) {

        try {

            $query = DB::insert('Teams_Participants', array(
                'id_team', 'id_participant'
            ))->values(array(
                $id_team, $participant
            ))->execute();


        } catch (Exception $e) {
            return false;
        }
    }

    public static function getAllTeams($id_event) {

        try {

            $teams = DB::select()->from('Teams')
                ->where('id_event', '=', $id_event)
                ->order_by('id', 'DESC')
                ->execute()
                ->as_array();

            $counter = 0;
            $result = array();

            foreach ($teams as $team) {

                $result[$counter] = new Model_Teams();

                $result[$counter]->id           = $team["id"];
                $result[$counter]->id_event     = $team["id_event"];
                $result[$counter]->name         = $team["name"];
                $result[$counter]->description  = $team["description"];
                $result[$counter]->logo         = $team["logo"];
                $result[$counter]->participants = Methods_Participants::getParticipantsFromTeams($team["id"]);
                $counter++;

            }

            return $result;

        } catch (Exception $e) {
            echo Debug::vars($e);
            exit;
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

}