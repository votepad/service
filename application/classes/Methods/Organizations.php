<?php
/**
 * Created by PhpStorm.
 * User: Murod Khaydarov
 * Date: 25.01.17
 * Time: 16:34
 */

class Methods_Organizations extends Model_Organization {

    public static function isOrganizationWebsiteExists($website) {

        $select = DB::select('website')->from('Organizations')
            ->where('website', '=', $website)
            ->execute();

        return count($select) > 0 ? true : false;

    }

    public static function getAllEvents($id_organization) {

        $select = Dao_Events::select('id')
            ->where('organization', '=', $id_organization)
            ->execute();

        $events = array();

        if ( $select ) {

            foreach ($select as $eventId) {

                $events[] = new Model_Event($eventId['id']);

            }

        }

        return $events;

    }

}