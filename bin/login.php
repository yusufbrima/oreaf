<?php
session_start();
if(file_exists("../lib/library.class.php")){
  include_once("../lib/library.class.php");
}else{
  die("<script> alert('File not found');</script>");
}
if(!isset($_REQUEST['submit'])){
	header("Location: ../login");
}else{
	//echo "successfully submitted data";
	$validate =  new sanitizer();
	$displayError = "";
	if($validate->validate($_REQUEST['Username'])){
    if($validate->validate($_REQUEST['valPassword'])){
      $username = $validate->transform(trim($_REQUEST['Username']));
      $valPassword =trim($_REQUEST['valPassword']);
      $newUser = new user();
      if($newUser->login($username,$valPassword,$conn->conn)){
          $usertype = $newUser->getUserType($username,$conn->conn);
          $_SESSION['currentUser']=$username;
        //  setcookie('username',$username,time()+7*24*60*60);
          if($usertype==1){//Redirection to requestor home page
            $_SESSION['requestorAuthorization']=$usertype;
            header("Location: ../requestor");
          }elseif($usertype==2){//Redirection to railtor homepage
            $_SESSION['railtorAuthorization']=$usertype;
            header("Location: ../railtor");
          }
      }else{
        $displayError =  "Login failed, username or password is wrong";
      }
  	}else{
  	  $displayError =  "Password field is required";
  	}
	}else{
	  $displayError =  "Username is required";
	}
	if($displayError<>""){
		header("Location: ../login?errorCode={$displayError}");
	}
}
?>
