<?php
if(file_exists("library.class.php")){
  include_once("library.class.php");
}else{
  die("File not found");
}
$db['server']='localhost';
$db['user']='root';
$db['pass']='';
$db['db']='estate';
$conn =  new connectionAPI($db['server'],$db['user'],$db['pass'],$db['db']);

 ?>
