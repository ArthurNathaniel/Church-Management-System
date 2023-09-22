<?php
// Database connection
// $db_host = "localhost";
// $db_user = "root";
// $db_password = "";
// $db_name = "church-database";

$db_host = "sttheresaasawase.org"; // If the database is hosted on the same server
$db_user = "u500921674_church_account";
$db_password = "Church_account@123"; // Replace with the actual password
$db_name = "u500921674_church_account";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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
