<?php
if(file_exists("../lib/library.class.php")){
  include_once("../lib/library.class.php");
}else{
  die("<script> alert('File not found');</script>");
}
$contact_email = 'admin@orea.com';
$errorCode = "";
$successCode = "";
if(!isset($_REQUEST['submit'])){
  $errorCode = "0X00E49";
	header("Location: ../contact?errorCode=$errorCode");
}else{
  $validate =  new sanitizer();
  if($validate->validate($_REQUEST['Name'])){
    if($validate->validate($_REQUEST['emailSubject'])){
      if($validate->validate($_REQUEST['Email'])){
        if($validate->validate($_REQUEST['feedback'])){
          $user_name = stripslashes(strip_tags(trim($_REQUEST['Name'])));
          $user_email = stripslashes(strip_tags(trim($_REQUEST['Email'])));
          $user_subject =stripslashes(strip_tags(trim($_REQUEST['emailSubject'])));
          $user_msg =stripslashes(strip_tags(trim($_REQUEST['feedback'])));
          $subj = 'Message from OREA';
        	$msg = $subj." \r\nSubject: $user_subject \r\n \r\nName: $user_name \r\nE-mail: $user_email \r\nMessage: $user_msg";
        	$head = "Content-Type: text/plain; charset=\"utf-8\"\n"
        		. "X-Mailer: PHP/" . phpversion() . "\n"
        		. "Reply-To: $user_email\n"
        		. "To: $contact_email\n"
        		. "From: $user_email\n";
          if (mail($contact_email, $subj, $msg, $head)){
            $successCode = "0X00F50";
            header("Location: ../contact?successCode=$successCode");
          }else{
            $errorCode = "0X00E54";
            header("Location: ../contact?errorCode=$errorCode");
          }

        }else{
          $errorCode = "0X00E53";
          header("Location: ../contact?errorCode=$errorCode");
        }
      }else{
        $errorCode = "0X00E52";
        header("Location: ../contact?errorCode=$errorCode");
      }
    }else{
      $errorCode = "0X00E51";
      header("Location: ../contact?errorCode=$errorCode");
    }
  }else{
    $errorCode = "0X00E50";
    header("Location: ../contact?errorCode=$errorCode");
  }
}

?>
