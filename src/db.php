<?php
// db.php

$host = 'localhost'; // Your database host
$username = 'root'; // Your database username
$password = ''; // Your database password
$dbname = 'solegood'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set
$conn->set_charset("utf8");

?>
