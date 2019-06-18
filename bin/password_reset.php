<?php
session_start();
if(file_exists("../lib/library.class.php")){
  include_once("../lib/library.class.php");
}else{
  die("<script> alert('File not found');</script>");
}

if(!isset($_REQUEST['submit'])){
	header("Location: ../password_reset");
}else{
  $validate =  new sanitizer();
  $displayError = "";
  $newUser = new user();
  if($validate->validate($_REQUEST['username'])){
    $username =  $validate->transform(trim($_REQUEST['username']));
    if($newUser->checkuser($username,$conn->conn)==false){
      $_SESSION['securityUsername'] = $username;
      header("Location: ../change_password");
    }else{
      $displayError = "Unknow username";
    }
  }else{
    $displayError =  "Please enter a username!";
  }
  if($displayError<>""){
    header("Location: ../password_reset?errorCode={$displayError}");
  }
}
?>
