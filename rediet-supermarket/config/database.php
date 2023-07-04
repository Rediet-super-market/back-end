<?php
// config/database.php

require_once 'credentials.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;
?>
