<?php

class Methods_Groups extends Model_Groups {

    public static function getAllGroups($id_event) {

        $select = DB::select()->from('Groups')
            ->where('id_event', '=', $id_event)
            ->execute()
            ->as_array();

        return $select;

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

}