<?php

require "connection.php";

if(isset($_GET["id"])){

    $cid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `id`='".$cid."'");
    $cart_data = $cart_rs->fetch_assoc();

    $user = $cart_data["user_email"];
    $product = $cart_data["products_id"];

    Database::iud("INSERT INTO `recent` (`products_id`,`user_email`) VALUES('".$product."','".$user."')");

    Database::iud("DELETE FROM `cart` WHERE `id`='".$cid."'");

    echo ("Success");

}else{
    echo("Something Went Wrong");
}

?>