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
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="dashboard-container dash-grid">
        <div class="total-members dash-card">
            <h1>Welcome, <?php echo $username; ?> !</h1>
        </div>
        <div class="total-members dash-card">
            <h2>Total Members</h2>
            <p><?php echo $totalMembers; ?></p>
        </div>

        <div class="gender-count dash-card">

            <div id="genderChart"></div>
        </div>

        <div class="martial-status-count dash-card">

            <div id="maritalStatusChart"></div>
        </div>

        <div class="mother-denomination-count dash-card">

            <div id="motherDenominationChart"></div>
        </div>

        <div class="father-denomination-count dash-card">

            <div id="fatherDenominationChart"></div>
        </div>

        <div class="nationality-count dash-card">

            <div id="nationalityChart"></div>
        </div>

        <div class="baptized-count dash-card">

            <div id="baptizedChart"></div>
        </div>

        <div class="confirmation-count dash-card">

            <div id="confirmationChart"></div>
        </div>
    </div>

    <script>
        // Data for Gender Distribution chart
        var genderData = [
            <?php
            while ($row = $resultGroupGender->fetch_assoc()) {
                echo "['{$row['gender']}', {$row['genderCount']}],";
            }
            ?>
        ];

        // Data for Marital Status Distribution chart
        var maritalStatusData = [
            <?php
            while ($row = $resultGroupMartialStatus->fetch_assoc()) {
                echo "['{$row['martialstatus']}', {$row['martialStatusCount']}],";
            }
            ?>
        ];

        // Data for Mother's Denomination Distribution chart
        var motherDenominationData = [
            <?php
            while ($row = $resultMotherDenomination->fetch_assoc()) {
                echo "['{$row['mothersdenomination']}', {$row['motherDenominationCount']}],";
            }
            ?>
        ];

        // Data for Father's Denomination Distribution chart
        var fatherDenominationData = [
            <?php
            while ($row = $resultFatherDenomination->fetch_assoc()) {
                echo "['{$row['fathersdenomination']}', {$row['fatherDenominationCount']}],";
            }
            ?>
        ];

        // Data for Nationality Distribution chart
        var nationalityData = [
            <?php
            while ($row = $resultNationality->fetch_assoc()) {
                echo "['{$row['country']}', {$row['nationalityCount']}],";
            }
            ?>
        ];

        // Data for Baptized Distribution chart
        var baptizedData = [
            <?php
            while ($row = $resultBaptized->fetch_assoc()) {
                echo "['{$row['baptized']}', {$row['baptizedCount']}],";
            }
            ?>
        ];

        // Data for Confirmation Distribution chart
        var confirmationData = [
            <?php
            while ($row = $resultConfirmation->fetch_assoc()) {
                echo "['{$row['confirmed']}', {$row['confirmationCount']}],";
            }
            ?>
        ];

        // Initialize Highcharts for Gender Distribution chart
        Highcharts.chart('genderChart', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            title: {
                text: 'Gender Distribution'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Count'
                }
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45
                }
            },
            series: [{
                name: 'Gender',
                data: genderData
            }]
        });

        // Initialize Highcharts for Marital Status Distribution chart
        Highcharts.chart('maritalStatusChart', {
            chart: {

                type: 'pie',
            },
            title: {
                text: 'Marital Status Distribution'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Count'
                }
            },
            series: [{
                name: 'Marital Status',
                data: maritalStatusData
            }]
        });

        // Initialize Highcharts for Mother's Denomination Distribution chart
        Highcharts.chart('motherDenominationChart', {
            chart: {
                type: 'pie',
            },
            title: {
                text: "Mother's Denomination Distribution"
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Count'
                }
            },
            series: [{
                name: "Mother's Denomination",
                data: motherDenominationData
            }]
        });

        // Initialize Highcharts for Father's Denomination Distribution chart
        Highcharts.chart('fatherDenominationChart', {
            chart: {
                type: 'pie',
            },
            title: {
                text: "Father's Denomination Distribution"
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Count'
                }
            },
            series: [{
                name: "Father's Denomination",
                data: fatherDenominationData
            }]
        });

        // Initialize Highcharts for Nationality Distribution chart
        Highcharts.chart('nationalityChart', {
            chart: {
                type: 'pie',
            },
            title: {
                text: 'Nationality Distribution'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Count'
                }
            },
            series: [{
                name: 'Nationality',
                data: nationalityData
            }]
        });

        // Initialize Highcharts for Baptized Distribution chart
        Highcharts.chart('baptizedChart', {
            chart: {
                type: 'pie',
            },
            title: {
                text: 'Baptized Distribution'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Count'
                }
            },
            series: [{
                name: 'Baptized',
                data: baptizedData
            }]
        });

        // Initialize Highcharts for Confirmation Distribution chart
        Highcharts.chart('confirmationChart', {
            chart: {
                type: 'pie',
            },
            title: {
                text: 'Confirmation Distribution'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Count'
                }
            },
            series: [{
                name: 'Confirmation',
                data: confirmationData
            }]
        });
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>