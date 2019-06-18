<?php
session_start();
unset($_SESSION['currentUser']);
unset($_SESSION['railtorAuthorization']);
session_destroy();
header('location:../login');
?>
