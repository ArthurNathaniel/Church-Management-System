<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
}

// Connect to the database (replace with your database credentials)
$db_host = "sttheresaasawase.org"; // If the database is hosted on the same server
$db_user = "u500921674_members";
$db_password = "Members@123"; // Replace with the actual password
$db_name = "u500921674_members";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$sql = "SELECT * FROM members";
$result = $conn->query($sql);
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

    <div class="table">
        <table id="memberTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Surname</th>
                    <th>Other Name</th>
                    <th>First Name</th>
                    <th>Societies</th> <!-- Add this line for societies -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["surname"] . "</td>";
                        echo "<td>" . $row["othername"] . "</td>";
                        echo "<td>" . $row["firstname"] . "</td>";

                        // Retrieve and display societies data
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
            $('#memberTable').DataTable(); // Replace 'memberTable' with the ID of your table
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>