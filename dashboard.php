<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'cdn.php'; ?>
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="dash-heading">
        <h1>Welcome <?php echo $_SESSION['username']; ?>,</h1>
    </div>

   <h1>Under Construction</h1>
    <?php include 'footer.php'; ?>
</body>

</html>