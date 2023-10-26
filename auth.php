
<?php

include "bootstrap/init.php";
// dd($_SERVER['REQUEST_METHOD']);
// $pass = "7learnpass";
// PASSWORD_hash("passstring" ,PASSWORD_BCRYPT);

$home_url = site_url();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
 $action = $_GET['action'];
    // dd($action);
  $params = $_POST;
  
   if($action == 'register'){

    $result = register($params);
    
    if(!$result){
      message("errore:an error in registration");
    }else{
      message("registration is successfullM <br>
      <a href='{$home_url}auth.php'>please login</a>",'success');
   }
  }else if($action =='login'){
     $result = login($params['email'] , $params['pass']);
    // dd($result);

    if(!$result){
    message("error:email or pass Incorect");
  }else{
  //   message("you are now logged in . <br>
    
  //     <a href='{$home_url}'>manage your task</a>",'success');
  redirect(site_url());
   }
  }
 }
include "tpl/tpl-auth.php";