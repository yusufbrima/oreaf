<?php
session_start();
unset($_SESSION['currentUser']);
unset($_SESSION['railtorAuthorization']);
unset($_SESSION['requestorAuthorization']);
session_destroy();
header('location:login');
?>
