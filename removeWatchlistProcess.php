<?php

require "connection.php";

if(isset($_GET["id"])){

    $wid = $_GET["id"];

    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `id`='".$wid."'");
    $watch_num = $watch_rs->num_rows;
    $watch_data = $watch_rs->fetch_assoc();

    if($watch_num == 0){
        echo("Something went wrong. Please try agin later.");
    }else{

        Database::iud("INSERT INTO `recent`(`products_id`,`user_email`)VALUES 
        ('".$watch_data["products_id"]."','".$watch_data["user_email"]."') ");

        Database::iud("DELETE FROM `watchlist` WHERE `id`='".$wid."'");

        echo("Success");

    }

}else{
    echo("Please Select a Product");
}

?>