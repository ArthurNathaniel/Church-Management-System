<?php
session_start();

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
$password = $_POST['password'];

// Retrieve user data from the database
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        // Authentication successful
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Redirect to a protected dashboard page
    } else {
        echo "Invalid password. <a href='login.php'>Try again</a>";
    }
} else {
    echo "Invalid username. <a href='login.php'>Try again</a>";
}

mysqli_close($conn);
