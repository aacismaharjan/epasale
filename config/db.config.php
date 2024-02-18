<?php
// Include utils file
require(__DIR__ . "/../utils/utils.php");

// Local DB
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test_epasal_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the current session
session_start();