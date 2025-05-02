<?php
session_start(); // Start the session

// Check if the user clicked on the "Sign Out" link
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: login.php"); // Redirect to the login page
    exit(); // Ensure no further code is executed
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }
        #sidebar {
            width: 15%;
            background-color: #2c3e50;
            color: white;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }
        #sidebar a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            padding: 12px;
            display: block;
            text-align: center;
            width: 100%;
            border-radius: 5px;
            transition: 0.3s;
            margin-top: 10px;
        }
        #sidebar a:hover {
            background-color: #1abc9c;
        }
        #main {
            width:85%;
            padding: 40px;
        }
        h2 {
            text-align: center;
            background: #3498db;
            color: white;
            padding: 15px;
            border-radius: 8px;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .form-group {
            width: 48%;
        }
        label {
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus {
            outline: none;
            border-color: #3498db;
        }
        #submit {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px;
            margin-top: 15px;
            width: 60%;
            margin-left: 20%;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }
        #submit:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div id='sidebar'>
        <a href="all_products.php"><h2>Menu</h2></a><br>
        <a href="profile.php" style="background-color: #1abc9c;">My Profile</a>
        <a href="track_order.php">Track Order</a>
        <a href="notification.php">Notifications</a>
        <a href="chatbot.php">Contact</a>
        <a href="?logout=true">Sign Out</a>
    </div>
    <div id="main">
        <h2>My Profile</h2>
        <form action="profile.php" method="post" enctype="multipart/form-data">
            <?php
            $conn=mysqli_connect('localhost','root','','ecommerce');
            $result=$conn->query("select * from users where email='{$_SESSION['email']}'");
            if($row=mysqli_fetch_assoc($result)){
            echo'<div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required readonly autocomplete="off" value="'.$row["name"].'"/>
            </div>';
            echo'<div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required readonly autocomplete="off" value="'.$row["email"].'"/>
            </div>';
            echo'<div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="number" id="mobile" name="mobile" required autocomplete="off" value="'.$row["mobile"].'"/>
            </div>';
            echo'<div class="form-group">
                <label for="us_name">User Name</label>
                <input type="text" id="us_name" name="us_name" required autocomplete="off" value="'.$row["username"].'"/>
            </div>';
            echo'<div class="form-group">
                <label for="district">District</label>
                <select id="district" name="district">
                    <option value="SPSR Nellore" '.($row["district"] == "SPSR Nellore" ? "selected" : "").'>SPSR Nellore</option>
                    <option value="Anantapur" '.($row["district"] == "Anantapur" ? "selected" : "").'>Anantapur</option>
                    <option value="Srikakulam" '.($row["district"] == "Srikakulam" ? "selected" : "").'>Srikakulam</option>
                    <option value="East Godavari" '.($row["district"] == "East Godavari" ? "selected" : "").'>East Godavari</option>
                    <option value="West Godavari" '.($row["district"] == "West Godavari" ? "selected" : "").'>West Godavari</option>
                    <option value="Krishna" '.($row["district"] == "Krishna" ? "selected" : "").'>Krishna</option>
                    <option value="Guntur" '.($row["district"] == "Guntur" ? "selected" : "").'>Guntur</option>
                    <option value="Prakasam" '.($row["district"] == "Prakasam" ? "selected" : "").'>Prakasam</option>
                    <option value="Vizianagaram" '.($row["district"] == "Vizianagaram" ? "selected" : "").'>Vizianagaram</option>
                    <option value="Visakhapatnam" '.($row["district"] == "Visakhapatnam" ? "selected" : "").'>Visakhapatnam</option>
                    <option value="Kurnool" '.($row["district"] == "Kurnool" ? "selected" : "").'>Kurnool</option>
                    <option value="Chittoor" '.($row["district"] == "Chittoor" ? "selected" : "").'>Chittoor</option>
                    <option value="Kadapa" '.($row["district"] == "Kadapa" ? "selected" : "").'>Kadapa</option>
                </select>
            </div>';
            echo'<div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required autocomplete="off" value="'.$row['city'].'"/>
            </div>';
            echo'<div class="form-group">
                <label for="area">Area</label>
                <input type="text" id="area" name="area" required autocomplete="off" value="'.$row['area'].'"/>
            </div>';
            echo'<div class="form-group">
                <label for="land_mark">Location</label>
                <input type="text" id="land_mark" name="landmark" required autocomplete="off" value="'.$row['landmark'].'"/>
            </div>';
            echo'<div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="off" value="'.$row['password'].'"/>
            </div>';
            }
            ?>
            <input type="submit" id='submit' name='update' value="Update"/>
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST['update'])){
        $conn=mysqli_connect('localhost','root','','ecommerce');

        // Prepare and bind
        $stmt = $conn->prepare("update users set name=?, mobile=?, username=?, district=?, city=?, area=?, landmark=?, password=? where email=?");
        $stmt->bind_param("sssssssss", $name, $mobile, $us_name, $district, $city, $area, $landmark, $password, $email);

        // Set parameters and execute
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $us_name = $_POST['us_name'];
        $district = $_POST['district'];
        $city = $_POST['city'];
        $area = $_POST['area'];
        $landmark = $_POST['landmark'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        // Execute the statement
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Profile updated successfully.');</script>";
        } else {
            echo "<script>alert('No changes made');</script>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
?>
        