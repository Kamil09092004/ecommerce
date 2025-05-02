<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        .navbar ul li {
            padding: 15px 20px;
            margin: 0 10px;
            background: #0056b3;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }
        .navbar ul li:hover {
            background: #003f80;
            transform: scale(1.1);
        }
        .content {
            padding: 40px;
            text-align: center;
        }
        .search-container {
            margin: 20px auto;
            width: 50%;
            position: relative;
        }
        .search-container input {
            width: 100%;
            padding: 12px;
            border: 2px solid #007bff;
            border-radius: 25px;
            font-size: 16px;
            text-align: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }
        .search-container input:hover {
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }
        .order-section {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            margin-top: 30px;
        }
        .vertical-line {
            width: 2px;
            height: 250px;
            background: #007bff;
            position: relative;
        }
        .vertical-line::before {
            content: "OR";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 5px 10px;
            font-weight: bold;
            color: #007bff;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-right: 40px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 250px;
            transition: box-shadow 0.3s;
        }
        .form-container:hover {
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }
        .form-container label {
            font-weight: bold;
        }
        .form-container input, .form-container select, .form-container button {
            padding: 10px;
            border: 2px solid #007bff;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container button {
            background: #007bff;
            color: white;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }
        .form-container button:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
        .qrcode-container {
            background: white;
            border-radius: 10px;
            margin-left: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }
        .qrcode-container:hover {
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }
        .qrcode-container img {
            width: 220px;
            height: 220px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li onclick="location.href=\'add_product.php\'">Add Product</li>
            <li onclick="location.href=\'add_category.php\'">Add Category</li>
            <li onclick="location.href=\'manage_tracking.php\'">Manage Tracking</li>
            <li onclick="location.href=\'notifications.php\'">Notifications</li>
            <li onclick="location.href=\'orders.php\'">Orders</li>
        </ul>
    </div>
    <div class="content">
        <div class="search-container">
            <form action="manage_tracking.php" method="get"><input type="text" name="order_id" placeholder="Enter Order ID"></form>
        </div>';
        if(isset($_GET['order_id'])){
        echo'<div class="order-section">
        <form action="log_track.php" method="get">
            <div class="form-container">
                <label style="text-align: left;">Place:</label>
                <input type="text" placeholder="Enter Place" name="place" required>
                <label style="text-align: left;">Status:</label>
                <select name="status">
                    <option>Order Received</option>
                    <option>Dispatched</option>
                    <option>Processing</option>
                    <option>Out for delivery</option>
                </select>
                <button type="submit" name="sub_log" value='.$_GET['order_id'].'>Submit</button>
            </div>
        </form>
        
            <div class="vertical-line"></div>
            <div class="qrcode-container">';
                $ipAddress = $_SERVER['REMOTE_ADDR'];
                $link = urlencode("{$ipAddress}:8080/ecommerce/log_track.php?order_id={$_GET['order_id']}");
                $size = 300;
                $qrcode_url = "https://quickchart.io/qr?text={$link}&size={$size}";
                echo "<img src='$qrcode_url' />";
        }
echo '        </div>
        </div>
    </div>
</body>
</html>';
?>
