<?php

class Methods_Groups extends Model_Groups {

    public static function getAllGroups($id_event) {

        $select = DB::select()->from('Groups')
            ->where('id_event', '=', $id_event)
            ->execute()
            ->as_array();

        $result = array();
        foreach ($select as $item) {

            $group = new Model_Groups();
            array_push($result, $group->get($item['id']));

        }

        return $result;

    }

    public static function getGroupComposition($id_group)
    {
        $select = DB::select()->from('Groups_Composition')
            ->where('id_group', '=', $id_group)
            ->execute()
            ->as_array();
    }

    public static function addGroupMembers($id_group, $member) {

        try {
            $insert = DB::insert('Group_Members', array('id_group', 'id_member'))
                ->values(array($id_group, $member))
                ->execute();

            return $insert;

        } catch ( Exception $e ) {

            echo Debug::vars($e);
            return null;
        }

    }

    public static function removeGroup($id_group)
    {
        try {

            $delete = DB::delete('Groups')
                ->where('id', '=', $id_group)
                ->execute();

            $delete = DB::delete('Group_Members')
                ->where('id_group', '=', $id_group)
                ->execute();

            return true;

        } catch ( Exception $e ) {

            echo Debug::vars($e);
            return null;

        }

    }

    public static function getGroupMembers($id_group, $mode)
    {
        $select = DB::select('id_member')
            ->from('Group_Members')
            ->where('id_group', '=', $id_group)
            ->execute()
            ->as_array();

        $members = array();
        foreach($select as $member) {
            array_push($members, $member['id_member']);
        }

        if ($mode == self::GROUP_TYPE_PARTICIPANTS) {

            $participants = Methods_Participants::getSetOfParticipants($members);
            return $participants;

        } else {
            $teams = Methods_Teams::getSetOfTeams($members);
            return $teams;
        }
    }

}