<?php

Class Methods_Api extends Model
{
    public static function getAllEvents()
    {
        $selection = Dao_Events::select()
            ->execute();

        return $selection;
    }
}