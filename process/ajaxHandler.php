<?php
include_once "../bootstrap/init.php";

if(!isAjaxRequest()){
    diePage("Invalid Request!");

}
if(!isset($_POST['action']) || empty($_POST['action'])){
    diePage("invalid Action");

}
switch($_POST['action']){
    case "doneswitch":  
    $task_id = $_POST['taskid'];
    if(!isset($task_id) || !is_numeric($task_id)){
        echo "invalide task id";
        die();
    }
     echo doneswitch($task_id);
    break;

    case "addfolder":
        if(!isset($_POST['foldername']) || strlen($_POST['foldername'])<3){
            echo"the folder name must be more than 2 character";
            die();
        }

        // echo addfolders($folder_name)
         echo addFolder($_POST['foldername']);
        // $folder = addFolders($_POST['foldername']);
// echo !empty($folder);

break;
case "addtask":
 
    $folderid = $_POST['folderid'];
    $tasktitle = $_POST['tasktitle'];

    if(!isset($folderid) || empty($folderid)){
        echo ("select folder");
        die();

    // var_dump("new task added : " ,$_POST);
    //     break;
    //     default:
    //     diePage("Inavlid Action!");
}

if(isset($taskstitle) || strlen($tasktitle) < 3){
    echo "task title must  more than 2 chachter";
     die();
    
}

        echo addtask($tasktitle,$folderid);
        break;


}