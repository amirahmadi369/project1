

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?php echo" SITE_TITLE" ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel">
    <a href="<?= site_url("?logout=1") ?>"> <i class="fa fa-sign-out"></i></a>
    <span class="username"><?= $user->name ?? ' unknown' ; ?> </span>
    <img src="<?= $user->image; ?>" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Folders</div>
        <ul class="folder-list">
        <li class="<?=isset ($_GET['folder_id'] ) ? '' : 'ACTIVE' ?> ">
        <a href="<?= site_url() ?>"><i class="fa fa-folder"></i>all </a></li>
          <?php  foreach ($folders as $folder): ?>
            <li class="<?=(isset ($_GET['folder_id'] )&& $_GET['folder_id'] == $folder->id) ?'active' : '' ?> ">
      
              
              <a href="?folder_id=<?= $folder->id ?>"><i class="fa fa-folder"></i>
              <?= $folder->name ?></a> 
              <a href="?delete_folder=<?= $folder->id  ?>"class="remove"  onclick=
              "return confirm('are you sure?'+'<?= $folder->name ?>');">X</a> 
            </li>
            <?php  endforeach; ?>
        
        
        </ul>
      </div>
      <div>
          <input type="text" id="addfolderinput" style="width: 78%;margin-left: 4px" placeholder="add new folder"/>
          <button id="addfolderbtn" class="btn clickable" style="cursor: pointer ; opacity: 0.7">+</button>
        </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title">
        <input type="text" id="taskNameinput" style="width: 100%;margin-left: 4px; line-height:30px;  " placeholder="add New task"/>
       

        </div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
            <?php if(sizeof($tasks)):?>
            <?php foreach($tasks as  $task): ?>
            <li class="<?=  $task->is_done ? 'checked' : ''; ?>" >
            <i data-taskid="<?= $task->id ?>" class="isdone clickable fa <?= $task->is_done ? 'fa-check-square-o' : 'fa-square-o' ; ?>"></i> 
               <span><?= $task->title ?></span>
                 <div class="info">
              <span style="  font-size:11px;margin-right: 25px  ">created at <?= $task->created_at ?> </span>
              <a href="?delete_task=<?= $task->id ?>"   style="  font-size:17px;margin-right: 10px;" onclick="return confirm('Are you sure to delete this file?\n<?= $task->title ?>');">X</a>
              </div>
            </li>

            <?php endforeach; ?>
            <?php else: ?>
              <li>no task here...</li>
              <?php endif ?>
            <!-- <li><i class="fa fa-square-o"></i><span>Design a new logo</span>
              <div class="info">
               <span>Created at <?= $task->created_at ?></span>
              </div>
            </li>
            <li><i class="fa fa-square-o"></i><span>Find a front end developer</span>
              <div class="info"></div>
            </li> -->
          </ul>
        </div>
        <!-- <div class="list">
          <div class="title">Tomorrow</div>
          <ul>
            <li><i class="fa fa-square-o"></i><span>Find front end developer</span>
              <div class="info"></div>
            </li>
          </ul>
        </div> -->
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="assets/js/script.js"></script>
  <script>

 $(document).ready(function(){

  $('.isdone').click(function(e){
    var tid = $(this).attr('data-taskid');

    $.ajax({
      url : "process/ajaxHandler.php",
      method : "post",
      data : {action:"doneswitch",taskid:tid},
      success : function(response){
        // alert(response)
    
          location.reload();
          // $('<li><a href="#">'+input.val()+'</a></li>').appendTo('ul.folder-list');

        }
      

    });

  
  });

  $('#addfolderbtn').click(function(e){
    
    var input = $('input#addfolderinput');
    $.ajax({
      url : "process/ajaxHandler.php",
      method : "post",
      data : {action:"addfolder" ,foldername:input.val()},
      success : function(response){
        if(response == '1'){
          $('<li><a href="#">'+input.val()+'</a></li>').appendTo('ul.folder-list');

        }else{
          alert(response);
        }
      }

    });


  });

 
 $('#taskNameinput').on('keypress' , function(e){
  if(e.which == 13){
    
    $.ajax({
      url : "process/ajaxHandler.php",
      method : "post",
      data : {action:"addtask",folderid:<?= $_GET['folder_id'] ?? 0 ?> ,tasktitle: $('#taskNameinput').val()},
      success : function(response){
        // alert(response)
        if(response == '1'){
          location.reload();
          // $('<li><a href="#">'+input.val()+'</a></li>').appendTo('ul.folder-list');

        }else{
          alert(response);
        }
      }

    });

  }
  });
 $('#taskNameinput').focus();
  });

  </script>

  

</body>
</html>
