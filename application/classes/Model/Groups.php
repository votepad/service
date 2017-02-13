<?php

class Model_Groups extends Model {

    const GROUP_TYPE_PARTICIPANTS = 'participants';
    const GROUP_TYPE_TEAMS = 'teams';

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

    /**
     * @var $mode - group mode
     */
    public $mode;

    /**
     * @param null $id
     * @return $this
     * @throws Kohana_Exception
     */
    public function save($id = null)
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

        $group->name = $this->name ?: $group->name;
        $group->description = $this->description ?: $group->description;
        $group->id_event = $this->id_event;
        $group->mode = $this->mode;

        $group->save();

        $this->id = $group->id;

        return $this;
    }

    /**
     * @param $id
     * @return Model_Groups
     * @throws Kohana_Exception
     */
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

        return $result;
    }

}