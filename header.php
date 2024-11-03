<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="shopbackground">

    <div class="col-12 ">
        <div class="row mt-1 mb-1 ">

            <div class="offset-lg-1 col-12 col-lg-4 align-self-start mt-2">

                <?php

                session_start();

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];

                ?>
                    <span class="text-lg-start cate4"><b>Welcome </b><?php echo ($data["fname"]); ?></span> 


                <?php

                } else {


                ?>
                    <a href="signin.php" class="text-decoration-none fw-bold">Sign In or Register</a>

                <?php

                }

                ?>

            </div>

            <div class="offset-lg-4 col-12 col-lg-3 align-self-end ">
                <div class="row">

                <div class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon cart" onclick="window.location='cart.php';"></div>
                    
                    <div class="col-1 col-lg-3 mt-2">
                        <a class="dropdown-item" href="watchlist.php"><i class="bi bi-heart-fill" style="font-size: 20px;"></i></a>
                    </div>


                    <div class="col-2 col-lg-6 dropdown mt-2 shopbackground">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          View More
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="userProfile.php">My Acoount</a></li>
                            <li><a class="dropdown-item" href="myproducts.php">My Products</a></li>
                            <li><a class="dropdown-item" href="purchasedHistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item"  onclick="signout();">Sign Out</a></li>
                        </ul>
                    </div>

                    


                    <!-- msg modal -->
                    <div class="modal" tabindex="-1" id="contactAdmin">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contact Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body overflow-scroll">
                                    <!-- received -->
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-8 rounded bg-success">
                                                <div class="row">
                                                    <div class="col-12 pt-2">
                                                        <span class="text-white fw-bold fs-4">Hello there!!!</span>
                                                    </div>
                                                    <div class="col-12 text-end pb-2">
                                                        <span class="text-white fs-6">2022-11-9 00:00:00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- received -->

                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="offset-4 col-8 rounded bg-primary">
                                                <div class="row">
                                                    <div class="col-12 pt-2">
                                                        <span class="text-white fw-bold fs-4">hello </span>
                                                    </div>
                                                    <div class="col-12 text-end pb-2">
                                                        <span class="text-white fs-6">2022-11-17 02:05:33</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                                <div class="modal-footer">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="msgtxt" />
                                            </div>
                                            <div class="col-3 d-grid">
                                                <button type="button" class="btn btn-primary" onclick="sendAdminMsg();">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->


                </div>
            </div>

        </div>
    </div>

    <script src="bootstrap.js"></script>

    
    <script src="script.js"></script>
</body>

</html>