<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    if(isset($_GET["id"])){

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `products_id`='".$pid."' AND `user_email`='".$email."'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$pid."'");
        $product_data = $product_rs->fetch_assoc();
        $product_qty = $product_data["qty"];

        if($cart_num == 1){

            $cart_data = $cart_rs->fetch_assoc();
            $current_qty = $cart_data["qty"];
            $new_qty = (int)$current_qty + 1;

            if($product_qty >= $new_qty){

                Database::iud("UPDATE `cart` SET `qty`='".$new_qty."' WHERE `products_id`='".$pid."' AND `user_email`='".$email."'");
                echo("Produt Updated");


            }else{
                
              echo("Invalid quantity");

            }

        }else{

            Database::iud("INSERT INTO `cart`(`products_id`,`user_email`,`qty`) VALUES ('".$pid."','".$email."','1')");
            echo("product added successfully");
            
        }

    }else{
        echo("Something Went Wrong");
    }

}else{
    echo("Please Sign In or Register.");
}

?>