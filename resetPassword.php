<?php

require "connection.php";

$email = $_POST["e"];
$np = $_POST["n"];
$rnp = $_POST["r"];
$vcode = $_POST["v"];

if (empty($email)) {
    echo ("Missing Email address");
} else if (empty($np)) {
    echo ("Please insert your New Password");
} else if (strlen($np) < 5 || (strlen($rnp) > 20)) {
    echo ("Invalid Password");
} else if (empty($rnp)) {
    echo ("Please Re-Type your New Password");
} else if ($np != $rnp) {
    echo ("Passwords does not matched");
} else if (empty($vcode)) {
    echo ("Please enter you Verification Code");
} else {

    $rs = Database::search("SELECT * FROM `user` 
    WHERE `email`='" . $email . "'AND `verification_code`='" . $vcode . "'");
    $n = $rs->num_rows;

    if ($n == 1) {
        Database::iud("UPDATE `user` SET `password`= '" . $np . "' WHERE `email`='" . $email . "'");
        echo ("Suceess");
    } else {
        echo ("Invalid Email or Verification Code");
    }
}
