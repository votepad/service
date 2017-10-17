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
    
}
