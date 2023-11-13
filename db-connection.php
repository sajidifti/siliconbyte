<?php

$hostname = 'localhost';
$username = 'ifti';
$password = '@LegionSlim7';
$database = 'siliconbyte';

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection status
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8 (if needed)
$conn->set_charset("utf8");

?>