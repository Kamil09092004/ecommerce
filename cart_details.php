<?php
session_start();
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product_details</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-y: auto;
        }
        .slider-container {
            position: relative;
            margin-top: 160px;
            width: 400px;
            height: 300px;
            float:left;
            margin-left: 160px;
            perspective: 1000px;
        }
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
        .slider {
            width: 100%;
            height: 100%;
            position: absolute;
            transform-style: preserve-3d;
            animation: rotate 10s linear infinite;
        }
        .slider img {
            position: absolute;
            width: 300px;
            height: 250px;
            left: 50%;
            overflow:hidden;
            transform: translateX(-50%) rotateY(var(--angle)) translateZ(220px);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        @keyframes rotate {
            from { transform: rotateY(0deg); }
            to { transform: rotateY(360deg); }
        }
        .product-details {
            margin-top: 60px;
            padding: 15px;
            width: 35%;
            background-color: #f9f9f9;
            border-radius: 10px;
            height: auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            text-align: left;
            float: right;
            margin-right: 110px;
        }
        .buttons {
            margin-top: 10px;
        }
        .buttons button {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .buy { background-color: green; color: white;width:30%}
        .remove { background-color: red; color: white; width:30%}
        .back { background-color: black; color: white; width:30%}
        strong {
            display: inline-block;
            width: 30%;
            margin-left: 10px;
        }
    </style>';
echo '</head>
<body>
<div class="top-header">
    <a href="all_products.php" style="margin-left: 20px;">EZ Mart</a>
    <div class="nav-links">
        <a href="#">Home</a>
        <a href="#">Shop</a>
        <a href="#">Contact</a>
        <a href="#">Login</a>
    </div>
</div>';
if (isset($_GET['butt_det'])) {
    echo '<div class="slider-container">
        <div class="slider" id="slider">';
    $id_pro = $_GET['butt_det'];
    $conn = mysqli_connect('localhost', 'root', '', 'ecommerce');
    $res = $conn->query("SELECT * FROM products WHERE p_id='$id_pro'");
    $res_1 = $conn->query("SELECT * FROM cart WHERE cus_id='{$_SESSION['email']}' AND p_id='$id_pro'");
    $rw_1 = mysqli_fetch_assoc($res_1);
    $rs_2 = $conn->query("SELECT * FROM product_images WHERE p_id='$id_pro' limit 5");
    $ret_2 = $conn->query("SELECT category FROM products WHERE p_id='$id_pro'");
    $cat = null;
    $no_deg = 360 / mysqli_num_rows($rs_2);
    $ini = 0;
    if ($row = mysqli_fetch_assoc($ret_2)) {
        $cat = $row['category'];
    }
    while ($row = mysqli_fetch_assoc($rs_2)) {
        echo '<img src="images/' . $cat . '/' . $row['sub_file'] . '" style="--angle: ' . $ini . 'deg;">';
        $ini += $no_deg;
    }
    echo '</div>
    </div>';
    if ($rw = mysqli_fetch_assoc($res)) {
        echo '<div class="product-details" id="productDetails">
        <h2 id="productTitle" style="text-align: center;">Product Details</h2><hr>
        <p><strong>Name</strong>: ' . $rw['name'] . '</p>
        <p><strong>Original price</strong>: ' . $rw['org_price'] . '</p>
        <p><strong>Discount</strong>: ' . $rw['discount'] . '</p>
        <p><strong>Price</strong>: ' . $rw['price'] . '</p>
        <p><strong>Brand</strong>: ' . $rw['brand'] . '</p>
        <p><strong>Added Quantity</strong>: ' . $rw_1['qty'] . '</p>
        <p><strong>Added to cart</strong>: ' . $rw_1['add_time_hour'] . '</p>
        <p><strong>Last updated</strong>: ' . $rw_1['time_hour'] . '</p>
        <p><strong>Description</strong>: <br><br>' . $rw['description'] . '</p>';
        if ($rw['stock'] == 0) {
            echo '<p><strong>Availability</strong>: Out of Stock</p>';
        } else if ($rw['stock'] < $rw_1['qty']) {
            echo '<p><strong>Availability</strong>: Only ' . $rw['stock'] . ' Available</p>';
        } else {
            echo '<p><strong>Availability</strong>: In Stock</p>';
        }
    }
    echo '<form action="shipping.php" method="post"><div class="buttons">
        <button class="back" name="back_cart_det">Back</button>
        <button class="remove" name="re_bt" value='.$id_pro.'>Remove</button>
        <button class="buy" name="ct_buy_butt" value='.$id_pro.'>Buy Now</button>
        </div>
        </form>
    </div>';
    echo '</div>';

}
echo '</body>
</html>';
?>
