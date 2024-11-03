<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Sign In | Pet Dreamland</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/backgrounds/Pet Dreamland.svg" />
</head>

<body style="background-color: burlywood;">
    <div class="container-fluid justify-content-center" style="margin-top: 100px;">
        <div class="row align-content-center">

            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12 ">
                        <p class="text-center title1">Admin Sign In</p>
                    </div>
                </div>
            </div>
            <div class="col-12 p-5">
                <div class="row">

                    <div class="col-12  col-lg-6 d-block offset-lg-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="title2">Sign In to your Account</p>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="e">
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="adminVerification();">Send Verification Code</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="window.location = 'index.php';">Back to Customer Log In</button>
                            </div>
                        </div>
                    </div>

                    <!-- modal  -->

                    <div class="modal" tabindex="-1" id="verificatioModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Admin Verification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <label class="form-label">Enter Your Verification Code</label>
                                   <input type="text" class="form-control" id="vcode">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal -->

                    <div class="col-12 fixed-bottom text-center">
                        <p>&copy;2023 Pet Dreamland | All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>