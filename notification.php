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
    <title>Notification</title>
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
            width: 82%;
            padding: 40px;
        }
        h2 {
            text-align: center;
            background: #2980b9;
            color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        #notification-form {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .notification {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            background: #fdfdfd;
            transition: 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .notification:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .notification img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
            margin-right: 20px;
            object-fit: cover;
        }
        .notification-content {
            flex-grow: 1;
        }
        .notification-content p {
            margin: 5px 0;
            font-size: 17px;
        }
        .notification-content a {
            text-decoration: none;
            color: #3498db;
            font-size: 16px;
            font-weight: bold;
        }
        .notification-content a:hover {
            text-decoration: underline;
        }
        #img_but {
            background-color: transparent;
            cursor: pointer;
            border: none;
        }
    </style>
</head>
<body>
    <div id='sidebar'>
        <a href="all_products.php"><h2>Menu</h2></a><br>
        <a href="profile.php">My Profile</a>
        <a href="track_order.php">Track Order</a>
        <a href="notification.php" class="active" style="background-color: #1abc9c;">Notifications</a>
        <a href="chatbot.php">Contact</a>
        <a href="?logout=true">Sign Out</a>
    </div>
    <div id="main">
        <h2>Notifications</h2>
        <div id="notification-form">
            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'ecommerce');
            $re = $conn->query("SELECT * FROM notification WHERE from_email='{$_SESSION['email']}' OR to_email='{$_SESSION['email']}' ");
            while ($rw = mysqli_fetch_assoc($re)) {
                if($rw['type']==0){
                echo '<form method="POST" action="product_details.php" class="notification">
                    <input type="hidden" name="product_id" value="' . $rw['value'] . '">
                    <a href="product_details.php?product_id=' . $rw['value'] . '" id="img_but">
                        <img src="images/' . $rw['image'] . '" alt="Notification Image">
                    </a>';
                echo '<div class="notification-content">';
                if ($_SESSION['email'] == $rw['from_email']) {
                    echo '<p><strong>(To: ' . $rw['to_name'] . ') ' . $rw['header'] . '</strong>: ' . $rw['message'] . '</p>';
                    echo '<p><small>Sent on: ' . $rw['time_hour'] . '</small></p>';
                } else {
                    echo '<p><strong>(From: ' . $rw['from_name'] . ') ' . $rw['header'] . '</strong>: ' . $rw['message'] . '</p>';
                    echo '<p><small>Received on: ' . $rw['time_hour'] . '</small></p>';
                }
                echo '<a href="product_details.php?product_id=' . $rw['value'] . '">View details</a>';
                echo '</div>
                </form>';
            }else{
                echo '<form method="POST" action="" class="notification">
                    <a href="'.$rw['link_value'].'" id="img_but">
                        <img src="images/th.jpeg" alt="Notification Image">
                    </a>';
                echo '<div class="notification-content">';
                if ($_SESSION['email'] == $rw['from_email']) {
                    echo '<p><strong>(To: ' . $rw['to_name'] . ') ' . $rw['header'] . '</strong>: ' . $rw['message'] . '</p>';
                    echo '<p><small>Sent on: ' . $rw['time_hour'] . '</small></p>';
                } else {
                    echo '<p><strong>(From: ' . $rw['from_name'] . ') ' . $rw['header'] . '</strong>: ' . $rw['message'] . '</p>';
                    echo '<p><small>Received on: ' . $rw['time_hour'] . '</small></p>';
                }
                echo '<a href="'.$rw['link_value'].'">View details</a>';
                echo '</div>
                </form>';
            }
            }
            ?>
        </div>
    </div>
</body>
</html>