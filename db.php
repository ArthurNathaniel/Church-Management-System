<?php
// db.php

// Connect to the database 
// $db_host = "localhost";
// $db_user = "root";
// $db_password = "";
// $db_name = "church-database";

$db_host = "sttheresaasawase.org";
$db_user = "u500921674_church";
$db_password = "OnGod@123";
$db_name = "u500921674_church";


$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
