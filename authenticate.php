<?php
session_start();

include "db.php";

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
        // Invalid password
        echo "<script>alert('Invalid password. Please try again.');</script>";
        echo "<script>window.location.href='login.php';</script>";
    }
} else {
    // Invalid username
    echo "<script>alert('Invalid username. Please try again.');</script>";
    echo "<script>window.location.href='login.php';</script>";
}

mysqli_close($conn);
