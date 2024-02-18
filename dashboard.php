<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "db.php";
// Retrieve the username from the session
$username = $_SESSION['username'];

// Initialize variables to avoid errors
$totalMembers = 0;
$resultGroupGender = null;
$resultGroupMartialStatus = null;
$resultMotherDenomination = null;
$resultFatherDenomination = null;
$resultNationality = null;
$resultBaptized = null;
$resultConfirmation = null;

// Query to get the total number of members
$totalMembersQuery = "SELECT COUNT(*) AS totalMembers FROM members";
$resultTotalMembers = $conn->query($totalMembersQuery);

if ($resultTotalMembers) {
    $totalMembersData = $resultTotalMembers->fetch_assoc();
    $totalMembers = $totalMembersData['totalMembers'];
}

// Query to group members by gender
$groupGenderQuery = "SELECT gender, COUNT(*) AS genderCount FROM members GROUP BY gender";
$resultGroupGender = $conn->query($groupGenderQuery);

// Query to group members by marital status
$groupMartialStatusQuery = "SELECT martialstatus, COUNT(*) AS martialStatusCount FROM members GROUP BY martialstatus";
$resultGroupMartialStatus = $conn->query($groupMartialStatusQuery);

// Query to group members by Mother's Denomination
$motherDenominationQuery = "SELECT mothersdenomination, COUNT(*) AS motherDenominationCount FROM members GROUP BY mothersdenomination";
$resultMotherDenomination = $conn->query($motherDenominationQuery);

// Query to group members by Father's Denomination
$fatherDenominationQuery = "SELECT fathersdenomination, COUNT(*) AS fatherDenominationCount FROM members GROUP BY fathersdenomination";
$resultFatherDenomination = $conn->query($fatherDenominationQuery);

// Query to group members by nationality
$nationalityQuery = "SELECT country, COUNT(*) AS nationalityCount FROM members GROUP BY country";
$resultNationality = $conn->query($nationalityQuery);

// Query to group members by Baptized
$baptizedQuery = "SELECT baptized, COUNT(*) AS baptizedCount FROM members GROUP BY baptized";
$resultBaptized = $conn->query($baptizedQuery);

// Query to group members by Confirmation
$confirmationQuery = "SELECT confirmed, COUNT(*) AS confirmationCount FROM members GROUP BY confirmed";
$resultConfirmation = $conn->query($confirmationQuery);
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'cdn.php'; ?>
    <title>Dashboard - St. Theresa Catholic Church</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="dashboard-container dash-grid">
        <div class="total-members dash-card">
            <h1>Welcome, <?php echo $username; ?>!</h1>
        </div>
        <div class="total-members dash-card">
            <h2>Total Members</h2>
            <p><?php echo $totalMembers; ?></p>
        </div>

        <!-- Gender Distribution chart container -->
        <div class="gender-count dash-card">
            <p class="title">Gender</p>
            <canvas id="genderChart"></canvas>
        </div>

        <!-- Marital Status Distribution chart container -->
        <div class="martial-status-count dash-card">
            <p class="title">Marital Status</p>
            <canvas id="maritalStatusChart"></canvas>
        </div>

        <!-- Mother's Denomination Distribution chart container -->
        <div class="mother-denomination-count dash-card">
            <p class="title">Mother's Denomination</p>
            <canvas id="motherDenominationChart"></canvas>
        </div>

        <!-- Father's Denomination Distribution chart container -->
        <div class="father-denomination-count dash-card">
            <p class="title">Father's Denomination</p>
            <canvas id="fatherDenominationChart"></canvas>
        </div>

        <!-- Nationality Distribution chart container -->
        <div class="nationality-count dash-card">
            <p class="title">Nationality</p>
            <canvas id="nationalityChart"></canvas>
        </div>

        <!-- Baptized Distribution chart container -->
        <div class="baptized-count dash-card">
            <p class="title">Baptized</p>
            <canvas id="baptizedChart"></canvas>
        </div>

        <!-- Confirmation Distribution chart container -->
        <div class="confirmation-count dash-card">
            <p class="title">Confirmed</p>
            <canvas id="confirmationChart"></canvas>
        </div>
    </div>

    <script>
        // Data for Gender Distribution chart
        var genderData = {
            labels: [
                <?php
                while ($row = $resultGroupGender->fetch_assoc()) {
                    echo "'{$row['gender']}',";
                }
                ?>
            ],
            datasets: [{
                label: 'Gender',
                data: [
                    <?php
                    $resultGroupGender->data_seek(0); // Reset pointer
                    while ($row = $resultGroupGender->fetch_assoc()) {
                        echo "{$row['genderCount']},";
                    }
                    ?>
                ],
                backgroundColor: [

                    '#ff4961',
                    '#6158e5'
                    // Add more colors as needed
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    // Add more colors as needed
                ],
                borderWidth: 1
            }]
        };

        // Initialize Chart.js for Gender Distribution chart
        var genderChart = new Chart(document.getElementById('genderChart'), {
            type: 'doughnut',
            data: genderData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                // Add more options as needed
            }
        });

        // Data for Marital Status Distribution chart
        var maritalStatusData = {
            labels: [
                <?php
                while ($row = $resultGroupMartialStatus->fetch_assoc()) {
                    echo "'{$row['martialstatus']}',";
                }
                ?>
            ],
            datasets: [{
                label: 'Marital Status',
                data: [
                    <?php
                    $resultGroupMartialStatus->data_seek(0);
                    while ($row = $resultGroupMartialStatus->fetch_assoc()) {
                        echo "{$row['martialStatusCount']},";
                    }
                    ?>
                ],
                backgroundColor: [
                    '#ff4961',
                    '#6158e5'
                    // Add more colors as needed
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    // Add more colors as needed
                ],
                borderWidth: 1
            }]
        };

        // Initialize Chart.js for Marital Status Distribution chart
        var maritalStatusChart = new Chart(document.getElementById('maritalStatusChart'), {
            type: 'doughnut',
            data: maritalStatusData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                // Add more options as needed
            }
        });

        // Data for Mother's Denomination Distribution chart
        var motherDenominationData = {
            labels: [
                <?php
                while ($row = $resultMotherDenomination->fetch_assoc()) {
                    echo "'{$row['mothersdenomination']}',";
                }
                ?>
            ],
            datasets: [{
                label: "Mother's Denomination",
                data: [
                    <?php
                    $resultMotherDenomination->data_seek(0);
                    while ($row = $resultMotherDenomination->fetch_assoc()) {
                        echo "{$row['motherDenominationCount']},";
                    }
                    ?>
                ],
                backgroundColor: [
                    '#ff4961',
                    '#6158e5'
                    // Add more colors as needed
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    // Add more colors as needed
                ],
                borderWidth: 1
            }]
        };

        // Initialize Chart.js for Mother's Denomination Distribution chart
        var motherDenominationChart = new Chart(document.getElementById('motherDenominationChart'), {
            type: 'doughnut',
            data: motherDenominationData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                // Add more options as needed
            }
        });

        // Data for Father's Denomination Distribution chart
        var fatherDenominationData = {
            labels: [
                <?php
                while ($row = $resultFatherDenomination->fetch_assoc()) {
                    echo "'{$row['fathersdenomination']}',";
                }
                ?>
            ],
            datasets: [{
                label: "Father's Denomination",
                data: [
                    <?php
                    $resultFatherDenomination->data_seek(0);
                    while ($row = $resultFatherDenomination->fetch_assoc()) {
                        echo "{$row['fatherDenominationCount']},";
                    }
                    ?>
                ],
                backgroundColor: [
                    '#ff4961',
                    '#6158e5'
                    // Add more colors as needed
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    // Add more colors as needed
                ],
                borderWidth: 1
            }]
        };

        // Initialize Chart.js for Father's Denomination Distribution chart
        var fatherDenominationChart = new Chart(document.getElementById('fatherDenominationChart'), {
            type: 'doughnut',
            data: fatherDenominationData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                // Add more options as needed
            }
        });

        // Data for Nationality Distribution chart
        var nationalityData = {
            labels: [
                <?php
                while ($row = $resultNationality->fetch_assoc()) {
                    echo "'{$row['country']}',";
                }
                ?>
            ],
            datasets: [{
                label: 'Nationality',
                data: [
                    <?php
                    $resultNationality->data_seek(0);
                    while ($row = $resultNationality->fetch_assoc()) {
                        echo "{$row['nationalityCount']},";
                    }
                    ?>
                ],
                backgroundColor: [
                    '#ff4961',
                    '#6158e5'
                    // Add more colors as needed
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    // Add more colors as needed
                ],
                borderWidth: 1
            }]
        };

        // Initialize Chart.js for Nationality Distribution chart
        var nationalityChart = new Chart(document.getElementById('nationalityChart'), {
            type: 'doughnut',
            data: nationalityData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                // Add more options as needed
            }
        });

        // Data for Baptized Distribution chart
        var baptizedData = {
            labels: [
                <?php
                while ($row = $resultBaptized->fetch_assoc()) {
                    echo "'{$row['baptized']}',";
                }
                ?>
            ],
            datasets: [{
                label: 'Baptized',
                data: [
                    <?php
                    $resultBaptized->data_seek(0);
                    while ($row = $resultBaptized->fetch_assoc()) {
                        echo "{$row['baptizedCount']},";
                    }
                    ?>
                ],
                backgroundColor: [
                    '#ff4961',
                    '#6158e5'
                    // Add more colors as needed
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    // Add more colors as needed
                ],
                borderWidth: 1
            }]
        };

        // Initialize Chart.js for Baptized Distribution chart
        var baptizedChart = new Chart(document.getElementById('baptizedChart'), {
            type: 'doughnut',
            data: baptizedData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                // Add more options as needed
            }
        });

        // Data for Confirmation Distribution chart
        var confirmationData = {
            labels: [
                <?php
                while ($row = $resultConfirmation->fetch_assoc()) {
                    echo "'{$row['confirmed']}',";
                }
                ?>
            ],
            datasets: [{
                label: 'Confirmation',
                data: [
                    <?php
                    $resultConfirmation->data_seek(0);
                    while ($row = $resultConfirmation->fetch_assoc()) {
                        echo "{$row['confirmationCount']},";
                    }
                    ?>
                ],
                backgroundColor: [
                    '#ff4961',
                    '#6158e5'
                    // Add more colors as needed
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    // Add more colors as needed
                ],
                borderWidth: 1
            }]
        };

        // Initialize Chart.js for Confirmation Distribution chart
        var confirmationChart = new Chart(document.getElementById('confirmationChart'), {
            type: 'doughnut',
            data: confirmationData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                // Add more options as needed
            }
        });
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>