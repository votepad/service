<?php
/**
 * Created by PhpStorm.
 * Date: 27.01.17
 * Time: 15:02
 */


class Methods_Common {

    /**
     * Need to get id
     *
     * @param $object - SQL returned object
     * @returns identity
     */
    public static function getObjectIdentities($object) {

        return $object->id ?: null;

    }

}