<?php
session_start();
unset($_SESSION['admin_user']);
unset($_SESSION['token']);
session_destroy();
header('location: index');
?>
