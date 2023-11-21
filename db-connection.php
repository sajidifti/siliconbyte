<?php

// Get info from environment variables (NGINX fastcgi_param)
$host = getenv("DB_HOST");
$user = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$dbname = getenv("DB_NAME");

// For local server
// $host = 'localhost';
// $user = 'root';
// $password = '';
// $dbname = 'siliconbyte';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection status
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8 (if needed)
$conn->set_charset("utf8");

// echo "DB Connected";

?>