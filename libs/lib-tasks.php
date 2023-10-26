<?php
 defined('BASE_PATH') or die("permision denied");


function GetCurrentUserId(){
    return 1;
}

function deletefolder($folder_id){
global $pdo;
$sql = "delete  from folders where id = $folder_id";
// var_dump('$sql');
$stmt = $pdo->prepare($sql);

$stmt->execute();
return $stmt->rowCount();

}
function deletetask($task_id){
    global $pdo;
    $sql = "delete  from tasks where id= $task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}
// function addtask($tasktitle,$folderid){
//     global $pdo;
//     $currentUserId = GetCurrentUserId();
//     $sql = "INSERT INTO 'tasks' (title,user_id,folder_id) VALUES(:title,:user_id,:folder_id);";
    
//     $stmt = $pdo->prepare($sql);
    
//     $stmt->execute([':title'=>$tasktitle,':user_id'=>$currentUserId,':folder_id'=>$folderid] );
//     return $stmt->rowCount();


// }
function addtask($tasktitle, $folderid) {
    global $pdo;
    $currentUserId = GetCurrentUserId();
    $sql = "INSERT INTO tasks (title, user_id, folder_id) VALUES (:title, :user_id, :folder_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $tasktitle,
        ':user_id' => $currentUserId,
        ':folder_id' => $folderid
    ]);
    return $stmt->rowCount();
}

// function deletefolder($folder_id) {
//     global $pdo;
//     $sql = "DELETE FROM folders WHERE id = :folder_id";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':folder_id', $folder_id, PDO::PARAM_INT);
//     $stmt->execute();
//     return $stmt->rowCount();
// }


function addFolder($folder_name){
    
   
    
        global $pdo;
        $currentUserId = GetCurrentUserId();
        $sql = "INSERT INTO folders (name,user_id) VALUES(:folder_name,:user_id);";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([':folder_name'=>$folder_name,':user_id'=>$currentUserId] );
        return $stmt->rowCount();


    }

    function doneswitch($task_id){
        global $pdo;
        $currentUserId = GetCurrentUserId();
        $sql = "UPDATE 'tasks'
        set is_done   = 1 - is_done
        WHERE user_id = :userid and id = :taskid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':taskid'=>$task_id, ':userid'=>$currentUserId]);
        return $stmt->rowCount();

    }




function getfolder(){
    global $pdo;
    $currentUserId = GetCurrentUserId();
    $sql = "select * from folders where user_id = $currentUserId";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records; 

}
function gettasks(){
    global $pdo;
    $folder = $_GET['folder_id'] ?? null;
    $foldercondition = '';
    if(isset($folder) and is_numeric($folder)){
        $foldercondition = "and folder_id=$folder";
    }

$currentUserId = GetCurrentUserId();
$sql = "select * from tasks where user_id = $currentUserId  $foldercondition";
$stmt = $pdo->prepare($sql);
$stmt -> execute();
$records = $stmt->fetchAll(PDO::FETCH_OBJ);
return $records;
}
