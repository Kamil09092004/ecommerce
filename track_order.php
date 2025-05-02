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
            padding: 20px;
        }
        h2 {
            text-align: center;
            background: #3498db;
            color: white;
            padding: 15px;
            border-radius: 8px;
        }
        form {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        input {
            width: 300px;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        button {
            padding: 12px 20px;
            border: none;
            background: #1abc9c;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #16a085;
            transform: scale(1.05);
        }
        .container {
            display: flex;
            justify-content: center;
            width: 90%;
            margin-left: 5%;
            margin-top: 20px;
        }
        #order-details {
            width: 50%;
            padding: 20px;
            background: white;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: left;
            margin-right: 20px;
            float: right;
            height:fit-content;
        }
        #logs {
            width: 50%;
            padding: 20px;
            background: white;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            float: right;
            text-align: left;
        }
        .log-entry {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .log-entry:last-child {
            border-bottom: none;
        }
        strong{
            display: inline-block;
            width: 30%;
        }
        #cus_det{
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div id='sidebar'>
        <a href="all_products.php"><h2>Menu</h2></a><br>
        <a href="profile.php">My Profile</a>
        <a href="track_order.php" style="background-color: #1abc9c;">Track Order</a>
        <a href="notification.php">Notifications</a>
        <a href="chatbot.php">Contact</a>
        <a href="?logout=true">Sign Out</a>
    </div>
    <div id="main">
        <h2>Track Order</h2>
        <form action="" method="get">
            <input type="number" name="order_id" required placeholder="Enter your order ID...">
            <button type="submit">Submit</button>
        </form>
        <div class="container">
            <div id="order-details">
                <h3>Order Details</h3><br><hr><br>
                <?php
                        if(isset( $_GET['order_id'])){
                            $order_id = $_GET['order_id'];
                            $conn=mysqli_connect('localhost','root','','ecommerce');
                            $r=$conn->query("select * from orders where order_id={$order_id}");
                            if($row=mysqli_fetch_assoc($r)){
                            echo "<p id='cus_det'><strong>Order ID</strong>:" . $row['order_id'] . "</p>";
                            echo "<p id='cus_det'><strong>Customer Name</strong>:".$row['name']." </p>";
                            $nm=mysqli_fetch_assoc($conn->query("select name from products where p_id={$row['p_id']}"))['name'];
                            echo "<p id='cus_det'><strong>Product</strong>:".$nm."</p>";
                            echo "<p id='cus_det'><strong>district</strong>:" . $row['district'] . "</p>";
                            echo "<p id='cus_det'><strong>City</strong>:" . $row['city'] . "</p>";
                            echo "<p id='cus_det'><strong>Area</strong>:" . $row['area'] . "</p>";
                            echo "<p id='cus_det'><strong>Land mark</strong>:" . $row['landmark'] . "</p>";
                            echo "<p id='cus_det'><strong>Mobile</strong>:" . $row['mobile'] . "</p>";

                        }
                    }
                ?>
            </div>
            <div id="logs">
                <h3>Order Logs</h3>
                <?php
                    if (isset($_GET['order_id'])) {
                        $order_id = $_GET['order_id'];
                        $conn=mysqli_connect('localhost','root','','ecommerce');
                        $res=$conn->query("Select * from logs where order_id=$order_id");
                        echo"<br><hr><br>";
                        while($rw=mysqli_fetch_assoc($res)){
                            echo "<strong>Place:</strong> " . $rw['place'] . "<br>";
                            echo "<strong>Date:</strong> " . $rw['date'] . "<br>";   
                            echo "<strong>Status:</strong> " . $rw['status'] . "<br><br><hr>";
                            #echo "<strong>Place:</strong> " . $order_id . "<br>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>