<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $products_rs = Database::search("SELECT products.id,products.category_id,products.price,products.qty,products.description,
    products.title,products.condition_id,products.status_id,products.user_email,products.datetime_added,
    products.delivery_fee_colombo,products.delivery_fee_other,products.brand_has_model_id,
    model.name AS mname,brand.name AS bname FROM `products` INNER JOIN `brand_has_model` ON
    brand_has_model.id=products.brand_has_model_id INNER JOIN `brand` ON brand.id=brand_has_model.brand_id INNER JOIN
    `model` ON model.id=brand_has_model.model_id WHERE products.id='" . $pid . "'");

    $products_num = $products_rs->num_rows;

    if ($products_num == 1) {

        $products_data = $products_rs->fetch_assoc();


?>


        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo ($products_data["title"]); ?>| Pet Dreamland</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resources/backgrounds/Pet Dreamland.svg" />
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

        <body class="">
            <div class="container-fluid">
                <div class="row">

                    <?php include "header.php" ?>

                    <hr />

                    <div class="row offset-lg-2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-12 mt-0  singleProduct">
                        <div class="row">
                            <div class="col-12" style="padding: 10px;">
                                <div class="row">
                                    <div class="col-12 col-lg-2 order-2 order-lg-1 offset-lg-2">
                                        <ul>

                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `products_id`='" . $pid . "'");
                                            $image_num = $image_rs->num_rows;
                                            $img = array();

                                            if ($image_num != 0) {
                                                for ($x = 0; $x < $image_num; $x++) {
                                                    $image_data = $image_rs->fetch_assoc();
                                                    $img[$x] = $image_data["code"];

                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                        <img src="<?php echo $img["$x"]; ?>" style="height: 200px;" class="img-thumbnail mt-1 mb-1" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" />
                                                    </li>

                                                <?php
                                                }
                                            } else {
                                                ?>

                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>

                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>

                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                            <?php
                                            }


                                            ?>


                                        </ul>
                                    </div>

                                    <div class="col-lg-6 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="row">
                                            <div class="col-12 align-items-center border border-1 border-secondary">
                                                <div class="main-img" id="main_img"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12  order-3">
                                        <div class="row">
                                            <div class="col-12">



                                                <div class="row offset-lg-4">
                                                    <div class="col-12 my-2">
                                                    <span class="fs-5 fw-bold text-success ">Title</span>
                                                        <span class="fs-5 text-dark fw-bold"><?php echo $products_data["title"] ?></span>
                                                    </div>
                                                </div>



                                                <?php

                                                $price = $products_data["price"];
                                                $adding_price = ($price / 100) * 13;
                                                $new_price = $price + $adding_price;
                                                $difference = $new_price - $price;
                                                $precentage = ($difference / $price) * 100;

                                                ?>
                                                <div class="row offset-lg-4">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-5 fw-bold text-success ">Rs. <?php echo $price ?> .00</span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-5 fw-bold text-dark text-decoration-line-through ">Rs.<?php echo $new_price ?> .00</span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-5 fw-bold text-danger">Save Rs. <?php echo $difference ?> .00 (<?php echo $precentage ?>%)</span>
                                                    </div>
                                                </div>

                                                <div class="row offset-lg-4">
                                                    <div class="col12 my-2">
                                                        <span class="fs-5 text-dark"><b class="fs-5" style="color: black;">In Stock : </b><?php echo $products_data["qty"] ?> Items Available</span>
                                                    </div>
                                                </div>
                                                <!-- 
                                                <div class="row mt-3">
                                                    <div class="col-12 col-lg-6 my-2 offset-lg-4">
                                                        <div class="row g-2">
                                                            <div class="col-12 col-lg-6 border border-1 border-secondary text-center">
                                                                <span class="fs-5 text-dark">Seller Name</span>
                                                            </div>
                                                            <div class="col-12 col-lg-6 border border-1 border-secondary text-center">
                                                                <span class="fs-5 text-dark">Daham Bandara</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6 my-2 offset-lg-4">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-secondary rounded overflow-hidden 
                                                                 float-left mt-3 position-relative product-qty">
                                                                        <div class="col-12 ">
                                                                            <span>Quantity : </span>
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" id="qty_input" onkeyup='checkValue(<?php echo $products_data["qty"]; ?>);' />

                                                                            <div class="position-absolute qty-buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                             border border-1 border-secondary qty-inc">
                                                                                    <i class="bi bi-caret-up-fill text-dark fs-5" onclick="qty_inc(<?php echo $products_data['qty']; ?>)"></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                              border border-1 border-secondary qty-dec">
                                                                                    <i class="bi bi-caret-down-fill text-dark fs-5" onclick="qty_dec();"></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-12 mt-5 ">
                                                                            <div class="row">
                                                                                <div class="col-12 col-lg-4 d-grid">
                                                                                    <button class="btn btn-success" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid ?>);">Buy Now</button>
                                                                                </div>
                                                                                <div class="col-12 col-lg-4 d-grid  ">
                                                                                    <button class="btn btn-danger" onclick="addToCart(<?php echo $products_data['id'] ?>);">Add to Cart</button>
                                                                                </div>
                                                                                <div class="col-12 col-lg-4 d-grid ">
                                                                                    <button class="btn btn-dark" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                                    </button>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 ">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>


                            <?php
                            $query = "SELECT * FROM `products` WHERE category_id='" . $products_data["category_id"] . "' ";

                            $product_rs = Database::search($query);
                            $product_num = $product_rs->num_rows;


                            for ($x = 0; $x < $product_num; $x++) {
                                $product_data = $product_rs->fetch_assoc();

                                $img_rs = Database::search("SELECT * FROM `images` WHERE `products_id` ='" . $product_data["id"] . "' ");
                                $img_data = $img_rs->fetch_assoc();


                            ?>

                                <div class="card mt-2 mb-2 offset-lg-1" style="width: 18rem;">

                                    <img src="<?php echo $img_data["code"] ?>" class="card-img-top" style="height: 200px;" />
                                    <div class="card-body">
                                        <h5 class="card-title fw-bolder text-center border-bottom border-dark"><?php echo $product_data["title"] ?></h5>
                                        <!-- <div class="overflow-scroll" style="height: 200px;">
                                            <p class="card-text"><?php echo $product_data["description"] ?></p>
                                        </div> -->
                                        <div class="col-12 d-grid">
                                            <div class="row">
                                                <button class="col-12 btn btn-outline-primary mt-2" onclick="addToCart(<?php echo $product_data['id'] ?>);">Add to Cart</button>
                                                <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="col-12 btn btn-outline-success mt-2 mb-2">Buy Now</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php

                            }
                            ?>

                            <div class="col-12 ">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 ">
                                <div class="row">

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Type </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo $products_data["bname"] ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Model </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo $products_data["mname"] ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border border-primary" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold">Product Description : </label>
                                            </div>
                                            <div>
                                                <textarea cols="60" rows="10" class="form-control" readonly><?php echo $products_data["description"] ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="row border border-1 border-dark rounded overflow-scroll me-0" style="height: 300px;">

                                    <?php

                                    $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `products_id`='" . $pid . "'");
                                    $feedback_num = $feedback_rs->num_rows;

                                    for ($x = 0; $x < $feedback_num; $x++) {
                                        $feedback_data = $feedback_rs->fetch_assoc();
                                    ?>
                                        <div class="col-12 mt-1 mb-1 mx-1">
                                            <div class="row border border-1 border-dark rounded me-0">
                                                <?php

                                                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedback_data["user_email"] . "'");
                                                $user_data = $user_rs->fetch_assoc();

                                                ?>
                                                <div class="col-10 mt-1 mb-1 ms-0"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></div>
                                                <div class="col-2 mt-1 mb-1 me-0">
                                                    <?php
                                                    if ($feedback_data["type"] == 1) {
                                                    ?>
                                                        <span class="badge bg-success">Positive</span>
                                                </div>
                                            <?php
                                                    } else if ($feedback_data["type"] == 2) {
                                            ?>
                                                <span class="badge bg-warning">Neutral</span>
                                            </div>
                                        <?php
                                                    } else if ($feedback_data["type"] == 3) {
                                        ?>
                                            <span class="badge bg-danger">Negative</span>
                                        </div>
                                    <?php
                                                    }
                                    ?>

                                    <div class="col-12">
                                        <b>
                                            <?php echo $feedback_data["feedback"]; ?>
                                        </b>
                                    </div>
                                    <div class="offset-6 col-6 text-end">
                                        <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
                                    </div>
                                </div>
                            </div>
                        <?php
                                    }

                        ?>


                        </div>
                    </div>
                </div>

            </div>
            <?php include "footer.php" ?>


            </div>
            </div>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php
    } else {
        echo ("Sorry the Inconvenience");
    }
} else {
    echo ("Something Went Wrong");
}


?>