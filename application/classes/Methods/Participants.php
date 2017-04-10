<?php

class Methods_Participants extends Model_Participant
{

    const UPDATE = "update";
    const DELETE = "delete";
    const INSERT = "insert";
    const SELECT = "select";

    /**
     * @param $id_event
     *
     * @return array result -- participants models
     */
    public static function getByEvent($id_event) {

        $participants = Dao_Participants::select()
            ->where('event', '=', $id_event)
            ->cached(Date::HOUR, 'event:' . $id_event)
            ->execute();

        $result = array();

        foreach($participants as $participant) {

            $model = new Model_Participant();
            $model->id    = $participant['id'];
            $model->event = $participant['event'];
            $model->name  = $participant['name'];
            $model->about = $participant['about'];
            $model->photo = $participant['photo'];

            array_push($result, $model);

        };

        return $result;

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