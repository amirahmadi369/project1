<?php
include "bootstrap/init.php";
// use Hekmatinasser\Verta\Verta;
if(isset($_GET['logout'])){
    logout();
}
if(!isloggedin()){

    redirect(site_url('auth.php'));
}

$user = getloginuser();

if(isset($_GET['delete_folder'])  && is_numeric($_GET['delete_folder'])){
    $deletedcoument = deletefolder($_GET['delete_folder']);
    echo "$deletedcoument folders succesfully delete";

}
if(isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])){
    $deletedcoument = deletetask($_GET['delete_task']);
    echo "$deletedcoument tasks succesfully delete";
}
// var_dump(verta::now());
$folders = getfolder();

    # code...
$tasks = gettasks();
// dd($tasks);

 include "tpl/tpl-index.php";


//  <?php
// include "bootstrap/init.php";
// // use Hekmatinasser\Verta\Verta;
// if(!isloggedin()){
//     header("location:". site_url('auth.php'));
 
// }
// $user= getlogedinuser();

// if(isset($_GET['delete_folder'])  && is_numeric($_GET['delete_folder'])){
//     $deletedcoument = deletefolder($_GET['delete_folder']);
//     echo "$deletedcoument folders succesfully delete";

// }
// if(isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])){
//     $deletedcoument = deletetask($_GET['delete_task']);
//     echo "$deletedcoument tasks succesfully delete";
// }
// // var_dump(verta::now());
// $folders = getfolder();

//     # code...
// $tasks = gettasks();
// // dd($tasks);

//  include "tpl/tpl-index.php";