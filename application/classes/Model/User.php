<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_User
 * @author ProNWE team
 * @copyright Khaydarov Murod
 * Methods
 *  - isAdmin
 *  - isJudge
 *  - isGuest
 */

Class Model_User {

    const ADMIN = 1;
    const JUDGE = 2;
    const GUEST = 3;

    public static function isAdmin() {

        if (Session::Instance()->get('role') == self::ADMIN)
            return true;
        return false;

    }

    public static function isJudge() {

        if (Session::Instance()->get('role') == self::JUDGE)
            return true;
        return false;

    }

    public static function isGuest() {

        if (Session::Instance()->get('role') == self::GUEST)
            return true;
        return false;

    }

    public static function getCurrentUser() {

        $session = Session::Instance();

        $user = new ORM_User();
        $user->where('id', '=', $session->get('id_user'))
            ->find();

        if ($user->loaded())
        {
            return $user;
        }

        return false;
    }
}