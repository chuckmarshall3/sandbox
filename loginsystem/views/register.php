<?php
/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 1:00 PM
 * Used to register a user
 */

require_once('../core/init.php');

//Check for token and form post
if(Input::exists() && Token::check(Input::get('token'))){

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'username' => array(
            'required' => true,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'password' => array(
            'required' => true,
            'min' => 8,

        ),
        'password_again' => array(
            'required' => true,
            'matches' => 'password',
        ),
        'fname' => array(
            'required' => true,
            'min' => 2,
            'max' => 45,
        ),
        'lname' => array(
            'required' => true,
            'min' => 2,
            'max' => 45,
        ),


    ));

    if($validation->passed()){

        $user = new User();
        $salt = Hash::salt(32);

        try{
            $user->create(array(
                'username' =>Input::get('username'),
                'password' =>Hash::make(Input::get('password'), $salt),
                'salt' => $salt,
                'fname' => Input::get('fname'),
                'lname' =>Input::get('lname'),
                'createddate' =>date('Y-m-d H:i:s'),
                'group' =>1,
            ));

            Session::flash('success', 'Registration Successfully!');
            Redirect::to('index.php');
        }catch(Exception $e){
            die($e->getMessage);
        }


    }else{
        foreach($validation->errors() as $error){
            echo $error."<br>";
        }
    }

}

?>


<form action="" method="post">

    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?=escape(Input::get('username'))?>" autocomplete="off">
    </div>

    <div class="field">
        <label for="password">Enter New Password</label>
        <input type="password" name="password" id="password" value="" autocomplete="off">
    </div>

    <div class="field">
        <label for="password_again">Re-Type Password</label>
        <input type="password" name="password_again" id="password_again" value="" autocomplete="off">
    </div>

    <div class="field">
        <label for="firstname">First Name</label>
        <input type="text" name="fname" id="fname" value="<?=escape(Input::get('fname'))?>" autocomplete="off">
    </div>

    <div class="field">
        <label for="lastname">Last Name</label>
        <input type="text" name="lname" id="lname" value="<?=escape(Input::get('lname'))?>" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?=Token::generate()?>">
    <input type="submit" value="Register">
</form>