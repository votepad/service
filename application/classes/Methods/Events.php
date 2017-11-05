<?php

class Methods_Events extends Model_Event
{
    /**
     * Get All Events by type
     * @param $type - event type
     * @param int $offset - offset events
     * @param int $limit  - array size
     * @return array [Model_Stage]
     */
    public static function getAllByType($type, $offset = 0, $limit = 10)
    {
        $select = Dao_Events::select()
            ->where('type', '=', $type)
            ->offset($offset)
            ->limit($limit)
            ->order_by('id','DESC')
            ->execute();

        $events = array();

        if ($select) {
            foreach ($select as $selection) {
                $event = new Model_Event();

                foreach ($selection as $fieldname => $value) {
                    if (property_exists($event, $fieldname)) $event->$fieldname = $value;
                }

                array_push($events, $event);
            }
        }

        return $events;

    }

}
