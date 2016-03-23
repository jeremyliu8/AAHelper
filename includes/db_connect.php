<?php

include_once 'psl-config.php';

// Create connection
$connection = new mysqli(HOST, USER, PASSWORD, DATABASE);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

echo "Connected successfully";

?>