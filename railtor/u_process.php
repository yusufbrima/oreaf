<?php
session_start();
  if(isset($_SESSION['railtorAuthorization']) && !empty($_SESSION['railtorAuthorization'])){
    $username = $_SESSION['currentUser'];
  }else{
  header('location: ../login.php?errorCode=Authentication required, you must login first to access this page!');
}
if(file_exists("../lib/library.class.php")){
  include_once("../lib/library.class.php");
}else{
  die("<script> alert('File not found');</script>");
} 
$validate =  new sanitizer();
$displayError_Code = "";
$hash_code =  hash("ripemd128", mt_rand(1000000,9999999));

    if(isset($_SESSION['railtor_id']) && isset($_SESSION['p_id'])){
       $railtor_id = $_SESSION['railtor_id'];
       $p_id = $_SESSION['p_id'];
       if(isset($_REQUEST['submit'])){
               if($validate->validate($_REQUEST['description'])){
                   if($validate->validate($_REQUEST['propertystatus'])){
                    if($validate->validate($_REQUEST['propertytype'])){
                        if($validate->validate($_REQUEST['region'])){
                            if($validate->validate($_REQUEST['region'])){
                                if($validate->validate($_REQUEST['district'])){
                                  if($validate->validate($_REQUEST['city'])){
                                      $city = $validate->sanitize(trim($_REQUEST['city']));
                                      $district = $validate->sanitize(trim($_REQUEST['district']));
                                      $region = $validate->sanitize(trim($_REQUEST['region']));
                                      $description = $validate->sanitize(trim($_REQUEST['description']));
                                      $propertystatus = $validate->sanitize(trim($_REQUEST['propertystatus']));
                                      $propertytype = $validate->sanitize(trim($_REQUEST['propertytype']));
                                      $area = isset($_REQUEST['area'])?$validate->sanitize(trim($_REQUEST['area'])):NULL; 
                                      $bath = isset($_REQUEST['bath'])?$validate->sanitize(trim($_REQUEST['bath'])):NULL; 
                                      $room = isset($_REQUEST['room'])?$validate->sanitize(trim($_REQUEST['room'])):NULL; 
                                      $bed = isset($_REQUEST['bed'])?$validate->sanitize(trim($_REQUEST['bed'])):NULL; 
                                      $parking = isset($_REQUEST['parking'])?$validate->sanitize(trim($_REQUEST['parking'])):NULL; 
                                      $cost = isset($_REQUEST['cost'])?$validate->sanitize(trim($_REQUEST['cost'])):NULL;
                                      if(estate_property::update_property($description,$railtor_id,$area,$bath,$room,$bed,$parking,$cost,$propertystatus,$propertytype,$region,$district,$city,$p_id,$conn->conn)){
                                          $displaySuccess_Code = "0X00A24";
                                          header("Location: post?s_code=$displaySuccess_Code&t_token=$hash_code");
                                        }else{
                                          $displayError_Code = "0X00E71";
                                          header("Location: post?e_code=$displayError_Code&t_token=$hash_code");
                                        }
                                    }
                              }
                          }
                        }
                    }
                  }
               }
             }
    }else{
      $displayError_Code = "0X00E71";
      header("Location: post?e_code=$displayError_Code&t_token=$hash_code");
    }

?>