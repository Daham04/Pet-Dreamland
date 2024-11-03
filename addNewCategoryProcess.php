<?php 

session_start();
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["email"]) && isset($_POST["name"])){
    if($_SESSION["au"]["email"] == $_POST["email"]){

        $cname = $_POST["name"];
        $umail = $_POST["email"];

        $category_rs = Database::search("SELECT * FROM `category` WHERE `name` LIKE '%".$cname."%'");
        $category_num = $category_rs->num_rows;

        if($category_num == 0){

            $code = uniqid();
               
            Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$umail."'");

            //EMAIL CODE
  
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dahamn07@gmail.com';
            $mail->Password = 'nhbwlruwoinusvse';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('dahamn07@gmail.com', 'Admin Verificaion');
            $mail->addReplyTo('dahamn07@gmail.com', 'Admin Verificaion');
            $mail->addAddress($umail);
            $mail->isHTML(true);
            $mail->Subject = 'Pet Dreamland Admin Verification Code For Add New Category';
            $bodyContent = '<h1 style="color:green;">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;


            if(!$mail->send()){
                echo("Verification Code sending failed");
            }else{
                echo("Success");
            }

        }else{
            echo("This Category Already Exists");
        }

       //EMAIL CODE

    }else{
        echo("invalid User");
    }
}else{
    echo ("Something Missing");
}
