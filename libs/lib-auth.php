<?php
defined('BASE_PATH') or die("permision denied");

function getcurentuserid(){
    return getloginuser()->id;
}

function isloggedin(){
   
    return isset($_SESSION['login']) ? true : false;
   
}
function getloginuser(){

  return $_SESSION['login'] ??  null ;
}


function getuseremail($email){
    
    global $pdo;
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $records = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $records[0] ?? null;
}

function logout(){
    unset($_SESSION['login']);
}
function login($email,$pass){
    $user =  getuseremail($email);
        if(is_null($user)){
            return false;
        }
       if(password_verify($pass,$user->pass)){
    // $user->image="https://www.gravatar.com/avatar/".md5(strtolower(trim($user->$email)));
    
    $user->image = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($user->email)));

        $_SESSION['login'] = $user;
        return true;
       
}
    return false;
}

 function register($userdata){
    global $pdo;
    // $pass = $userdata['pass'];
    $passhash = password_hash($userdata['pass'],PASSWORD_BCRYPT);
    $sql =  "INSERT INTO   users (name,email,pass) VALUES (:name,:email,:pass);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name'=>$userdata['name'],':email'=>$userdata['email'],':pass'=>$passhash]);
    // if($stmt->rowCount()){
    //     return true;
    // }else{
    //     return false;
    // }
    return $stmt->rowCount() ? true : false;
   
 }
 