<?php
 session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users | Pet Dreamland</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/backgrounds/Pet Dreamland.svg" />
</head>

<body style="background-color: burlywood;">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 text-center" style="background-color: burlywood;">
                <label class="form-label text-dark fw-bold fs-1">Manage All Users</label>
            </div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-light py-2 text-end">
                        <span class="fs-4 fw-bold text-dark">#</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>
                    <div class="col-4 col-lg-2 bg-light py-2">
                        <span class="fs-4 fw-bold text-dark">User Name</span>
                    </div>
                    <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Email</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold text-dark">Mobile</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-2 col-lg-1 bg-white"></div>
                </div>
            </div>

            <?php

            $query = "SELECT * FROM `user`";
            $pageno;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $user_rs = Database::search($query);
            $user_num = $user_rs->num_rows;

            $results_per_page = 20;
            $number_of_pages = ceil($user_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

            ?>
                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-light py-2 text-end">
                            <span class="fs-4 text-dark"><?php echo $x + 1; ?></span>
                        </div>

                        <?php

                        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` ='" . $selected_data["email"] . "' ");
                        $img_data = $img_rs->fetch_assoc();


                        if (empty($img_data["path"])) {
                        ?>

                            <div class="col-2 d-none d-lg-block bg-light py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                                <img src="resources/profile_img/newuser1.svg" style="height: 40px;margin-left: 80px;" />
                            </div>

                        <?php
                        } else {
                        ?>
                            <div class="col-2 d-none d-lg-block bg-light py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                                <img src="<?php echo $img_data["path"] ?>" style="height: 40px;margin-left: 80px;" />
                            </div>
                        <?php
                        }
                        ?>



                        <div class="col-4 col-lg-2 bg-light py-2">
                            <span class="fs-5 text-dark"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span>
                        </div>
                        <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                            <span class="fs-6 "><?php echo $selected_data["email"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2">
                            <span class="fs-5 text-dark"><?php echo $selected_data["mobile"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2">
                            <span class="fs-5 "><?php echo $selected_data["joined_date"]; ?></span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white py-2 d-grid">
                            <?php

                            if ($selected_data["status"] == 1) {
                            ?>
                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                            <?php

                            }

                            ?>

                        </div>
                    </div>
                </div>
                <!-- msg modal -->
                <div class="modal" tabindex="-1" id="userMsgModal<?php echo $selected_data["email"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body overflow-scroll">

                                <?php

                                $chat_rs = Database::search("SELECT * FROM `chat` WHERE `from` = '" . $_SESSION["au"]["email"] . "'
                                OR `to` = '" . $_SESSION["au"]["email"] . "' ORDER BY `date_time` ASC");
                                $chat_num = $chat_rs->num_rows;


                                for ($y = 0; $y < $chat_num; $y++) {
                                    $chat_data = $chat_rs->fetch_assoc();

                                    if ($chat_data["from"] == $selected_data["email"]) {
                                ?>
                                        <!-- received -->
                                        <div class="col-12 mt-2">
                                            <div class="row">
                                                <div class="col-8 rounded bg-success">
                                                    <div class="row">
                                                        <div class="col-12 pt-2">
                                                            <span class="text-white fw-bold fs-4"><?php echo $chat_data["content"] ?></span>
                                                        </div>
                                                        <div class="col-12 text-end pb-2">
                                                            <span class="text-white fs-6"><?php echo $chat_data["date_time"] ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- received -->
                                    <?php
                                    } else if ($chat_data["to"] == $selected_data["email"]) {
                                    ?>
                                        <!-- sent -->
                                        <div class="col-12 mt-2">
                                            <div class="row">
                                                <div class="offset-4 col-8 rounded bg-secondary">
                                                    <div class="row">
                                                        <div class="col-12 pt-2">
                                                            <span class="text-white fw-bold fs-4"><?php echo $chat_data["content"] ?></span>
                                                        </div>
                                                        <div class="col-12 text-end pb-2">
                                                            <span class="text-white fs-6"><?php echo $chat_data["date_time"] ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- sent -->
                                <?php
                                    }
                                }


                                ?>




                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="msgtxt" />
                                        </div>
                                        <div class="col-3 d-grid">
                                            <button type="button" class="btn btn-primary" onclick="sendAdminMsg('<?php echo $selected_data['email'] ?>');">Send</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- msg modal -->
            <?php

            }

            ?>

            <!--  -->
            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php

                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }

                        ?>

                        <li class="page-item">
                            <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!--  -->



        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>