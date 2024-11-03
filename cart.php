<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | Pet Dreamland</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/backgrounds/Pet Dreamland.svg" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            require "connection.php";

            if (isset($_SESSION['u'])) {

                $email = $_SESSION["u"]["email"];

                $total = 0;
                $subtottal = 0;
                $shipping = 0;

            ?>

                <div class="col-12 pt-3" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 border border-1 border-dark rounded mb-3">
                    <div class="row">

                        <div class="col-12 text-center">
                            <label class="form-label fs-2 fw-bolder cate1">Cart <i class="bi bi-cart4 fs-1 text-black"></i></label>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <?php


                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $email . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {

                        ?>

                            <!-- Empty View -->

                            <div class="col-12 ">
                                <div class="row">
                                    <div class="col-12 emptyCard"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 fw-bold">You have no items in your Cart yet...</label>
                                    </div>
                                </div>
                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                    <a href="home.php" class="btn btn-outline-primary fs-4 fw-bold">Start Shopping</a>
                                </div>

                            </div>

                            <!-- Empty View -->


                        <?php

                        } else {

                        ?>

                            <!-- products -->

                            <div class="col-12">
                                <div class="row">

                                    <?php

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $cart_data["products_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();     

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                        $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN `city` ON 
                                        user_has_address.city_id=city.id INNER JOIN `district` ON city.district_id=district.id WHERE 
                                        `user_email`='" . $email . "'");

                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        if ($address_data["did"] == 3) {

                                            $ship = $product_data["delivery_fee_colombo"];
                                            $shipping = $shipping + $product_data["delivery_fee_colombo"];
                                        } else {
                                            $ship = $product_data["delivery_fee_other"];
                                            $shipping = $shipping + $product_data["delivery_fee_other"];
                                        }

                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "' ");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                    ?>

 
                                        <div class="card mb-3 mx-0 col-12">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $seller ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-4">

                                                    <?php

                                                    $img_rs = Database::search("SELECT * FROM `images` WHERE `products_id` ='" . $product_data["id"] . "' ");
                                                    $img_data = $img_rs->fetch_assoc();

                                                    ?>
                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product-Details">
                                                        <img src="<?php echo $img_data["code"] ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                    </span>


                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title"><?php echo $product_data["title"] ?></h3><br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.<?php echo $product_data["price"] ?>.00</span>
                                                        <br><br>
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $ship ?> .00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-2">
                                                    <div class="card-body d-grid">
                                                        <a href='<?php echo "singleProductView.php?id=".$product_data["id"]; ?>' class="btn btn-outline-success mb-2">Buy Now</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs. <?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?> .00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    <?php

                                    }


                                    ?>

                                </div>
                            </div>

                            <!-- products -->

                            <!-- Summery -->

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold cate1">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items (<?php echo $cart_num ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $total ?> .00</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $shipping ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold">Total</span>


                                        
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold">Rs. <?php echo $shipping + $total ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-dark fs-5 fw-bold">CHECKOUT</button>
                                    </div>

                                </div>
                            </div>

                            <!-- Summery -->

                        <?php
                        }


                        ?>





                    </div>
                </div>

            <?php

            } else {
                echo ("Please Sign In or Register");
            }


            ?>

            <?php include "footer.php" ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>