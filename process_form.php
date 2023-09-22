<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit; // Terminate the script to prevent further execution
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database (replace with your database credentials)
    // $db_host = "localhost";
    // $db_user = "root";
    // $db_password = "";
    // $db_name = "church-member";
    $db_host = "sttheresaasawase.org"; // If the database is hosted on the same server
    $db_user = "u500921674_members";
    $db_password = "Members@123"; // Replace with the actual password
    $db_name = "u500921674_members";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $surname = $_POST['surname'];
    $othername = $_POST['othername'];
    $firstname = $_POST['firstname'];
    $houseaddress = $_POST['houseaddress'];
    $digitaladdress = $_POST['digitaladdress'];
    $contactnumber = $_POST['contactnumber'];
    $emergencycontactnumber = $_POST['emergencycontactnumber'];
    $hometown = $_POST['hometown'];
    $dateofbirth = $_POST['dateofbirth'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $martialstatus = $_POST['martialstatus'];
    $nameofspouse = $_POST['nameofspouse'];
    $numberofchildren = $_POST['numberofchildren'];
    $nameofchildren = $_POST['nameofchildren'];
    $nameofmother = $_POST['nameofmother'];
    $mothersdenomination = $_POST['mothersdenomination'];
    $nameoffather = $_POST['nameoffather'];
    $fathersdenomination = $_POST['fathersdenomination'];
    $placeofemployment = $_POST['placeofemployment'];
    $position = $_POST['position'];
    $baptized = $_POST['baptized'];
    $placeofbaptism = $_POST['placeofbaptism'];
    $confirmed = $_POST['confirmed'];
    $placeofconfirmed = $_POST['placeofconfirmed'];

    // Get selected societies as an array
    $societies = isset($_POST['chosen-select']) ? $_POST['chosen-select'] : array();

    // Convert the array of societies into a comma-separated string
    $societiesString = implode(', ', $societies);

    // Modify the SQL query to include the 'societies' column
    $sql = "INSERT INTO members (surname, othername, firstname, houseaddress, digitaladdress, contactnumber, emergencycontactnumber, hometown, dateofbirth, gender, country, martialstatus, nameofspouse, numberofchildren, nameofchildren, nameofmother, mothersdenomination, nameoffather, fathersdenomination, placeofemployment, position, baptized, placeofbaptism, confirmed, placeofconfirmed, societies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement preparation was successful
    if ($stmt) {
        // Create an array of values to bind including the societies string
        $valuesToBind = array(
            $surname,
            $othername,
            $firstname,
            $houseaddress,
            $digitaladdress,
            $contactnumber,
            $emergencycontactnumber,
            $hometown,
            $dateofbirth,
            $gender,
            $country,
            $martialstatus,
            $nameofspouse,
            $numberofchildren,
            $nameofchildren,
            $nameofmother,
            $mothersdenomination,
            $nameoffather,
            $fathersdenomination,
            $placeofemployment,
            $position,
            $baptized,
            $placeofbaptism,
            $confirmed,
            $placeofconfirmed,
            $societiesString // Insert the comma-separated string
        );

        // Create the bind_param string dynamically based on the number of values to bind
        $bindParamString = str_repeat('s', count($valuesToBind));

        // Bind the parameters
        $stmt->bind_param($bindParamString, ...$valuesToBind);

        // Execute the statement
        if ($stmt->execute()) {
            // Data inserted successfully
            header("Location: view_members.php"); // Redirect to the page to display data
            exit; // Terminate the script to prevent further execution
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'cdn.php'; ?>
    <title>Add Member</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/addmember.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <form action="process_form.php" method="post">
        <!-- ... (rest of your HTML form) ... -->
    </form>
    <?php include 'footer.php'; ?>
    <script>
        // Initialize Chosen for the select element
        $(document).ready(function() {
            $(".chosen-select").chosen();
        });
    </script>
    <script src="./javascript/date.js"></script>
    <script src="./javascript/country.js"></script>
</body>

</html>