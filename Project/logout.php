<?php
session_start();
session_destroy();
unset($_SESSION['userid']);
$_SESSION['message']="You are now logged out";
header("location:login.php");
?>