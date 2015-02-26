<?php

/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 9:58 AM
 * Main initialization file that will deal with starting sessions,
 * defining our configuration and auto loading the classes.
 * This page should be included across all pages
 */

session_start();

//Declare Global Structure for User Cookie, Session and DB Connection
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1; port=8889;',  //Only add port if needed
        'username' =>'root',
        'password' => 'root',
        'db' => 'login_system'

    ),
    'remember' => array(

        'cookie_name' => 'hash',
        'cookie_expiry' => 6040800  //Seconds
    ),
    'session' =>array(
        'session_name' => 'user',
        'token_name' => 'token'

    )

);

//Autoload required Class File
spl_autoload_register( function($class){

    require_once '../models/'.$class.'.php';
});

//Includes Sanitize Function
require_once('../functions/sanitize.php');

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){

    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if($hashCheck->count()){
        $user = new User($hashCheck->firstrow()->user_id);
        $user->login();
    }

}