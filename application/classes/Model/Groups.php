<?php

class Model_Groups extends Model {

    const GROUP_TYPE_PARTICIPANTS = 1;
    const GROUP_TYPE_TEAMS = 2;

    /**
     * @var $id - group identity
     */
    public $id;

    /**
     * @var $id_event - event identity
     */
    public $id_event;

    /**
     * @var $name - group name
     */
    public $name;

    /**
     * @var $description - description
     */
    public $description;

    /**
     * @var $participants - group of participants
     */
    public $participants;

    /**
     * @var $teams - group of teams
     */
    public $teams;

    public function save($id)
    {
        $group = new ORM_Groups();

        if (isset($id)) {
            $group->where('id', '=', $id)
                ->find();
        }

        if ($group->loaded()) {

            $group->name = $this->name;
            $group->description = $this->description;

        }
    }

    public function get($id)
    {
        $group = new ORM_Groups();

        if (isset($id)) {
            $group->where('id', '=' , $id)
                ->find();
        }

        if ($group->loaded()) {

            $result = new Model_Groups();

            $result->id             = $group->id;
            $result->id_event       = $group->id_event;
            $result->name           = $group->name;
            $result->description    = $group->description;

        }
    }

}