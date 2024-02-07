<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - St. Theresa Catholic Church</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/signup.css">
</head>

<body>
    <div class="signup-grid">
        <div class="swippeer">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="./images/st-theresa.jpg" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="./images/st-theresa.jpg" alt="">
                    </div>
                </div>
                <div class="box-swipper">
                    <button class="fa-solid fa-arrow-left next "></button>
                    <button class="fa-solid fa-arrow-right prev "></button>
                </div>
            </div>
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
<script src="./javascript/swiper.js"></script>

</html>