<?php

// Database configuration
$dbHost = 'localhost'; // Change to your database host
$dbUsername = 'root'; // Change to your database username
$dbPassword = ''; // Change to your database password
$dbName = 'siliconbyte'; // Change to your database name

// Create a database connection
$dbConnection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection status
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}

// Set character set to UTF-8 (if needed)
$dbConnection->set_charset("utf8");

?>