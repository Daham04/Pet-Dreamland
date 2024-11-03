<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice | Pet Dreamland</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/backgrounds/Pet Dreamland.svg" />
</head>

<body class="mt-2" style="background-color: #f7f7ff;">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";
            require "connection.php";

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];

            ?>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2"  onclick="printInvoice();"><i class="bi bi-printer-fill" ></i> Print</button>
                   
                </div>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12" id="page">
                    <div class="row">


                        <div class="col-6">
                            <div class="ms-5 invoiceHeaderImage"></div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-warning text-decoration-underline text-end">
                                    <h2>Pet Dreamland</h2>
                                </div>
                                <div class="col-12 fw-bold text-end">
                                    <span>Rajavidiya, kandy, Sri Lanka</span><br />
                                    <span>94812 4345569</span><br />
                                    <span>petdreamland@gmail.com</span><br />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-warning">
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="fw-bold">INVOICE TO :</h5>

                                    <?php
                                    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                    $address_data = $address_rs->fetch_assoc()
                                    ?>
                                    <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"] ?></h2>
                                    <span><?php echo $address_data["line1"] . " " . $address_data["line2"] ?></span><br>
                                    <span><?php echo $umail; ?></span>
                                </div>
                                <div class="col-6 text-end mt-4">

                                    <?php

                                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                    $invoice_data = $invoice_rs->fetch_assoc();

                                    ?>

                                    <h1 class="text-warning">INVOICE <?php echo $invoice_data["id"]; ?></h1>
                                    <span class="fw-bold">Date & Time of Invoice :</span>
                                    <span><?php echo $invoice_data["date"]; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">

                                <thead>
                                    <tr class="border border-1 border-secondary">
                                        <th>#</th>
                                        <th>Order id & Products</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr style="height: 72px;">
                                        <td class="bg-warning text-white fs-3 pt-3"><?php echo $invoice_data["id"]; ?></td>
                                        <td>
                                            <span class="fw-bold text-warning text-decoration-underline p-2"><?php echo $oid ?></span><br />
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $invoice_data["products_id"] . "' ");
                                            $product_data = $product_rs->fetch_assoc();
                                            ?>

                                            <span class="fw-bold text-warning fs-4 p-2"><?php echo $product_data["title"] ?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-end pt-4 text-dark"><?php echo $product_data["price"] ?></td>
                                        <td class="fw-bold fs-6 text-end pt-4"><?php echo $invoice_data["qty"]; ?></td>
                                        <td class="fw-bold fs-6 text-end pt-4 text-dark"><?php echo $invoice_data["total"]; ?></td>
                                    </tr>
                                </tbody>

                                <tfoot>

                                    <?php

                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();

                                    $delivery = 0;
                                    if ($city_data["district_id"] == 4) {
                                        $delivery = $product_data["delivery_fee_colombo"];
                                    } else {
                                        $delivery = $product_data["delivery_fee_other"];
                                    }
                                    $t = $invoice_data["total"];
                                    $g = $t - $delivery;
                                    ?>

                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                        <td class="text-end">Rs. <?php echo $g ?> .00</td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-dark">Delivery Fee</td>
                                        <td class="text-end border-dark">Rs. <?php echo $delivery; ?> .00</td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-dark text-dark">Full Amount</td>
                                        <td class="text-end border-dark text-dark fw-bold">Rs. <?php echo $t ?> .00</td>
                                    </tr>

                                </tfoot>

                            </table>
                        </div>

                       

                        
                        <div class="col-12">
                            <hr class="border border-1 border-warning">
                        </div>

                        
                    </div>
                </div>
            <?php
            }


            ?>

            <?php include "footer.php" ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>