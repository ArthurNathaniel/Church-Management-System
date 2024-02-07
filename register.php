<?php
// Database connection
include "db.php";
// Get user input
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert user data into the database
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful. <a href='login.php'>Login</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
