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
    <title>Add Member - St. Theresa Catholic Church</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/addmember.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <form action="process_form.php" method="post">
        <div class="heading">
            <h1>Personal Information</h1>
        </div>

        <div class="form-grid">
            <div class="forms">
                <label>Surname:</label>
                <input type="text" placeholder="Enter your surname" name="surname" required>
            </div>
            <div class="forms">
                <label>Other Name:</label>
                <input type="text" placeholder="Enter your other name" name="othername">
            </div>
            <div class="forms">
                <label>First Name:</label>
                <input type="text" placeholder="Enter your first name" name="firstname" required>
            </div>
            <div class="forms">
                <label>House Address:</label>
                <input type="text" placeholder="Enter your house address/number" name="houseaddress" required>
            </div>

            <div class="forms">
                <label>Digital Address:</label>
                <input type="text" placeholder="Enter your digital address" name="digitaladdress" required>
            </div>
            <div class="forms">
                <label>Contact Number:</label>
                <input type="number" placeholder="Enter your contact number" min="0" name="contactnumber">
            </div>
            <div class="forms">
                <label>Emergency Contact Number:</label>
                <input type="number" placeholder="Enter your emergency contact number" min="0" name="emergencycontactnumber" required>
            </div>
            <div class="forms">
                <label>Hometown:</label>
                <input type="text" placeholder="Enter your hometown" name="hometown" required>
            </div>
            <div class="forms">
                <label>Date of Birth:</label>
                <input type="date" class="form-control" placeholder="Enter your date of birth" id="dateofbirth" name="dateofbirth" required>
            </div>
            <div class="forms">
                <label>Gender:</label>
                <select name="gender" id="gender">
                    <option value="" selected hidden> Select Gender</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                </select>
            </div>
            <div class="forms">
                <label>Nationality:</label>
                <select id="country" name="country">
                    <option value="" selected hidden> Select Nationality</option>
                </select>
            </div>
            <div class="forms">
                <label>Martial Status:</label>
                <select name="martialstatus" id="martialstatus">
                    <option value="" selected hidden> Martial Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                </select>
            </div>
            <div class="forms">
                <label>Name of Spouse:</label>
                <input type="text" placeholder="Enter your name of spouse" name="nameofspouse">
            </div>
            <div class="forms">
                <label>Number of Children:</label>
                <input type="number" placeholder="Enter your number of children" min="0" name="numberofchildren">
            </div>
            <div class="forms">
                <label>Name of Children:</label>
                <input type="text" placeholder="Enter your name of children" name="nameofchildren">
            </div>
            <div class="forms">
                <label>Name of Mother:</label>
                <input type="text" placeholder="Enter your name of mother" name="nameofmother" required>
            </div>
            <div class="forms">
                <label>Mother's Denomination:</label>
                <select name="mothersdenomination" id="mothersdenomination">
                    <option value="" selected hidden> Mother's Denomination</option>
                    <option value="Catholic">Catholic</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="forms">
                <label>Name of Father:</label>
                <input type="text" placeholder="Enter your name of father" name="nameoffather" required>
            </div>
            <div class="forms">
                <label>Father's Denomination:</label>
                <select name="fathersdenomination" id="fathersdenomination">
                    <option value="" selected hidden> Father's Denomination</option>
                    <option value="Catholic">Catholic</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
        <div class="heading">
            <h1>Occupation Information</h1>
        </div>
        <div class="form-grid">
            <div class="forms">
                <label>Place of Employment:</label>
                <input type="text" placeholder="Enter of place of employment" name="placeofemployment" required>
            </div>


            <div class="forms">
                <label>Position:</label>
                <input type="text" placeholder="Enter of your position" name="position" required>
            </div>
        </div>

        <div class="heading">
            <h1>Baptism Information</h1>
        </div>
        <div class="form-grid">
            <div class="forms">
                <label>Baptized</label>
                <select name="baptized" id="baptized">
                    <option value="" selected hidden>Select Baptized</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="forms">
                <label>Place of Baptism:</label>
                <input type="text" placeholder="Enter of place of baptism" name="placeofbaptism" required>
            </div>
        </div>

        <div class="heading">
            <h1>Confirmation Information</h1>
        </div>
        <div class="form-grid">
            <div class="forms">
                <label>Confirmed:</label>
                <select name="confirmed" id="confirmed">
                    <option value="" selected hidden>Select Confirmation</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="forms">
                <label>Place of Confirmation:</label>
                <input type="text" placeholder="Enter of place of confirmation" name="placeofconfirmed" required>
            </div>

        </div>
        <div class="heading">
            <h1>Additional Information</h1>
        </div>
        <div class="form-grid">
            <div class="forms">
                <label>Select the Societies you join:</label>
                <select name="chosen-select[]" class="chosen-select" multiple>
                    <option value="Sacred Heart of Confraternity">Sacred Heart of Confraternity</option>
                    <option value="Youth Choir">Youth Choir</option>
                    <option value="Legion of Mary">Legion of Mary</option>
                    <option value="Charismatic">Charismatic</option>
                    <option value="St Theresa Society">St Theresa Society</option>
                    <option value="COSRA">COSRA</option>
                    <option value="Children of Mary">Children of Mary</option>
                    <option value="Knight and Ladies of Marshall">Knight and Ladies of Marshall</option>
                    <option value="Young Men's">Young Men's</option>
                    <option value="Mary Mother of Mothers">Mary Mother of Mothers</option>
                    <option value="Theresa Mma Kuo">Theresa Mma Kuo</option>
                    <option value="Men's">Men's</option>
                    <option value="Senior Choir">Senior Choir</option>
                    <option value="Lay Readers">Lay Readers</option>
                    <option value="Ushers">Ushers</option>
                    <option value="St Anthony Guild">St Anthony Guild</option>
                    <option value="Northern Union">Northern Union</option>
                    <option value="CYO">CYO</option>
                    <option value="St Theresa Guild">St Theresa Guild</option>
                    <option value="KLBS">KLBS</option>
                    <option value="Knight and Ladies of St John">Knight and Ladies of St John</option>

                </select>
            </div>
        </div>

        <div class="form">
            <button type="submit">Add Member</button>
        </div>

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