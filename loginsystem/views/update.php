<?php
/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 9:50 AM
 * Update User Info
 */
require_once('../core/init.php');

//print_r($_REQUEST);

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

//Check for token and form post
if(Input::exists() && Token::check(Input::get('token'))) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'fname' => array(
            'required' => true,
            'min' => 2,
            'max' => 45,
        ),
        'lname' => array(
            'required' => true,
            'min' => 2,
            'max' => 45,
        )

    ));

    if($validation->passed()){

        $user = new User();



        $remember = (Input::get('remember')==='on') ? true : false;
        $login = $user->login(Input::get('username'), Input::get(('password')), $remember);

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

<form action="" method="post">

    <div class="field">
        <label for="name">Name</label>
        <input type="text" name="fname" value="<?=escape($user->data()->fname);?>">
        <input type="text" name="lname" value="<?=escape($user->data()->lname);?>">

        <input type="submit" value="Update">
        <input type="hidden" name="token" value="<?=Token::generate()?>">
    </div>
</form>