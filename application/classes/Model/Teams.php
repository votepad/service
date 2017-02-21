<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_Participants
 * CRUD
 */

class Model_Teams extends Model 
{

    public $id;

    /**
     * @var $name - Team name
     */
    public $name;

    /**
     * @var $description - about team
     */
    public $description;

    /**
     * @var $logo
     */
    public $logo;

    /**
     * @var $id_event
     */
    public $id_event;

    /**
     * @var $participants [Array]
     */
    public $participants;

    /**
     * Model_Participants constructor.
     */
    public function __construct() { }

    /**
     * @param null $id
     * @return mixed
     * @throws Kohana_Exception
     */
    public function save($id = null)
    {
        $team = new ORM_Teams();

        if (isset($id)) {
            $team->where('id', '=' , $id)
                    ->find();
        }

        $team->name         = $this->name;
        $team->description  = $this->description;
        $team->logo         = $this->logo ?: null;
        $team->id_event     = $this->id_event;
        $team->save();

        return $team->id;
    }

    /**
     * @param $id
     * @return bool
     * @throws Kohana_Exception
     */
    protected static function get($id) 
    {

        $team = new ORM_Teams();

        if (!isset($id))
            return false;

        $team->where('id', '=', $id)
            ->find();

        if ($team->loaded())
        {
            $result = new Model_Teams();

            $result->id         = $team->id;
            $result->name       = $team->name;
            $result->description  = $team->description;
            $result->logo       = $team->logo;
            $result->id_event   = $team->id_event;
            $result->participants = Methods_Participants::getParticipantsFromTeams($team->id);

            return $result;

        } else {
            return null;
        }
    }

    /**
     * @param $id
     * @return bool
     * @throws Kohana_Exception
     */
    protected static function delete($id) 
    {

        $team = new ORM_Teams();

        if (!isset($id))
            return false;

        $team->where('id', '=', $id)
            ->find();

        if ($team->loaded()){

            try {

                $team->delete();
                return true;

            } catch (Exception $e) {

                return false;

            }
        }
    }

}