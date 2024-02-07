<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
}

include "db.php";

// Define the table name
$table_name = "members";  // Change this to the desired table name

// Retrieve data from the database using the dynamic table name
$sql = "SELECT * FROM $table_name";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    echo "Error: " . $conn->error;
} else {
    // Continue with displaying the data
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php include 'cdn.php'; ?>
        <title>View Members - St. Theresa Catholic Church</title>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="./css/base.css">
        <link rel="stylesheet" href="./css/view_members.css">
    </head>

    <body>
        <?php include 'navbar.php'; ?>

        <div class="church-member-list">
            <h1>Church Members List</h1>
        </div>

        <style>
            tr {
                text-align: left;
                border: 1px solid red;
            }

            .profile-image {
                max-width: 50px;
                max-height: 50px;
            }
        </style>

        <div class="table">
            <table id="memberTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Profile Image</th>
                        <th>Surname</th>
                        <th>Other Name</th>
                        <th>First Name</th>
                        <th>Contact Number</th>
                        <th>House Number</th>
                        <th>Marital Status</th>
                        <th>Societies</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Display profile image
                            echo "<td>";
                            if (!empty($row['profile_image'])) {
                                echo '<img src="' . $row['profile_image'] . '" alt="Profile Image" class="profile-image">';
                            }
                            echo "</td>";
                            echo "<td>" . $row["surname"] . "</td>";
                            echo "<td>" . $row["othername"] . "</td>";
                            echo "<td>" . $row["firstname"] . "</td>";
                            echo "<td>" . $row["contactnumber"] . "</td>";
                            echo "<td>" . $row["houseaddress"] . "</td>";
                            echo "<td>" . $row["martialstatus"] . "</td>";

                            $societies = explode(', ', $row['societies']);
                            echo "<td>";
                            foreach ($societies as $society) {
                                echo htmlspecialchars($society) . "<br>";
                            }
                            echo "</td>";

                           

                            echo "</tr>";
                        }
                    } else {
                        echo "No members found.";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="download">
            <div class="download-buttons">
                <a href="generate_csv.php">Download as CSV</a>
            </div>
        </div>

        <?php include 'footer.php'; ?>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#memberTable').DataTable();
            });
        </script>
    </body>

    </html>

<?php
    $conn->close();
}
?>