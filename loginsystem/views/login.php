<?php
/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 9:49 AM
 */

require_once('../core/init.php');

//print_r($_REQUEST);

//Check for token and form post
if(Input::exists() && Token::check(Input::get('token'))) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'username' => array('required' => true),
        'password' => array('required' => true)

    ));

    if($validation->passed()){

        $user = new User();
        $login = $user->login(Input::get('username'), Input::get(('password')));

        if($login){
           Redirect::to('index.php');
        }

    }else{
        foreach($validation->errors() as $error){
            echo $error."<br>";
        }
    }


}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login System</title>
  </head>
  <body>
    <h4>Login System</h4>


    <form method="post" action="">
		<div>
			<div>
                <label for="username">Username</label>
				<input type="text" name="username" autocomplete="off">
			</div>
			<div>
                <label for="username">Password</label>
				<input type="password" name="password" autocomplete="off">
			</div>
			<div>
				<input type="submit" value="Login">
			</div>
	  	</div>
        <input type="hidden" name="token" value="<?=Token::generate()?>">
    </form>

  </body>
</html>