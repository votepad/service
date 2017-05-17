<?php

class Methods_Results extends  Model_Result
{

    public static function getByEvent($event) {

        $selection = Dao_Results::select()
            ->where('event', '=', $event)
            ->limit(1)
            ->execute();


        $result = new Model_Result();

        if (empty($selection['id'])) {
            return $result;
        }

        foreach ($selection as $fieldname => $value) {
            if (property_exists($result, $fieldname)) $result->$fieldname = $value;
        }

        $formula = '[';

        foreach (json_decode($result->formula) as $contestID => $coeff) :

            $contest = new Model_Contest($contestID);

            if ($contest->id) :
                $formula .= '{"id":"' . $contestID  . '","name":"' . $contest->name . '","coeff":"' . $coeff . '"},';
            endif;

        endforeach;
        $result->formula = substr($formula, 0, -1);

        if (strlen($result->formula) != 0)
            $result->formula .= ']';

        return $result;

    }

}