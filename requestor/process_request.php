<?php
session_start();
if(isset($_SESSION['requestorAuthorization']) && !empty($_SESSION['requestorAuthorization'])){
    $username = $_SESSION['currentUser'];
  }else{
  header('location: ../login.php?errorCode=Authentication required, you must login first to access this page!');
}
if(file_exists("../lib/library.class.php")){
  include_once("../lib/library.class.php");
}else{
  die("<script> alert('File not found');</script>");
}
$sanitizer = new sanitizer();
 $property_id = $sanitizer->sanitize($_REQUEST['property_id']);
 $railtor_id = $sanitizer->sanitize($_REQUEST['railtor_id']);
 $requestor_id = $sanitizer->sanitize($_REQUEST['requestor_id']);
 if(requestor::check_transaction($requestor_id,$property_id,$railtor_id,$conn->conn)){
 	if(requestor::send_request($requestor_id,$property_id,$railtor_id,$conn->conn)){
 	echo "<h1 style='color:green;'>Request Sent Successfully</h1><p>You will be contacted shortly by property Owner</p>";
	 }else{
	 	echo "<h1 style='color:red;'>Request could not bet sent</h1>";
	 }
 }else{
 	echo "<h1 style='color:red;'>Request already sent</h1>";
 }
 ?>