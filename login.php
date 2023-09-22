<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/signup.css">
</head>

<body>
    <div class="signup-grid">
        <div class="signup-image">

        </div>
        <div class="signup-form">
            <div class="form-logo">

            </div>
            <form action="authenticate.php" method="post" class="form-all">
                <div class="forms">
                    <label for="username">Username:</label>
                    <input type="text" name="username" placeholder="Enter your username" id="username" required>
                </div>

                <div class="forms">
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Enter your password" id="password" required>
                </div>

                <div class="forms">
                    <input type="submit" value="Login" class="submit">
                </div>
            </form>
        </div>
    </div>
</body>

</html>