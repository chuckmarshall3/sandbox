<?php
/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 9:49 AM
 * Logout View
 */


require_once('../core/init.php');

$user = new User();
$user->logout();

Redirect::to('index.php');