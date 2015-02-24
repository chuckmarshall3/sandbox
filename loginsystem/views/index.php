<?php

/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 10:15 AM
 * Main Index page
 */
echo "Index.php";
//Require Init on all pages
require_once('../core/init.php');

if(Session::exists('success')){
    echo Session::flash('success');
}

echo Session::get(Config::get('session/session_name'));

/*************************************************************/
//echo Config::get('mysql/host');  //Get local host string 127.0.0.1


//$users = DB::getInstance()->query('SELECT username FROM users');
//
//if($users->count()){
//    foreach($users as $user){
//        echo $user->username;
//    }
//}


/*************************************************************/
//Used this to retrieve data using  a full sql query
//$user = DB::getInstance()->query("SELECT username FROM users WHERE username=?", array('alex'));
//$user = DB::getInstance()->query("SELECT username FROM users");
/*
    if(!$user->count()){
        echo 'No User';

    }else{
        foreach($user->results() as $user){
            echo $user->username, '<br>';
        }
    }
*/


/*************************************************************/
//Use this to retrieve data using simpler get and action method
//$user = DB::getInstance()->get('users', array('username', '=', 'alex'));

/*
    if(!$user->count()){
        echo 'No User';

    }else{

       echo $user->firstrow()->username; //Outputs first row only

    }
*/


/*************************************************************/
//Use this to insert data into DB
/*
$user = DB::getInstance()->insert('users', array(
        'username' => 'Dale',
        'password' => 'password',
        'salt' => 'salt'
    ));
*/

/*************************************************************/
//Use this to update data into DB
/*
$user = DB::getInstance()->update('users', 3, array(
    'username' => 'Dale Barrett',
    'password' => 'newpassword',
    'salt' => 'salts'
));
*/