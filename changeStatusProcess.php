<?php

require "connection.php" ;

$product = $_GET["p"];

$product_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$product."'");
$product_num = $product_rs->num_rows;

if($product_num == 1){

    $product_data = $product_rs->fetch_assoc();
    $status = $product_data["status_id"];

    if($status == 1){
        Database::iud("UPDATE `products` SET `status_id`='2' WHERE `id`='".$product."'");
        echo("Deactivated");
    }else if($status == 2){
        Database::iud("UPDATE `products` SET `status_id`='1' WHERE `id`='".$product."'");
        echo("Activated");
    }
}else{
    echo("Something Went Wrong Please Try Again Later");
}

?>