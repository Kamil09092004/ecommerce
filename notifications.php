<?php
    if(isset($_POST['send_but'])){
        $id=$_POST['send_but'];
        $conn=mysqli_connect("localhost","root","","ecommerce");
        $re=mysqli_fetch_assoc($conn->query("select * from notification_buffer where id=$id"));
        $to_email=$re['to_email'];
        $header=$_POST['header'];
        $message=$_POST['message'];
        $link=$re['link_value'];
        $cur_date_time=date("Y-m-d H:i:s"); 
        $conn->query("Delete from notification_buffer where id=$id");
        $name=mysqli_fetch_assoc($conn->query("Select name from users where email='{$to_email}'"))['name'];
        $conn->query("Insert into notification(from_email,to_email,from_name,to_name,image,header,message,time_hour,link_value,type) 
                    values('EZ Mart','$to_email','EZ Mart','$name','images/th.jpeg','$header','$message','$cur_date_time','$link',1)");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
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
        }
        .navbar ul li:hover {
            background: #003f80;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        form{
            padding: 0px;
        }
        th {
            background: #007bff;
            color: white;
            font-size: 16px;
        }
        td input[type="text"] {
            width: 95%;
            height: 30px;
            padding: 6px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        td a {
            color: #007bff;
            font-weight: bold;
        }
        td button {
            background: #28a745;
            color: white;
            border: none;
            width: 60px;
            height: 40px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }
        tr{
            height:50px;
            padding:0px;
        }
        td button:hover {   
            background: #218838;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li onclick="location.href='add_product.php'">Add Product</li>
            <li onclick="location.href='add_category.php'">Add Category</li>
            <li onclick="location.href='manage_tracking.php'">Manage Tracking</li>
            <li onclick="location.href='notifications.php'">Notifications</li>
            <li onclick="location.href='orders.php'">Orders</li>
        </ul>
    </div>
    
    <div class="container">
        <h3>Send Notifications</h3>
        <table>
            <tr>
                <th>Image</th>
                <th>Description</th>
                <th>Header</th>
                <th>Link</th>
                <th>Send</th>
            </tr>
                <?php
                    $conn=mysqli_connect("localhost","root","","ecommerce");
                    $currentDate = new DateTime();
                    $cur=$currentDate->format('Y-m-d');
                    $res=$conn->query("SELECT * FROM notification_buffer WHERE date='{$cur}'");
                    while($rw=mysqli_fetch_assoc($res)){
                        echo "<form action='notifications.php' method='post'>
                                <tr>
                                    <td><img src='images/th.jpeg' alt='Product Image' width='100'></td>
                                    <td><input type='text' name='message' value='{$rw['message']}'></td>
                                    <td><input type='text' name='header' value='{$rw['header']}'></td>
                                    <td><a href='{$rw['link_value']}'>View</a></td>
                                    <td><button name='send_but' value={$rw['id']}>Send</button></td>
                                </tr>
                              </form>";
                    }
                ?>
        </table>
    </div>
</body>
</html>

