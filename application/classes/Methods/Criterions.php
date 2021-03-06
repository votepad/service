<?php

class Methods_Criterions extends Model_Criterion
{
    /**
     * Get All Criterions by event_id
     * @param $id_event
     * @return array [Model_Criterion]
     */
    public static function getAllByEvent($id_event)
    {
        $select = Dao_Criterions::select()
            ->where('event', '=', $id_event)
            ->cached(Date::HOUR, 'event:' . $id_event)
            ->order_by('id', 'ASC')
            ->execute();

        $criterions = array();

        if ($select) {
            foreach($select as $db_selection) {
                $criterion = new Model_Criterion();
                $criterion->id          = $db_selection['id'];
                $criterion->event       = $db_selection['event'];
                $criterion->name        = $db_selection['name'];
                $criterion->description = $db_selection['description'];
                $criterion->minScore    = $db_selection['minScore'];
                $criterion->maxScore    = $db_selection['maxScore'];
                array_push($criterions, $criterion);
            };
        }

        return $criterions;
    }


    /**
     * Get Criterions For Formula
     * @param $event - event ID
     * @return string [JSON]
     */
    public static function getJSON($event)
    {
        $criterions = self::getAllByEvent($event);
        $result = array();

        foreach ($criterions as $criterion) {
            $result[] = array(
                'id'   => $criterion->id,
                'name' => $criterion->name
            );
        }

        return json_encode($result);
    }


    /**
     * Get JSON by formula
     * @param $formula - [{'id':'coeff'}]
     * @return string [JSON]
     */
    public static function getJSONbyFormula($formula)
    {
        $result = array();

        foreach (json_decode($formula) as $criterionID => $coeff) {

            $criterion = new Model_Criterion($criterionID);

            if ($criterion->id) {

                $result[] = array(
                    "id" => $criterionID,
                    "name" => $criterion->name,
                    "coeff" => $coeff
                );

            }

        }

        return json_encode($result);
    }


    /**
     * Get Criterions by formula
     * @param $formula - [{'id':'coeff'}]
     * @return array [Model_Criterions]
     */
    public static function getCriterions($formula)
    {
        $formula = json_decode($formula);

        $criterions = array();

        foreach ($formula as $id => $coef) {
            array_push($criterions, new Model_Criterion($id));
        }

        return $criterions;

    }
}