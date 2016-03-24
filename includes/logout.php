<?php

session_start();

// Unset all session values 
$_SESSION = array();
  
// Destroy session 
session_destroy();
header('Location: ../index.php');

exit;

?>