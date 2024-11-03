<?php
// session_start();

// // Simulating a login (this should be done in your login script)
// if (isset($_POST['login'])) {
//     $_SESSION['loggedin'] = true;
//     header("Location: home.php");
//     exit();
// }

// // Simulating a logout (this should be done in your logout script)
// if (isset($_POST['logout'])) {
//     session_destroy();
//     header("Location: home.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home | Pet Dreamland</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/backgrounds/Pet Dreamland.svg" />
    <!-- <script type="text/javascript">
        // Clear the browser history to prevent going back to the login page
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script> -->
    <style>
        body {
            overflow-x: hidden;
            /* Prevent horizontal scrolling */
        }

        .singleProduct {
            padding: 0 15px;
        }

        .product-qty input {
            width: 50px;
            /* Adjust input width */
        }
    </style>
</head>

<body class="shopbackground">

    <section id="header">
        <a href="#"><img src="resources/backgrounds/Pet Dreamland.svg" style="height: 80px" /></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="home.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="userprofile.php">My Account</a></li>
                <li><a href="Watchlist.php">Watchlist</a></li>
                <li id="lg-bag"><a href="cart.php"><i class="bi bi-cart-fill"></i></a></li>
                <a href="#" id="close"><i class="bi bi-x"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class="bi bi-cart-fill"></i></a>
            <i id="bar" class="bi bi-list"></i>
        </div>
    </section>
    <section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 30% off!</p>
        <button onclick="window.location.href='shop.php'">Shop Now</button>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="resources/backgrounds/features/f1.png">
            <h6 class="fw-bold">Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="resources/backgrounds/features/f2.png">
            <h6 class="fw-bold">Online Orders</h6>
        </div>
        <div class="fe-box">
            <img src="resources/backgrounds/features/f3.png">
            <h6 class="fw-bold">Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="resources/backgrounds/features/f5.png">
            <h6 class="fw-bold">Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="resources/backgrounds/features/f6.png">
            <h6 class="fw-bold">24/7 Support</h6>
        </div>
    </section>

    <script src="script.js"></script>
    <?php include "footer.php"; ?>
</body>

</html>