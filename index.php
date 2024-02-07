<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - St. Theresa Catholic Church</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <div class="page_all">
        <h1>Hello</h1>
        <h1>Welcome to the best faculty in KsTU</h1>
        <h1 class="typed-text"></h1>

        <button>
            <a href="./login.php" >Login as Admin</a>
        </button>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var options = {
            strings: ["Faculty of Applied Science and Technology"],
            typeSpeed: 50,
            backSpeed: 50,
            backDelay: 4000,
            startDelay: 100,
            showCursor: true,
            cursorChar: "",
            loop: true,
        };

        var typed = new Typed(".typed-text", options);
    });
</script>

</html>