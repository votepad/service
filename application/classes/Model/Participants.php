<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_Participants
 * CRUD
 */
class Model_Participants extends Model {

    public $id;
    public $name;
    public $about;
    public $photo;
    public $email;

    /**
     * Model_Participants constructor.
     */
    public function __construct() { }

    public function save($id = null)
    {
        $participant = new ORM_Participants();

        if (isset($id)) {
            $participant->where('id', '=' , $id)
                    ->find();
        }

        $participant->name  = $this->name;
        $participant->about = $this->about;
        $participant->photo = $this->photo ?: null;
        $participant->email = $this->email;
        $participant->save();
        
        return $participant->id;
    }

    /**
     * @param $id
     * @return bool
     * @throws Kohana_Exception
     */
    protected static function get($id) {

        $participant = new ORM_Participants();

        if (!isset($id))
            return false;

        $participant->where('id', '=', $id)
            ->find();

        if ($participant->loaded())
        {
            $result = new Model_Participants();

            $result->id     = $participant->id;
            $result->name   = $participant->name;
            $result->about  = $participant->about;
            $result->photo  = $participant->photo;
            $result->email  = $participant->email;

            return $result;
        }
    }

}