<?php

require_once 'credentials.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, null, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db($database);

// Disable foreign key checks
$conn->query('SET FOREIGN_KEY_CHECKS = 0');

// Drop all tables
$tables = $conn->query("SHOW TABLES");
if ($tables === false) {
    echo "Error retrieving table list: " . $conn->error;
    exit;
}

while ($row = $tables->fetch_row()) {
    $tableName = $row[0];
    $sql = "DROP TABLE IF EXISTS `$tableName`";
    if ($conn->query($sql) === TRUE) {
        echo "Table '$tableName' dropped successfully<br>";
    } else {
        echo "Error dropping table '$tableName': " . $conn->error . "<br>";
    }
}

// Enable foreign key checks
$conn->query('SET FOREIGN_KEY_CHECKS = 1');

// Close the connection
$conn->close();
?>
