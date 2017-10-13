<?php defined('SYSPATH') or die('No direct script access.');

class Model_Event extends Model
{

    /** Min and Max random value as event code */
    const MIN_RAND_VALUE = 100000;
    const MAX_RAND_VALUE = 999999;
    const EVENTCODE_KEY  = 'event.codes';


    public $id;
    public $type;           // 0 - draft, 1 - published
    public $creator;        // $creator->id
    public $name;
    public $description;
    public $uri;            // UNIQUE
    public $code = null;    // $eventCode - code for judges
    public $branding = "no-cover.png"; // [Text] - path to cover
    public $tags = "";      // [String] - with delimiter `,`
    public $address;        // [Text]
    public $dt_start;       // [datetime] - Beggining time
    public $dt_end;         // [datetime] - The time of finish
    public $dt_create;      // [datetime]

    public function __construct($id = null) {

        if ( !empty($id) ) {
            $this->get_($id);
        }

    }

    private function fill_by_row($db_selection) {

        if (empty($db_selection['id'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }


        return $this;

    }

    private function get_($id) {

        $select = Dao_Events::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        return $this->fill_by_row($select);

    }

    /**
     * Save Event to Database
     */
    public function save()
    {

        $this->dt_create = Date::formatted_time('now', 'Y-m-d');

        $insert = Dao_Events::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert->execute();

        return $this->get_($result);

    }

    /**
     * Update Event
     * @return Model_Event
     */
    public function update()
    {

        $insert = Dao_Events::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $insert->where('id', '=', $this->id);

        $insert->execute();

        return $this->get_($this->id);

    }



    public function addAssistant($id) {

        Dao_UsersEvents::insert()
            ->set('u_id', $id)
            ->set('e_id', $this->id)
            ->clearcache('EventUsers_' . $this->id)
            ->clearcache('UserEvents_' . $id)
            ->execute();

    }

    public function getAssistants() {

        $selection = Dao_UsersEvents::select('u_id')
            ->where('e_id', '=', $this->id)
            ->cached(Date::MINUTE * 5, 'EventUsers_' . $this->id)
            ->execute('u_id');

        $users = array();
        foreach ($selection as $id => $value) {

            array_push($users, new Model_User($id));

        }

        return $users;

    }

    public function removeAssistant($id) {

        Dao_UsersEvents::delete()
            ->where('u_id', '=', $id)
            ->where('e_id', '=', $this->id)
            ->clearcache('EventUsers_' . $this->id)
            ->clearcache('UserEvents_' . $id)
            ->execute();

    }

    public function isAssistant($id) {

        return (bool) Dao_UsersEvents::select('u_id')
            ->where('u_id', '=', $id)
            ->where('e_id', '=', $this->id)
            ->clearcache('EventUsers_' . $this->id)
            ->clearcache('UserEvents_' . $id)
            ->limit(1)
            ->execute();

    }


    public function getInviteLink() {

        $hash = hash('sha256', $this->organization . getenv('SALT') . $this->id);
        return '/event/' . $this->id . '/invite/' . $hash;

    }

    public function isCreator($id) {
        return $id == $this->creator;
    }

    /**
     * Get Element By Field Name - for simple request
     * @param $field
     * @param $value
     * @return Dao_Events
     */
    public static function getByFieldName($field, $value)
    {

        $event = Dao_Events::select()
            ->where($field, '=', $value)
            ->limit(1)
            ->execute();

        return $event;

    }

    public function generateCodeForJudges($id_event) {

        $redis = Dispatch::redisInstance();
        $generatedCode = mt_rand(self::MIN_RAND_VALUE, self::MAX_RAND_VALUE);

        /** try until we find */
        while ( $redis->hExists(self::EVENTCODE_KEY, $generatedCode) ) {
            $generatedCode = mt_rand(self::MIN_RAND_VALUE, self::MAX_RAND_VALUE);
        }

        $redis->hset(self::EVENTCODE_KEY, $generatedCode, $id_event);

        return $generatedCode;

    }

    public static function getEventByCode($code) {

        $redis = Dispatch::redisInstance();
        return $redis->hget(self::EVENTCODE_KEY, $code);

    }

}
