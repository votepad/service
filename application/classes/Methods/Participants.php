<?php

class Methods_Participants extends Model_Participant
{

    /**
     * Get all participants by event ID
     * @param $id_event
     * @return array [Model_Participant]
     */
    public static function getAllByEvent($id_event)
    {

        $select = Dao_Participants::select()
            ->where('event', '=', $id_event)
            ->cached(Date::HOUR, 'event:' . $id_event)
            ->order_by('id', 'ASC')
            ->execute();

        $participants = array();

        if (!empty($select)) {

            foreach($select as $selection) {
                $participant = new Model_Participant();
                $participant->id    = $selection['id'];
                $participant->event = $selection['event'];
                $participant->name  = $selection['name'];
                $participant->about = $selection['about'];
                $participant->logo  = $selection['logo'];

                array_push($participants, $participant);
            };

        }

        return $participants;
    }

    /**
     * Get Participant By Event_id and Participant_name
     * @param $id_event
     * @param $name
     * @return Model_Participant
     */
    public static function getByEventAndName($id_event, $name)
    {

        $participant = Dao_Participants::select()
            ->where('event', '=', $id_event)
            ->where('name', '=', $name)
            ->limit(1)
            ->execute();

        return new Model_Participant($participant['id']);
    }

}