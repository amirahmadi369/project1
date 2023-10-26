<?php
 function getconfig($user,$pass){
    return 1;
 }
  function getcorrenturl(){
    return 1;
  }
  function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
      return true;
    }
    return false;
  }
  function power($b,$p){
    return $b**$p;
  }
  function site_url($uri = ''){
return BASE_URL . $uri;
  }
    function redirect($url){
      header("location:$url");
      die();
    }
  function diepage($msg){
    echo "<div style='
      color: black;
      padding: 30px;
      width: 80%;
      margin: auto;
      background: azure;
      border: 1px solid;
      border-radius: 5px;'
  >$msg</div>";
die();
  }
  function message($msg ,$cssclass='info'){
    
    echo "<div class='$cssclass' style='
      color: black;
      padding: 20px;
      width: 80%;
      margin: auto;
      background: green;
      border: 1px solid;
      border-radius: 5px;'
  >$msg</div>";

    

  }

  function dd($var){
    echo "<pre 
    style ='
        color: red;
        background: aqua;
        padding: 10px;
        border-radius: 5px;'
    >";
    var_dump($var);
    echo "</pre>";
  }
  