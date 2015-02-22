<?php
/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 9:59 AM
 * Sanitizes Inputs
 */

function escape($string){

    //Sanitize the inputs (string, Escapes Quotes, character language)
    return htmlentities($string, ENT_QUOTES, 'UTF-8');

}