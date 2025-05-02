
<?php

if(isset($_GET['order_id'])){
    $currentDateTime = date('Y-m-d H:i:s');
    $ipAddress_1 = $_SERVER['REMOTE_ADDR'];
    $conn = mysqli_connect("localhost", "root", "", "ecommerce");
    
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
  
    $ip_Address = get_IP_address();
    $loc=json_decode(file_get_contents("http://ip-api.com/json/$ip_Address"),true);
    $city=$loc['city'];

    $options = ['Order Received','Dispatched', 'Processing', 'In Transit','Out for delivery'];

    echo '<script>
        var options = ' . json_encode($options) . ';
        var message = "Please select an option:\n";
        for (var i = 0; i < options.length; i++) {
            message += (i + 1) + ". " + options[i] + "\n";
        }

        var userSelection = prompt(message, "1");
        if (userSelection !== null && userSelection >= 1 && userSelection <= options.length) {
            document.cookie = "selected_status=" + options[userSelection - 1];
        }
    </script>';

    if(isset($_COOKIE['selected_status'])) {
        $status = $_COOKIE['selected_status'];
        $orderId = mysqli_real_escape_string($conn, $_GET['order_id']);
        $status = mysqli_real_escape_string($conn, $status);
        
        $query = "INSERT INTO logs (ip, order_id, place, date, status) VALUES ('$ipAddress_1', '$orderId', '$city', '$currentDateTime', '$status')";
        
        if ($conn->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
    
    $conn->close();
}
if(isset($_GET['sub_log'])){
    $currentDateTime = date('Y-m-d H:i:s');
    $ipAddress_1 = $_SERVER['REMOTE_ADDR'];
    $place=$_GET['place'];
    $status=$_GET['status'];
    $order_id=$_GET['sub_log'];
    $query = "INSERT INTO logs (ip, order_id, place, date, status) VALUES ('$ipAddress_1', '$order_id', '$place', '$currentDateTime', '$status')";
    $conn = mysqli_connect("localhost", "root", "", "ecommerce");
    $conn->query($query);
    header("Location:manage_tracking.php");
}
?>

