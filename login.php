<?php
    if(isset($_POST['submit'])){
       $conn=mysqli_connect('localhost','root','','ecommerce');
       $a=$_POST['email'];
       $b=$_POST['pswd'];
       $result=$conn->query("select * from users where email='$a' and password='$b' ");
       if(mysqli_fetch_row($result)){
        session_start();
        $_SESSION['email']=$a;
        echo "<script type='text/javascript'>alert('Login successfull');</script>";
        $rs=$conn->query("Select * from recent_login where email='{$a}'");
        if(mysqli_num_rows($rs)>=1){
            $t_d=date("Y-m-d");
            $conn->query("Update recent_login set curr_date='$t_d' where email='{$a}'");
        }
        else{
            $t_d=date("Y-m-d");
           $conn->query("Insert into recent_login(email,curr_date) values('$a','$t_d')"); 
        }
        header('Location:all_products.php');
    } else{
        echo "<script type='text/javascript'>alert('Login failed!please try again');</script>";

    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('images\\sales-concept-with-cart-alarm-bags.jpg') no-repeat center center/cover;
        }
        .container {
            background: yellow;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
            margin-left: 50%;
            
        }
        .container h1 {
            color: #fff;
            margin-bottom: 20px;
            background: #667eea;
            padding: 15px;
            border-radius: 6px;
            width: 100%;
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .input-group label {
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        .btn {
            width: 60%;
            background: #667eea;
            color: white;
            border: none;
            padding: 8px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover {
            background: #764ba2;
        }
        @media (max-width: 400px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign In</h1>
        <form action="login.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your Email">
            </div>
            <div class="input-group">
                <label for="pswd">Password</label>
                <input type="password" id="pswd" name="pswd" required placeholder="Enter your Password">
            </div>
            <button type="submit" name="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>