<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Page</title>
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            background: #eef1f6;
        }
        h1{
            margin-top: 0px;
            background-color: #007bff;
            text-align: center;
            padding: 20px;
            border-radius: 5px;
        }

        .container {
            max-width: 800px;
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .order-card {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            background: white;
            transition: 0.3s ease-in-out;
        }

        .order-card:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .order-card img {
            width: 250px;
            height: 200px;
            margin-right: 25px;
            border-radius: 8px;
            margin-right: 20px;
        }

        .buttons button {
            margin-right: 5px;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            transition: 0.3s;
        }

        .track { background: #007bff; color: white; }
        .details { background: #28a745; color: white; }
        .share { background: #ffc107; color: black; }

        .buttons button:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background:#007bff;
            color: white;
            padding: 15px;
            border-radius: 8px;
        }
        .top-header a {
            color: black;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
        }
        .top-header .nav-links a {
            margin-left: 20px;
            font-size: 16px;
        }

        /* Updated Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 12px;
            width: 400px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            position: relative;
            animation: slideDown 0.3s ease-in-out;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 22px;
            font-weight: bold;
            cursor: pointer;
            color: #666;
            transition: 0.3s;
        }

        .close:hover {
            color: #333;
        }

        /* Contacts List */
        .contacts-container {
            display: flex;
            flex-direction: column;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 10px;
            background: #f9f9f9;
        }

        .contact-item {
            display: flex;
            align-items: center;
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .contact-item:last-child {
            border-bottom: none;
        }

        /* Search Input */
        #search {
            width: 80%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        /* Modal Buttons */
        .modal button {
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .modal button:hover {
            transform: scale(1.05);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        #but_img{
            background-color: white;
            border: none;
            margin-right: 20px;
            cursor: pointer;
        }
        textarea {
            width: 90%;
            padding: 2px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            resize: none;
        }
        textarea:focus {
            border-color: #5a67d8;
            outline: none;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.5);
        }
    </style>
</head>
<body>
    <div class="top-header">
        <a href="all_products.php">EZ Mart</a>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Shop</a>
            <a href="#">Contact</a>
            <a href="#">Login</a>
        </div>
    </div>
    <div class="container">
        <h1>My Orders</h1>
        <div class="orders">
            <?php
            $result = $conn->query("SELECT * FROM orders WHERE cus_id='{$_SESSION['email']}'");
            if ($result->num_rows > 0) {
                while ($order = $result->fetch_assoc()) {
                    $r = $conn->query("SELECT * FROM products WHERE p_id={$order['p_id']}");
                    if ($rrr = mysqli_fetch_assoc($r)) {
                        echo '<div class="order-card">';
                        echo '<a href="product_details.php?product_id='.$order['p_id'].'" id="but_img"><img src="images/' . $rrr['category'] . '/' . $rrr['main_file'] . '"></a>';
                        echo '<div>';
                        echo '<p><strong>' . $rrr['name'] . '</strong></p>';
                        echo '<p>Price: ' . $order['org_price'] . '</p>';
                        echo '<p>Ordered On: ' . $order['time_hour'] . '</p>';
                        echo '<p>Status: ' . ($order['status'] == 0 ? 'Pending' : 'Completed') . '</p>';
                        if ($order['status'] == 1) {
                            echo '<p>Delivered On: ' . $order['del_date'] . '</p>';
                        }
                        echo '<div class="buttons">';
                        if ($order['status'] ==0) {
                            echo '<a href="track_order.php?order_id='.$order['order_id'].'"><button class="track">Track</button></a>';
                        }
                        echo '<a href="order_details.php?order_id=' . $order['order_id'] . '"><button class="details">Details</button></a>';
                        echo '<button class="share" value="' . $order['p_id'] . '" onclick="openShareModal(this)">Share</button>';
                        echo '</div></div></div>';
                    }
                }
            } else {
                echo '<p>No orders found.</p>';
            }
            ?>
        </div>
    </div>
    <div id="shareModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeShareModal()">&times;</span>
            <h2>Share Order</h2>
            <input type="text" id="search" placeholder="Search contacts..." onkeyup="filterContacts()"/>
            <div id="contacts-list" class="contacts-container">
                <?php
                $sql = "SELECT name, email FROM users";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($contact = $result->fetch_assoc()) {
                        echo '<div class="contact-item">';
                        echo '<input type="checkbox" value="' . $contact['email'] . '">';
                        echo '<span>' . $contact['name'] . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No contacts found.</p>';
                }
                ?>
            </div><br>
            <textarea id="message" placeholder="Your Message" rows="4" required></textarea><br><br>
            <button onclick="sendNotification(this)" id="sd_no" style="width: 60%; background-color:#007bff">Send</button>
        </div>
    </div>
    <script>
        function openShareModal(button) {
            let modal = document.getElementById('shareModal');
            let sendButton = document.getElementById('sd_no');

            // Set modal display
            modal.style.display = 'flex';

            // Set product ID to send button
            sendButton.setAttribute("value", button.value);
        }

        function closeShareModal() {
            document.getElementById('shareModal').style.display = 'none';
        }

        function filterContacts() {
            let search = document.getElementById('search').value.toLowerCase();
            let contacts = document.querySelectorAll('.contact-item');

            contacts.forEach(item => {
                let text = item.textContent.toLowerCase();
                item.style.display = text.includes(search) ? 'flex' : 'none';
            });
        }

        function sendNotification(button) {
            let selectedContacts = [];
            let inputs = document.querySelectorAll('.contact-item input:checked');

            inputs.forEach(input => {
                selectedContacts.push(input.value);
            });

            if (selectedContacts.length === 0) {
                alert("Please select at least one contact.");
                return;
            }

            let productId = button.getAttribute("value");
            let message = document.getElementById("message").value;

            fetch('send_notification.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ contacts: selectedContacts, productId: productId, message: message })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Notification sent successfully!');
                } else {
                    alert('Error sending notification.');
                }
                closeShareModal();
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>
