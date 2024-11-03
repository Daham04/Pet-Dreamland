<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | Pet Dreamland</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/backgrounds/Pet Dreamland.svg" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            if (isset($_SESSION["u"])) {

            ?>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border border-1 border-dark rounded mb-2">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <label class="form-label fs-1 fw-bold cate2">Watchlist &nbsp; &hearts;</label>
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-12 pt-3" style="background-color: #E3E5E4;">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>
                                </div>

                                <?php
                                require "connection.php";
                                $user = $_SESSION["u"]["email"];

                                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $user . "'");
                                $watch_num = $watch_rs->num_rows;

                                if ($watch_num == 0) {

                                ?>
                                    <!-- empty veiw -->

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home.php" class="btn btn-outline-warning fs-3 fw-bold">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- empty veiw -->

                                <?php

                                } else {

                                ?>
                                    <div class="col-12 col-lg-10 offset-lg-1">
                                        <div class="row">

                                            <?php

                                            for ($x = 0; $x < $watch_num; $x++) {
                                                $watch_data = $watch_rs->fetch_assoc();

                                            ?>
                                                <!-- have products -->

                                                <div class="card mb-3 mx-0 mx-lg-2 col-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">

                                                            <?php
                                                            $img = array();

                                                            $images_rs = Database::search("SELECT * FROM `images` WHERE `products_id`='" . $watch_data["products_id"] . "'");
                                                            $images_data = $images_rs->fetch_assoc();

                                                            ?>

                                                            <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-start" style="height: 200px;">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">

                                                                <?php

                                                                $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $watch_data["products_id"] . "'");
                                                                $product_data = $product_rs->fetch_assoc();

                                                                ?>

                                                                <h5 class="card-title fs-2 fw-bold text-dark"><?php echo $product_data["title"]; ?></h5>

                                                                <?php

                                                                $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data["condition_id"] . "'");
                                                                $condition_data = $condition_rs->fetch_assoc();

                                                                ?>

                                                                <span class="fs-5 fw-bold text-black-50">Condition : <?php echo $condition_data["name"]; ?></span><br /><br />
                                                                <span class="fs-5 fw-bold text-black-50">Price : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black">Rs. <?php echo $product_data["price"]; ?> .00 </span><br /><br />
                                                                <span class="fs-5 fw-bold text-black-50">Quantity : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black"><?php echo $product_data["qty"]; ?> Items Available</span><br />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                                <a href='<?php echo "singleProductView.php?id=".$product_data["id"]; ?>' class="btn btn-outline-success mb-2">Buy Now</a>
                                                                <a href="#" class="btn btn-outline-warning mb-2" onclick="addToCart(<?php echo $product_data['id'] ?>);">Add To Cart</a>
                                                                <a href="#" class="btn btn-outline-danger mb-2" onclick='removeFromWatchlist(<?php echo $watch_data["id"] ?>);'>Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- have products -->

                                            <?php
                                            }

                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }

                                ?>

                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {
                echo ("Please Login First");
            }

            ?>

            <?php include "footer.php" ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>