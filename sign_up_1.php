<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 40px;
            padding-top: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            width: 90%;
            margin-top: 0px;
            color: #fff;
            background-color: #007BFF;
            padding: 15px;
            border-radius: 5px;
        }
        .input-group {
            margin: 15px 0;
            text-align: left;
        }
        label {
            font-weight: bold;
            font-size: 14px;
            display: block;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }
        input:focus {
            border-color: #007BFF;
        }
        .btn {
            background: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 80%;
            margin-top: 15px;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form action="sign_up_1.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="input-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div class="input-group">
                <label for="mobile">Mobile No</label>
                <input type="tel" pattern="[0-9]{10}" id="mobile" name="mobile" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn" name="verify">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php'; // Load PHPMailer
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST['verify'])){
    if(strlen($_POST['mobile'])==10){
    session_start();

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $org_email="shaik.kamilahmed123@gmail.com";
        $app_password='tktbggdikkzpjrfg';
        $contact_query_mobile="MOBILE NUMBER FOR QUERY";




        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = $org_email; 
        $mail->Password = $app_password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Email details

        $mail->isHTML(true);
        $name=$_POST['first_name']." ".$_POST['last_name'];
        $_SESSION['name']=$name;
        $mail->setFrom($org_email);
        $mail->addAddress($_POST['email']);
        $mail->Subject = 'OTP for registration';
        $a=rand(10000,99999);
        $mail->Body    = "
        <p><strong>Dear {$name},</strong></p>
        <p>Thank you for registering with <strong>EZ Mart Store</strong>! To complete your registration, please use the following <strong>One-Time Password (OTP):</strong></p>
        <h2 style='color: #2d89ef;'>🔐 $a</h2><br>
        <h3>📌 Registered Details:</h3>
        <p>📛 <strong>Name:</strong> {$name}</p>
        <p>📱 <strong>Mobile Number:</strong> {$_POST['mobile']}</p>
        <hr>
        <p>If you did not request this OTP, please ignore this email.</p>
        <p>For any assistance, contact our support:</p>
        <p> 📞{$contact_query_mobile}</p>
        <p>Best Regards,</p>
        <p><strong>EZ Mart Team</strong></p>
        <p>🌐 <a href=''>NO URL YET</a></p>
    ";
        
        $mail->send();
        $_SESSION['name']=$name;
        $_SESSION['mobile']=$_POST['mobile'];
        $_SESSION['email']=$_POST['email'];
        $_SESSION['otp']=$a;
        header('Location:sign_up_2.php');
    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}
    }
?>
