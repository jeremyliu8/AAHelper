<?php 
    session_start();

    // Connect to the database
    include_once 'includes/db_connect.php';

    // Load functions
    require 'includes/functions.php';

    login($connection);
?>