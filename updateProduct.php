<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update My Product | Pet Dreamland</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/backgrounds/Pet Dreamland.svg" />

</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">
            <?php include "header.php";

            require "connection.php";

            if (isset($_SESSION["u"])) {

                if (isset($_SESSION["p"])) {

            ?>




                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 text-center">
                                <h2 class="h2 text-primary fw-bold">Update My Product</h2>
                            </div>

                            <div class="col-12">
                                <hr class="border border-primary" />
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 ">
                                        <div class="row">

                                            <div class="col-12 text-center">
                                                <label class="form-label fw-bold " style="font-size: 20px;">Select Product Category</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>
                                                    <?php
                                                    $product = $_SESSION["p"];

                                                    $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'");
                                                    $category_data = $category_rs->fetch_assoc();

                                                    ?>
                                                    <option><?php echo $category_data["name"]; ?></option>

                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12  mt-4">
                                        <div class="row">

                                            <div class="col-12 text-center">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Type</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>

                                                    <?php
                                                    $product = $_SESSION["p"];

                                                    $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN 
                                                    (SELECT `brand_id` FROM `brand_has_model` WHERE `id`='" . $product["brand_has_model_id"] . "')");
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                    ?>
                                                    <option><?php echo ($brand_data["name"]); ?></option>

                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 mt-4" disabled>
                                        <div class="row">

                                            <div class="col-12 text-center">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Model</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>
                                                    <?php
                                                    $product = $_SESSION["p"];

                                                    $model_rs = Database::search("SELECT * FROM `model` WHERE `id` IN 
                                                    (SELECT `model_id` FROM `brand_has_model` WHERE `id`='" . $product["brand_has_model_id"] . "')");
                                                    $model_data = $model_rs->fetch_assoc();

                                                    ?>

                                                    <option><?php echo $model_data["name"]; ?></option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border border-primary" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <label class="form-label fw-bold" style="font-size: 20px;" >
                                                    Add a Title to your Product
                                                </label>
                                            </div>
                                            <div class="offset-0 col-12 ">
                                                <input type="text" class="form-control text-center"  id="t" value="<?php echo $product["title"]; ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border border-primary" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-6 border-end border-dark">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                                    </div>

                                                    <?php

                                                    if ($product["condition_id"] == 1) {

                                                    ?>

                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline mx-5">
                                                                <input class="form-check-input" type="radio" id="b" name="c" checked disabled />
                                                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="u" name="c" disabled />
                                                                <label class="form-check-label fw-bold" for="u">Used</label>
                                                            </div>
                                                        </div>


                                                    <?php

                                                    } else {

                                                    ?>

                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline mx-5">
                                                                <input class="form-check-input" type="radio" id="b" name="c" checked disabled />
                                                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="u" name="c"  checked disabled />
                                                                <label class="form-check-label fw-bold" for="u">Used</label>
                                                            </div>
                                                        </div>


                                                    <?php

                                                    }





                                                    ?>


                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="number" class="form-control"  id="q" value="<?php echo $product["qty"]; ?>" min="0"/>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border border-primary" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" disabled value="<?php echo $product["price"]; ?>"/>
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                        <hr class="border border-primary" />
                                    </div>

                                            <div class="col-12 mt-2 text-center">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Approved Payment Methods</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                                            <div class="col-2 pm pm2"></div>
                                                            <div class="col-2 pm pm3"></div>
                                                            <div class="col-2 pm pm4"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border border-primary" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                            </div>
                                            <div class="col-12 col-lg-6 border-end border-dark">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">Delivery cost Within Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" id="dwc" class="form-control" value="<?php echo $product["delivery_fee_colombo"]; ?>"/>
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">Delivery cost out of Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" id="doc" class="form-control" value="<?php echo $product["delivery_fee_other"]; ?>" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border border-primary" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="30" rows="15" class="form-control" id="d"><?php echo $product["description"]?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border border-primary" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6">
                                                        <?php 
                                                        
                                                        $img = array();
                                                        $img [0] = "resources/common.jpg";
                                                        $img [1] = "resources/common.jpg";
                                                        $img [2] = "resources/common.jpg";

                                                        $images_rs = Database::search("SELECT * FROM `images` WHERE `products_id`='".$product["id"]."'");
                                                        $images_num = $images_rs->num_rows;

                                                        for($x = 0; $x < $images_num; $x++){
                                                            $images_data = $images_rs->fetch_assoc();
                                                            $img [$x] = $images_data["code"];
                                                        }
                                                        
                                                        
                                                        ?>
                                                <div class="row">
                                                    <div class="col-4 border border-dark rounded">
                                                        <img src="<?php echo $img [0]; ?>" class="img-fluid" style="width: 250px;" id="i0" />
                                                    </div>
                                                    <div class="col-4 border border-dark rounded">
                                                        <img src="<?php echo $img [1]; ?>" class="img-fluid" style="width: 250px;" id="i1"/>
                                                    </div>
                                                    <div class="col-4 border border-dark rounded">
                                                        <img src="<?php echo $img [2]; ?>" class="img-fluid" style="width: 250px;" id="i2"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                                <input type="file" class="d-none" id="imageuploader" multiple  />
                                                <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border border-primary" />
                                    </div>

                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                        <button class="btn btn-success" onclick="updateProduct();">Update Product</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

            <?php

                } else {
                    header("Location:myProducts.php");
                }
            } else {
                header("Location:home.php");
            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>