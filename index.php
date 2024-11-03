
<?php
session_start();

$_SESSION["u"] = "email";

if(empty("u")){
    ?>

    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Pet Dreamland</title>
    
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="icon" href="resources/backgrounds/Pet Dreamland.svg" />
    
    </head>
    
    <body class="main-body">
    
        <div class="container-fluid vh-100 d-flex justify-content-center">
            <div class="row align-content-center">
    
                <!-- header -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 logo col"></div>
                        <div class="col-12">
                            <p class="text-center title1">Hi, Join With Pet Dreamland</p>
                        </div>
                    </div>
                </div>
                <!-- header -->
    
                <!-- content -->
                <div class=" col-12 d-none" id="msgdiv">
                    <div class="alert alert-danger" role="alert" id="alertdiv">
                        <i class="bi bi-x-octagon-fill fs-6" id="msg">
    
                        </i>
    
                    </div>
                </div>
                <div class="col-12 p-3">
    
                    <div class="row">
    
    
    
                        <div class="offset-lg-3 col-12 col-lg-6" id="signUpBox">
                            <div class="row g-2">
                                <div class="col-12">
                                    <p class="title2">Register</p>
                                </div>
    
    
                                <div class="col-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="d" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="o" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="e" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" id="p" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="m" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Gender</label>
                                    <select class="form-select" id="g">
                                        <?php
                                        require "connection.php";
    
                                        $gender_rs = Database::search("SELECT * FROM `gender`");
                                        $gender_num = $gender_rs->num_rows;
    
                                        for ($x = 0; $x < $gender_num; $x++) {
                                            $gender_data = $gender_rs->fetch_assoc();
    
    
                                        ?>
                                            <option value="<?php echo $gender_data["id"] ?>"><?php echo $gender_data["gender_name"] ?></option>
                                        <?php
                                        }
    
    
                                        ?>
    
    
                                    </select>
                                </div>
    
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-dark" onclick="changeView();">Already have an account? Sign In</button>
                                </div>
    
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-primary fw-bold" onclick="signUp();">Sign Up</button>
                                </div>
                            </div>
                        </div>
    
                        <div class="offset-lg-3 col-12 col-lg-6 d-none" id="signInBox">
                            <div class="row g-2">
                                <div class="col-12">
                                    <p class="title2">Sign In</p>
    
                                </div>
                                <?php
                                $email = "";
                                $password = "";
    
                                if (isset($_COOKIE["email"])) {
                                    $email = $_COOKIE["email"];
                                }
    
                                if (isset($_COOKIE["password"])) {
                                    $password = $_COOKIE["password"];
                                }
    
                                ?>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailsignin" value="<?php echo ($email); ?>" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" id="passwordsignin" value="<?php echo ($password); ?>" />
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remembermes" />
                                        <label class="form-check-lable">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password</a>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-primary" onclick="signIn();">Sign In</button>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-success" onclick="adminsignIn();">Admin Sign In</button>
                                </div>
                                <div class="col-12 d-grid">
                                    <button class="btn btn-danger" onclick="changeView();">New to member? Join Now</button>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
                <!-- content -->
    
                <!-- modal -->
                <div class="modal" tabindex="-1" id="forgotPasswordModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reset Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
    
                                    <div class="col-6">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="npi">
                                            <button class="btn btn-outline-secondary" type="button" id="npb" onclick="ShowPassword();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <label class="form-label">Re-type Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="rnp">
                                            <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                                        </div>
                                    </div>
    
                                    <div class="col-12">
                                        <label class="form-label">Verrification Code</label>
                                        <input type="password" class="form-control" id="vc">
                                    </div>
    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
    
    
    
                <!-- footer -->
    
                <div class="col-12 fixed-bottom d-none d-lg-block">
                    <p class="text-center">&copy; 2023 Pet Dreamland.lk || All Right Reserved</p>
                </div>
    
                <!-- footer -->
    
            </div>
        </div>
    
        <script src="bootstrap.js"></script>
        <script src="script.js"></script>
    </body>
    
    </html>

    <?php
}else{
    header("Location:index.php");
}

