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

    /** @deprecated  */
    public static function updateUserByFieldName($field, $value, $id)
    {
        $update = DB::update('Users')->set(array(
                $field => $value
            ))->where('id', '=', $id)->execute();

        return $update;
    }
}