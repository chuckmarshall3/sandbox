<?php

/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 10:15 AM
 * Main Index page
 */
echo "Index.php<br>";
//Require Init on all pages
require_once('../core/init.php');

if(Session::exists('success')){
    echo Session::flash('success');
}

$user = new User();


if($user->isLoggedIn()){
    echo $user->data()->username.' is logged in';


?>

<p> Welcome <a href="#"><?=$user->data()->username?></a>! </p>

    <ul>
        <li><a href="logout.php">Log Out</a> </li>
        <li><a href="update.php">Update Profile</a> </li>
    </ul>


<?
}else{?>

    <p>You need to <a href="login.php">Log in</a> or <a href="register.php">Register</a></p>

<?}

