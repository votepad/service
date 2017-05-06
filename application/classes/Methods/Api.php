<?php

Class Methods_Api extends Model
{
    public function getAllEvents($params)
    {
        $sort = Arr::get($params, 'sort', '');
        $sorting_field = Arr::get($params, 'sorting_field');
        $sorting_type = Arr::get($params, 'sorting_type');
        $count = Arr::get($params, 'count');

        $selection = Dao_Events::select();

        if ($sort) {
            $selection = $selection->order_by($sorting_field ?: 'id', $sorting_type ?: 'ASC');
        }

        if ($count) {
            $selection = $selection->limit($count);
        }

        $selection = $selection->execute();
        return $selection;
    }
}