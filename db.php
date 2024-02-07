<?php
// db.php

// Connect to the database 
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "church-database";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
