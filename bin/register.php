<?php
session_start();
if(file_exists("../lib/library.class.php")){
  include_once("../lib/library.class.php");
}else{
  die("<script> alert('File not found');</script>");
}
if(!isset($_REQUEST['submit'])){
	header("Location: ../register");
}else{
	//echo "successfully submitted data";
	$validate =  new sanitizer();
	$displayError = "";
	if($validate->validate($_REQUEST['Name'])){
		if($validate->validate($_REQUEST['UserType'])){
			if($validate->validate($_REQUEST['valPhone'])){
				if($validate->validate($_REQUEST['Email'])){
					if($validate->validate($_REQUEST['valPassword'])){
						if($validate->validate($_REQUEST['rePassword'])){
							if($_REQUEST['valPassword']==$_REQUEST['rePassword']){
								//echo "Voila! <br /> This is a better validation";
								$username = $validate->transform(trim($_REQUEST['Name']));
								$UserType =  trim($_REQUEST['UserType']);
								$valPhone = trim($_REQUEST['valPhone']);
								$Eamil = trim($_REQUEST['Email']);
				                $question = trim($_REQUEST['question']);
				                $response = trim($_REQUEST['response']);
								$valPassword =trim($_REQUEST['rePassword']);
								$newUser = new user();
								if($newUser->checkuser($username,$conn->conn)){
								  // echo "user not registered";
								  if($newUser->addUser($username,$valPassword,$Eamil,$UserType,$valPhone,$question,$response,$conn->conn)){
								    //$displayError = "User added successfully";
                    $_SESSION['userRegistration'] =  $username;
										header("Location: ../login");
								  }else{
								    $displayError =  "Error in adding user to database";
								  }
								}else{
								  $displayError =  "user already registered";
								}
							}else{
								$displayError = "Passwords must match";
							}
						}else{
						  $displayError = "Please Check confirmation password";
						}
					}else{
						$displayError = "Invalid Password";
					}
				}else{
					$displayError =  "Invalid Email Address";
				}
			}else{
			  $displayError =  "Invalid Phone Number";
			}
		}else{
			$displayError =  "Invalid User Type Selection";
		}
	}else{
	  $displayError =  "Invalid Username";
	}
	if($displayError<>""){
		header("Location: ../register?errorCode={$displayError}");
	}
}
?>
