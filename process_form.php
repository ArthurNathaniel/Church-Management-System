<?php
session_start();

// Include database connection
include "db.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Process profile image upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["file-input"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["file-input"]["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
        echo "File is not an image.";
    }

    // Check file size
    // if ($_FILES["file-input"]["size"] > 500000) {
    //     $uploadOk = 0;
    //     echo "File is too large.";
    // }

    // Allow certain file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        $uploadOk = 0;
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // You can handle errors here if needed
        echo "File upload failed.";
    } else {
        if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $targetFile)) {
            // File uploaded successfully
            echo "File uploaded successfully.";
        } else {
            // Error uploading file
            echo "Error uploading file.";
            exit;
        }
    }

    // Store the profile image path in the database
    $profileImagePath = $uploadOk ? $targetFile : null;

    // Check for duplicate entry
    $checkDuplicate = $conn->prepare("SELECT * FROM members WHERE surname = ? AND othername = ? AND firstname = ? AND dateofbirth = ?");
    $checkDuplicate->bind_param("ssss", $_POST['surname'], $_POST['othername'], $_POST['firstname'], $_POST['dateofbirth']);
    $checkDuplicate->execute();
    $checkDuplicateResult = $checkDuplicate->get_result();

    if ($checkDuplicateResult->num_rows > 0) {
        // Duplicate entry found, display alert and redirect
        echo '<script>alert("Member with the same details already exists."); window.location.href = "addmember.php";</script>';
        exit;
    }

    // Modify your SQL query to include the 'profile_image' column
    $sql = "INSERT INTO members (surname, othername, firstname, houseaddress, digitaladdress, contactnumber, emergencycontactnumber, hometown, dateofbirth, gender, country, martialstatus, nameofspouse, numberofchildren, nameofchildren, nameofmother, mothersdenomination, nameoffather, fathersdenomination, placeofemployment, position, baptized, placeofbaptism, confirmed, placeofconfirmed, societies, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $valuesToBind = array(
            $_POST['surname'],
            $_POST['othername'],
            $_POST['firstname'],
            $_POST['houseaddress'],
            $_POST['digitaladdress'],
            $_POST['contactnumber'],
            $_POST['emergencycontactnumber'],
            $_POST['hometown'],
            $_POST['dateofbirth'],
            $_POST['gender'],
            $_POST['country'],
            $_POST['martialstatus'],
            $_POST['nameofspouse'],
            $_POST['numberofchildren'],
            $_POST['nameofchildren'],
            $_POST['nameofmother'],
            $_POST['mothersdenomination'],
            $_POST['nameoffather'],
            $_POST['fathersdenomination'],
            $_POST['placeofemployment'],
            $_POST['position'],
            $_POST['baptized'],
            $_POST['placeofbaptism'],
            $_POST['confirmed'],
            $_POST['placeofconfirmed'],
            implode(', ', isset($_POST['chosen-select']) ? $_POST['chosen-select'] : array()),
            $profileImagePath
        );

        $bindParamString = str_repeat('s', count($valuesToBind));
        $stmt->bind_param($bindParamString, ...$valuesToBind);

        if ($stmt->execute()) {
            // Record inserted successfully
            echo '<script>alert("Member added successfully!"); window.location.href = "addmember.php";</script>';
            exit;
        } else {
            // Error inserting record
            echo '<script>alert("Error adding member. Please try again.");</script>';
        }

        $stmt->close();
    } else {
        // Error in preparing the SQL statement
        echo '<script>alert("Error preparing SQL statement.");</script>';
    }

    $conn->close();
}
