<?php
    if(isset($_POST['comp_ord'])){
        $conn=mysqli_connect("localhost","root","","ecommerce");
        $cur=date('Y-m-d');
        $cur_hour=date('Y-m-d H:i:s');
        $conn->query("Update orders set status=1,del_date='$cur' where order_id={$_POST['comp_ord']}");
        $ipAddress_1 = $_SERVER['REMOTE_ADDR'];
        function get_IP_address()
            {
                foreach (array('HTTP_CLIENT_IP',
                            'HTTP_X_FORWARDED_FOR',
                            'HTTP_X_FORWARDED',
                            'HTTP_X_CLUSTER_CLIENT_IP',
                            'HTTP_FORWARDED_FOR',
                            'HTTP_FORWARDED',
                            'REMOTE_ADDR') as $key){
                    if (array_key_exists($key, $_SERVER) === true){
                        foreach (explode(',', $_SERVER[$key]) as $IPaddress){
                            $IPaddress = trim($IPaddress); // Just to be safe

                            if (filter_var($IPaddress,
                                        FILTER_VALIDATE_IP,
                                        FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
                                !== false) {

                                return $IPaddress;
                            }
                        }
                    }
                }
            }
        $ip_Address=get_IP_address();
        $place=json_decode(file_get_contents("http://ip-api.com/json/$ip_Address"),true)['city'];
        $conn->query("Insert into logs(ip,order_id,place,date,status) values('$ipAddress_1',{$_POST['comp_ord']},'$place','$cur_hour','Completed')");
        $rt=mysqli_fetch_assoc($conn->query("select cus_id,p_id from orders where order_id={$_POST['comp_ord']}"));
        $cus_id=$rt['cus_id'];
        $p_id=$rt['p_id'];
    
        $rslt=$conn->query("Select * from association where b_p_id={$p_id}");
        $currentDate = new DateTime();
        $currentDate->modify('+1 day');
        while($rw=mysqli_fetch_assoc($rslt)){
            $cur=$currentDate->format('Y-m-d');
            $conn->query("Insert into notification_buffer(to_email,header,message,link_value,date) values('$cus_id','Product recommendation','{$rw['message']}','{$rw['link']}','$cur')");
            $currentDate->modify('+1 day');
        }
    
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
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #007bff;
            color: white;
            padding: 15px;
            border-radius: 8px;
        }
        .search-bar input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 300px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        button {
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #218838;
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
        <div class="header">
            <h3 style="margin-left: 20px;">Order Management</h3>
            <div class="search-bar">
                <input type="text" id="searchOrder" placeholder="Search by Order ID..." onkeyup="searchOrder()">
            </div>
        </div>
        <table id="orderTable">
            <?php
            echo'<tr>
            <th>Order ID</th>
            <th>Date</th>
            <th>Price</th>
            <th>Expected Date</th>
            <th>Complete</th>
        </tr>';
            $conn=mysqli_connect("localhost","root","","ecommerce");
            $res=$conn->query("Select * from orders where status=0");
            while($rw=mysqli_fetch_assoc($res)){

                echo'<tr>
                <td>'.$rw['order_id'].'</td>
                <td>'.$rw['time_hour'].'</td>
                <td>'.$rw['total'].'/-</td>
                <td>'.$rw['exp_date'].'</td>
                <td><form action="orders.php" method="post"><button  name="comp_ord" value='.$rw['order_id'].'>Mark as Complete</button></form></td>
            </tr>';
            }
            
           /* echo'<tr>
                <td>1001</td>
                <td>2025-03-05</td>
                <td>$50.00</td>
                <td>2025-03-10</td>
                <td><form action="" method="post"><button>Mark as Complete</button></form></td>
            </tr>';
            echo'<tr>
                <td>1002</td>
                <td>2025-03-06</td>
                <td>$75.00</td>
                <td>2025-03-12</td>
                <td><button>Mark as Complete</button></td>
            </tr>';*/
            ?>
        </table>
    </div>
    
    <script>
        function searchOrder() {
            let input = document.getElementById("searchOrder").value.toLowerCase();
            let table = document.getElementById("orderTable");
            let rows = table.getElementsByTagName("tr");
            
            for (let i = 1; i < rows.length; i++) {
                let orderId = rows[i].getElementsByTagName("td")[0];
                if (orderId) {
                    let textValue = orderId.textContent || orderId.innerText;
                    if (textValue.toLowerCase().indexOf(input) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>

