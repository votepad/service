<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Murod's Macbook Pro
 * Date: 01.03.2016
 * Time: 21:22
 */

Class Model_User {

    private static $_instance;

    public $id;
    public $lastname;
    public $name;
    public $surname;
    public $email;
    public $avatar;
    public $role;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function Instance() {
        if (self::$_instance == null)
            self::$_instance = new self();

        return self::$_instance;
    }

    public function login($email, $password, $remember = false)
    {
        $select = DB::select('*')->from('Users')
                ->where('email', '=', $email)
                ->and_where('password', '=', $password)
                ->limit(1)
                ->execute()->as_array();

        if (count($select) != 0) {
            $data = Arr::get($select, '0');
            $this->setModelVars($data);

            Session::Instance()->set('user_id', $this->id);

            $data = Arr::get($select, '0');
            if ( !$data['done'])
                return 2;
            else
                return 1;
        }
        else
        {
            return 0;
        }
    }

    public function logout()
    {
        Session::Instance()->destroy();
    }

    public function signUp($email, $password, $remember = true)
    {
        $insert = DB::insert('Users', array(
            'email', 'password'
        ))->values(array(
            $email, $password
        ))->execute();

        $select = DB::select('*')->from('Users')->where('email', '=', $email)->execute()->as_array();
        $data = Arr::get($select, '0');

        $this->id = $data['id'];

        /**
         * Set Cookie if remember is TRUE
         */

        /*Cookie::set('user_id', $this->id, 3600);
        Cookie::set('email', $this->email, 3600);
        Cookie::set('password', $this->password, 3600);*/

        Session::Instance()->set('user_id', $this->id);

    }

    private function setModelVars($data)
    {
        $this->id       = $data['id'];
        $this->email    = $data['email'];
        $this->lastname = $data['lastname'];
        $this->name     = $data['name'];
        $this->surname  = $data['surname'];
        $this->avatar   = $data['avatar'];
        $this->role     = $data['role'];
    }

    function signUpContinue($lastname, $name, $surname, $sex, $number, $city, $avatar)
    {
        $update = DB::update('Users')->set(array(
            'lastname'  => $lastname,
            'name'      => $name,
            'surname'   => $surname,
            'number'    => $number,
            'sex'       => $sex,
            'city'      => $city,
            'avatar'    => $avatar,
            'done'      => 1,
        ))->where('id', '=', Session::Instance()->get('user_id'))->execute();

        return $update;
    }

    public function getCities()
    {
        $select = DB::select()->from('Cities')->execute()->as_array();
        return $select;
    }

    public function getUserInfo()
    {
        $session    = Session::Instance();
        $select     = DB::select('*')->from('Users')
                                     ->where('id', '=', $session->get('user_id'))->limit(1)->execute()->as_array();

        return Arr::get($select, '0');
    }

    public static function updateUserByFieldName($field, $value, $id)
    {
        $update = DB::update('Users')->set(array(
                $field => $value
            ))->where('id', '=', $id)->execute();

        return $update;
    }
}