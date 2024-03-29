<?php
// Connect to the database 
include "db.php";

// Retrieve data from the database
$sql = "SELECT * FROM members";
$result = $conn->query($sql);

// Create a file handle for writing the CSV data
$csv_file = fopen('members.csv', 'w');

// Write the CSV header
fputcsv($csv_file, array('surname', 'othername', 'firstname', 'houseaddress', 'digitaladdress', 'contactnumber', 'emergencycontactnumber', 'hometown', 'dateofbirth', 'gender', 'country', 'martialstatus', 'nameofspouse', 'numberofchildren', 'nameofchildren', 'nameofmother', 'mothersdenomination', 'nameoffather', 'fathersdenomination', 'placeofemployment', 'position', 'baptized', 'placeofbaptism', 'confirmed', 'placeofconfirmed', 'societies'));

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $societies = explode(', ', $row['societies']);
        $societies_str = implode("\n", $societies);
        fputcsv($csv_file, array(

            $row['surname'],
            $row['othername'],
            $row['firstname'],
            $row['houseaddress'],
            $row['digitaladdress'],
            $row['contactnumber'],
            $row['emergencycontactnumber'],
            $row['hometown'],
            $row['dateofbirth'],
            $row['gender'],
            $row['country'],
            $row['martialstatus'],
            $row['nameofspouse'],
            $row['numberofchildren'],
            $row['nameofchildren'],
            $row['nameofmother'],
            $row['mothersdenomination'],
            $row['nameoffather'],
            $row['fathersdenomination'],
            $row['placeofemployment'],
            $row['position'],
            $row['baptized'],
            $row['placeofbaptism'],
            $row['confirmed'],
            $row['placeofconfirmed'],
            $societies_str

        ));
    }
} else {
    fputcsv($csv_file, array('No members found.'));
}

// Close the CSV file handle
fclose($csv_file);

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="members.csv"');

// Output the CSV file contents
readfile('members.csv');

$conn->close();
