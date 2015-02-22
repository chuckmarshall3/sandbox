<?php
/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 9:50 AM
 * Config File
 */

class Config{

    public static function get($path = null){ //Get DB Connection Local Host

        if($path){

            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach($path as $bit){

                if(isset($config[$bit])){
                    $config = $config[$bit];

                }
            }
            return $config; //Returns Local Host
        }

        return false;


    }
}

