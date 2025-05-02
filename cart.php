<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'ecommerce');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle quantity update request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_qty'])) {
    $p_id = $_POST['p_id'];
    $new_qty = $_POST['qty'];
    $email = $_SESSION['email'];
    $n_t=date('Y-m-d H:i:s', time());
    if ($conn->query("UPDATE cart SET qty='$new_qty',time_hour='$n_t' WHERE cus_id='$email' AND p_id='$p_id'")) {
        // Recalculate total price
        $res_1 = $conn->query("SELECT price FROM products WHERE p_id='$p_id'");
        if ($rw_1 = mysqli_fetch_assoc($res_1)) {
            $total_item_price = $rw_1['price'] * $new_qty;
            echo json_encode(['success' => true, 'total_item_price' => $total_item_price]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Product not found']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Database update failed']);
    }
    exit; // Stop further execution
}

if (isset($_POST['rem_butt'])) {
    $p_id = $_POST['rem_butt'];
    $email = $_SESSION['email'];
    $conn->query("DELETE FROM cart WHERE cus_id='$email' AND p_id='$p_id'");
}

// Fetch cart details
$no_of_prod = 0;
$tot_price = 0;
$email = $_SESSION['email'];
$res_ult = $conn->query("SELECT * FROM cart WHERE cus_id='$email'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function updateQuantity(input) {
            let newQty = input.value;
            let p_id = input.getAttribute('data-pid');
            let priceCell = input.closest('tr').querySelector('.total-price');

            fetch('', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `update_qty=1&p_id=${p_id}&qty=${newQty}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    priceCell.textContent = data.total_item_price;
                    location.reload(); // Refresh to update summary
                } else {
                    console.error(data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    <style>
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #212529;
            color: white;
            padding: 15px;
            border-radius: 8px;
        }
        .top-header a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
        }
        .top-header .nav-links a {
            margin-left: 20px;
            font-size: 16px;
        }
        .container {
            margin-left: 10%;
        }
        h1, h2 {
            text-align: left;
            font-family: Arial, sans-serif;
            font-weight: bold;
            margin-left: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #343a40;
            color: white;
            padding: 15px;
            border-radius: 8px;
        }
        .search-bar {
            width: 300px;
        }
        table {
            width: 80%;
            margin: 20px 0;
            background: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
            padding: 12px;
            border: none;
        }
        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        input[type="number"] {
            width: 60px;
        }
        .summary-box {
            width: 300px;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            position: absolute;
            right: 10%;
            top: 70%;
        }
        .summary-box h4 {
            margin-bottom: 15px;
        }
        .summary-box p {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            margin: 5px 0;
        }
        input {
            text-align: center;
        }
        .btn-danger:hover {
            background-color: black;
        }
    </style>
</head>
<body class="bg-light">
<div class="top-header">
        <a href="all_products.php">EZ Mart</a>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Shop</a>
            <a href="#">Contact</a>
            <a href="#">Login</a>
        </div>
    </div>
    <div class="container mt-4">
    <div class="header d-flex justify-content-between align-items-center">
    <h1>Your Cart</h1>
    <input type="text" id="searchBar" class="form-control search-bar" placeholder="Search products..." onkeyup="filterProducts()">
</div>

<table class="table table-hover" id="cartTable">
    <thead class="table-dark">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Remove</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while ($rw = mysqli_fetch_assoc($res_ult)) {
            $p_id = $rw['p_id'];
            $res_1 = $conn->query("SELECT * FROM products WHERE p_id='$p_id'");
            $no_of_prod++;

            if ($rw_1 = mysqli_fetch_assoc($res_1)) {
                $total_item_price = $rw_1['price'] * $rw['qty'];
                $tot_price += $total_item_price;
                echo '<tr class="product-row">'
                    . '<td><a href="product_details.php?product_id='.$p_id.'"><img src="images/'.$rw_1['category'].'/'.$rw_1['main_file'].'" alt="Product"></a></td>'
                    . '<td class="product-name">'.$rw_1['name'].'</td>'
                    . '<td>'.$rw_1['price'].'</td>'
                    . '<td><input type="number" class="form-control qty-input" min="1" value="'.$rw['qty'].'" data-pid="'.$p_id.'" onchange="updateQuantity(this)"></td>'
                    . '<td class="total-price">'.$total_item_price.'</td>'
                    . '<td><form method="POST"><button type="submit" class="btn btn-danger" name="rem_butt" value="'.$p_id.'">Remove</button></form></td>'
                    . '<td><form method="get" action="cart_details.php"><button type="submit" class="btn btn-info" name="butt_det" value="'.$p_id.'">Details</button></form></td>'
                    . '</tr>';
            }
        } ?>
    </tbody>
</table>

<script>
function filterProducts() {
    let input = document.getElementById("searchBar").value.toLowerCase();
    let rows = document.querySelectorAll(".product-row");
    
    rows.forEach(row => {
        let name = row.querySelector(".product-name").textContent.toLowerCase();
        row.style.display = name.includes(input) ? "" : "none";
    });
}
</script>

        <div class="summary-box">
            <h4>Cart Summary</h4>
            <p><span>Total Products:</span> <span><?php echo $no_of_prod; ?></span></p>
            <p><span>Total Price:</span> <span>$<?php echo $tot_price; ?></span></p>
            <p><span>Sub Tax:</span> <span>$<?php echo number_format($tot_price * 0.05, 2); ?></span></p>
            <p><span>Delivery Charges:</span> <span>$10</span></p>
            <hr>
            <p><strong><span>Total:</span> <span>$<?php echo number_format($tot_price * 1.05 + 10, 2); ?></span></strong></p>
        </div>
    </div>
</body>
</html>
