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

}