<?php
// migrate.php

require_once 'database.php';

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
    exit;
}

// Select the database
$conn->select_db($database);

// Your table creation code here...

// Execute the SQL statements
if ($conn->multi_query($sql) === TRUE) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . $conn->error;
}

// Close the connection
$conn->close();
?>
