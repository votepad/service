<?php

class Methods_Participants extends Model_Participants
{

    const UPDATE = "update";
    const DELETE = "delete";
    const INSERT = "insert";
    const SELECT = "select";

    /**
     * @param $id
     * @returns Model_Participants object
     */
    public static function getParticipant($id) {
        return self::get($id);
    }

    /**
     * @param $id_event
     */
    public static function getParticipantsFromEvent($id_event) {

        $participant_ids = DB::select('id_participant')->from('Event_Participants')
            ->where('id_event', '=', $id_event)
            ->execute()
            ->as_array();

        $result = array();

        foreach($participant_ids as $data) {

            foreach ($data as $id) {

                $participant = self::getParticipant($id);

                if ($participant) {
                    $result[] = $participant;
                }
            }
        };

        return $result;

    }

    /**
     * Sets participant id to event entry
     *
     * @param $id_participant
     * @param $id_event
     */
    public static function setParticipantEventEntry($id_event, $id_participant) {

        try {

            $query = DB::insert('Event_Participants', array('id_event', 'id_participant'))
                ->values(array($id_event, $id_participant))
                ->execute();

        } catch (Exception $e) {

            return false;

        }
    }

    public static function getParticipantByFieldName($field, $value) {

        try {

            $query = DB::select()->from('Participants')
                ->where($field, '=', $value)
                ->limit(1)
                ->execute();

            return Arr::get($query, '0');

        } catch (Exception $e) {
            return false;
        }

    }

    public static function getParticipantsFromTeams($id_team) {

        try {

            $participants = DB::select()->from('Teams_Participants')
                ->where('id_team', '=', $id_team)
                ->execute()
                ->as_array();

            $counter = 0;
            $result = array();

            foreach($participants as $participant) {

                $result[$counter] = self::getParticipant($participant["id_participant"]);
                $counter ++;
            }

            return $result;

        } catch (Exception $e) {
            return false;
        }

    }

    /**
     * @param $id
     */
    public static function removeParticipant($id) {
        self::delete($id);
    }

    public static function getSetOfParticipants($participantsId) {

        $result = array();

        foreach ($participantsId as $participant) {
            array_push($result, self::getParticipant($participant));
        }

        return $result;

    }
}