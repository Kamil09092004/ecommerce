<?php
    if(isset($_POST['submit'])){
        session_start();
        if($_POST['con_password']==$_POST['password']){
        try{
            $a=$_SESSION['name'];
            $b=$_SESSION['email'];
            $c=$_SESSION['mobile'];
            $d=$_POST['us_name'];
            $e=$_POST['district'];
            $f=$_POST['city'];
            $g=$_POST['area'];
            $h=$_POST['address'];
            $i=$_POST['password'];
        $conn=mysqli_connect('localhost','root','','ecommerce');
        $query="insert into users(name,email,mobile,username,district,city,area,landmark,password) values('$a','$b','$c','$d','$e','$f','$g','$h','$i')";
        $res=$conn->query($query);
        $conn->query("ALTER TABLE seq_product ADD COLUMN `$b` INT NOT NULL DEFAULT 0");
        if($res){
            echo "<script type='text/javascript'>alert('Registration sucessfull');</script>";
            header('Location:login.php');
        }else{
            echo "<script type='text/javascript'>alert('Registration failed!please try again');</script>";
            session_destroy();
            header('Loation:sign_up_1.php');
        }
        }catch(Exception){
            session_destroy();
            echo "<script type='text/javascript'>alert('Registration failed!please ente valid details!!');</script>";
        }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 1000px;
        }
        h1 {
            text-align: center;
            color: white;
            background-color: #396fbf;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 10px 10px 0 0;
        }
        .form-group {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }
        .form-group div {
            width: 48%;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #396fbf;
            box-shadow: 0px 0px 5px rgba(57, 112, 191, 0.5);
        }
        .btn {
            width: 60%;
            background-color: #396fbf;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            margin-left: 20%;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #2d5ca8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action='sign_up.php' method="post">
            <div class="form-group">
                <div>
                    <label for='us_name'>User Name</label>
                    <input type='text' id='us_name' name='us_name' placeholder="Enter your username" required />
                </div>
                <div>
                    <label for="district">District</label>
                    <select id="district" name="district" required>
                        <option value="">Select District</option>
                        <option value="SPSR Nellore">SPSR Nellore</option>
                        <option value="Anantapur">Anantapur</option>
                        <option value="Srikakulam">Srikakulam</option>
                        <option value="East Godavari">East Godavari</option>
                        <option value="West Godavari">West Godavari</option>
                        <option value="Krishna">Krishna</option>
                        <option value="Guntur">Guntur</option>
                        <option value="Prakasam">Prakasam</option>
                        <option value="Vizianagaram">Vizianagaram</option>
                        <option value="Visakhapatnam">Visakhapatnam</option>
                        <option value="Kurnool">Kurnool</option>
                        <option value="Chittoor">Chittoor</option>
                        <option value="Kadapa">Kadapa</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="city">City</label>
                    <input type="text" id='city' name='city' placeholder="Enter city name" required />
                </div>
                <div>
                    <label for="area">Area</label>
                    <input type="text" id="area" name='area' placeholder="Enter area name" required />
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for='land_mark'>Landmark</label>
                    <input type='text' id='land_mark' name='address' placeholder="Door No, Landmark" required />
                </div>
                <div>
                    <label for='password'>Password</label>
                    <input type="password" id='password' name='password' placeholder="Enter password" required />
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for='con_password'>Confirm Password</label>
                    <input type="password" name='con_password' id='con_password' placeholder="Confirm password" required />
                </div>
            </div>
            <button type="submit" name='submit' class="btn">Register</button>
        </form>
    </div>
</body>
</html>
