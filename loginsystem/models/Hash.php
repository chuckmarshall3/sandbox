<?php
/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 9:52 AM
 * Used to Generate Hash
 */


class Hash{

    public static function make($string, $salt = ''){

        return hash('sha256', $string, $salt);
    }

    public static function salt($length){

        return mcrypt_create_iv($length);
    }

    public static function unique(){
        return self::make(uniqid());

    }
}