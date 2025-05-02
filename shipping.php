<?php
session_start();
echo'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f3;
            padding: 20px;
        }
        .container {
            display: flex;
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .left {
            width: 50%;
            padding: 20px;
        }
        .right {
            width: 50%;
            padding: 20px;
            padding-right:30px;
            background: #f9f9f9;
            border-left: 2px solid #ddd;
        }
        .order-img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .order-details p {
            margin: 10px 0;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .order-now {
            background: #28a745;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            transition: 0.3s;
        }
        .order-now:hover {
            background: #218838;
        }
        .form-group {
            margin-bottom: 15px;
        }
        strong{
            margin-left:20px;
            display:inline-block;
            width:30%;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
            color: #555;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
            #descp{
            margin-left:20px;
    </style>
</head>';
echo '<body>';
if(isset($_POST['re_bt'])){
    $conn = mysqli_connect('localhost', 'root', '', 'ecommerce');
    $p_id = $_POST['re_bt'];
    $email = $_SESSION['email'];
    $conn->query("DELETE FROM cart WHERE cus_id='$email' AND p_id='$p_id'");
    header("Location:cart.php");
}

if(isset($_POST['ct_buy_butt'])){
    $conn=mysqli_connect('localhost','root','','ecommerce');
    $res=$conn->query("SELECT * FROM products WHERE p_id={$_POST['ct_buy_butt']}");
    $r=$conn->query("SELECT * FROM cart where p_id={$_POST['ct_buy_butt']} and cus_id='{$_SESSION['email']}'");
    $ty=mysqli_fetch_assoc($r)['qty'];
    if($rw=mysqli_fetch_assoc($res)){
        if($ty<=$rw['stock']){
        $pp=$ty*$rw['price'];
            echo'<div class="container">
                <div class="left">
                    <h2>Product Details</h2>
                    <img src="images/'.$rw['category'].'/'.$rw['main_file'].'" class="order-img">
                    <div class="order-details">
                        <p><strong>Name</strong>: '.$rw['name'].'</p>
                        <p><strong>Price</strong>: $'.$rw['price'].'   (-'.$rw['discount'].')% off</p>
                        <p><strong>Brand</strong>: '.$rw['brand'].'</p>
                        <p><strong>Quantity</strong>: '.$ty.'</p>
                        <p><strong>Total Price</strong>: $'.$pp.'</p>
                        <p><strong>Description</strong>:<br><div id="descp"> '.$rw['description'].'</div></p>
                    </div>
                </div>';
        $rs=$conn->query("SELECT * FROM users WHERE email='{$_SESSION['email']}'");
        $rl=mysqli_fetch_assoc($rs);
        echo '<div class="right">
                <h2>Shipping Details</h2>
                <form action="shipping.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="'.$rl['name'].'" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" readonly value="'.$rl['email'].'" required>
                    </div>
                    <div class="form-group">
                    <label for="district">District</label>
                    <select id="district" name="district">
                        <option value="SPSR Nellore" '.($rl["district"] == "SPSR Nellore" ? "selected" : "").'>SPSR Nellore</option>
                        <option value="Anantapur" '.($rl["district"] == "Anantapur" ? "selected" : "").'>Anantapur</option>
                        <option value="Srikakulam" '.($rl["district"] == "Srikakulam" ? "selected" : "").'>Srikakulam</option>
                        <option value="East Godavari" '.($rl["district"] == "East Godavari" ? "selected" : "").'>East Godavari</option>
                        <option value="West Godavari" '.($rl["district"] == "West Godavari" ? "selected" : "").'>West Godavari</option>
                        <option value="Krishna" '.($rl["district"] == "Krishna" ? "selected" : "").'>Krishna</option>
                        <option value="Guntur" '.($rl["district"] == "Guntur" ? "selected" : "").'>Guntur</option>
                        <option value="Prakasam" '.($rl["district"] == "Prakasam" ? "selected" : "").'>Prakasam</option>
                        <option value="Vizianagaram" '.($rl["district"] == "Vizianagaram" ? "selected" : "").'>Vizianagaram</option>
                        <option value="Visakhapatnam" '.($rl["district"] == "Visakhapatnam" ? "selected" : "").'>Visakhapatnam</option>
                        <option value="Kurnool" '.($rl["district"] == "Kurnool" ? "selected" : "").'>Kurnool</option>
                        <option value="Chittoor" '.($rl["district"] == "Chittoor" ? "selected" : "").'>Chittoor</option>
                        <option value="Kadapa" '.($rl["district"] == "Kadapa" ? "selected" : "").'>Kadapa</option>
                    </select>
                </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" value="'.$rl['city'].'" required>
                    </div>
                    <div class="form-group">
                        <label for="area">Area:</label>
                        <input type="text" id="area" name="area" value="'.$rl['area'].'" required>
                    </div>

                    <input type="hidden" name="p_id" value="'.$_POST['ct_buy_butt'].'">
                    <input type="hidden" name="p_price" value="'.$rw['price'].'">
                    <input type="hidden" name="p_qty" value="'.$ty.'">
                    <input type="hidden" name="p_discount" value="'.$rw['discount'].'">
                    <input type="hidden" name="p_org_price" value="'.$rw['org_price'].'">


                    <div class="form-group">
                        <label for="landmark">Landmark:</label>
                        <input type="text" id="landmark" name="landmark" value="'.$rl['landmark'].'" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="text" id="mobile" name="mobile" value="'.$rl['mobile'].'" required>
                    </div>
                    <button type="submit" class="order-now" name="buy_indirect" value='.$_POST['ct_buy_butt'].'>Order Now</button><br><br>
                    <button type="submit" class="order-now" name="back_indirect">Cancel</button>
                </form>
            </div>
        </div>';
        }else if($rw['stock']<$ty){
            echo "<script type='text/javascript'>
                alert('Only {$rw['stock']} available');
                window.location.href = 'cart.php';
            </script>";
        }
        else if($rw['stock']==0){
            echo "<script type='text/javascript'>
                alert('Out of Stock!!');
                window.location.href = 'cart.php';
            </script>";
        }
    }
}
if(isset($_POST['buy_butt'])){
    $conn=mysqli_connect('localhost','root','','ecommerce');
    $res=$conn->query("SELECT * FROM products WHERE p_id={$_POST['buy_butt']}");
    if($rw=mysqli_fetch_assoc($res)){
        if($_POST['quantity']<=$rw['stock']){
        $pp=$_POST['quantity']*$rw['price'];
            echo'<div class="container">
                <div class="left">
                    <h2>Product Details</h2>
                    <img src="images/'.$rw['category'].'/'.$rw['main_file'].'" class="order-img">
                    <div class="order-details">
                        <p><strong>Name</strong>: '.$rw['name'].'</p>
                        <p><strong>Price</strong>: $'.$rw['price'].'   (-'.$rw['discount'].')% off</p>
                        <p><strong>Brand</strong>: '.$rw['brand'].'</p>
                        <p><strong>Quantity</strong>: '.$_POST['quantity'].'</p>
                        <p><strong>Total Price</strong>: $'.$pp.'</p>
                        <p><strong>Description</strong>:<br><div id="descp"> '.$rw['description'].'</div></p>
                    </div>
                </div>';
        $rs=$conn->query("SELECT * FROM users WHERE email='{$_SESSION['email']}'");
        $rl=mysqli_fetch_assoc($rs);
        echo '<div class="right">
                <h2>Shipping Details</h2>
                <form action="shipping.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="'.$rl['name'].'" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" readonly value="'.$rl['email'].'" required>
                    </div>
                    <div class="form-group">
                    <label for="district">District</label>
                    <select id="district" name="district">
                        <option value="SPSR Nellore" '.($rl["district"] == "SPSR Nellore" ? "selected" : "").'>SPSR Nellore</option>
                        <option value="Anantapur" '.($rl["district"] == "Anantapur" ? "selected" : "").'>Anantapur</option>
                        <option value="Srikakulam" '.($rl["district"] == "Srikakulam" ? "selected" : "").'>Srikakulam</option>
                        <option value="East Godavari" '.($rl["district"] == "East Godavari" ? "selected" : "").'>East Godavari</option>
                        <option value="West Godavari" '.($rl["district"] == "West Godavari" ? "selected" : "").'>West Godavari</option>
                        <option value="Krishna" '.($rl["district"] == "Krishna" ? "selected" : "").'>Krishna</option>
                        <option value="Guntur" '.($rl["district"] == "Guntur" ? "selected" : "").'>Guntur</option>
                        <option value="Prakasam" '.($rl["district"] == "Prakasam" ? "selected" : "").'>Prakasam</option>
                        <option value="Vizianagaram" '.($rl["district"] == "Vizianagaram" ? "selected" : "").'>Vizianagaram</option>
                        <option value="Visakhapatnam" '.($rl["district"] == "Visakhapatnam" ? "selected" : "").'>Visakhapatnam</option>
                        <option value="Kurnool" '.($rl["district"] == "Kurnool" ? "selected" : "").'>Kurnool</option>
                        <option value="Chittoor" '.($rl["district"] == "Chittoor" ? "selected" : "").'>Chittoor</option>
                        <option value="Kadapa" '.($rl["district"] == "Kadapa" ? "selected" : "").'>Kadapa</option>
                    </select>
                </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" value="'.$rl['city'].'" required>
                    </div>
                    <div class="form-group">
                        <label for="area">Area:</label>
                        <input type="text" id="area" name="area" value="'.$rl['area'].'" required>
                    </div>

                    <input type="hidden" name="p_id" value="'.$_POST['buy_butt'].'">
                    <input type="hidden" name="p_price" value="'.$rw['price'].'">
                    <input type="hidden" name="p_qty" value="'.$_POST['quantity'].'">
                    <input type="hidden" name="p_discount" value="'.$rw['discount'].'">
                    <input type="hidden" name="p_org_price" value="'.$rw['org_price'].'">


                    <div class="form-group">
                        <label for="landmark">Landmark:</label>
                        <input type="text" id="landmark" name="landmark" value="'.$rl['landmark'].'" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="text" id="mobile" name="mobile" value="'.$rl['mobile'].'" required>
                    </div>
                    <button type="submit" class="order-now" name="buy_direct">Order Now</button><br><br>
                    <button type="submit" class="order-now" name="back_details" >Cancel</button>
                </form>
            </div>
        </div>';
        }else if($_POST['quantity']>$rw['stock']){
            echo "<script type='text/javascript'>alert('Only {$rw['stock']} available');</script>";
            echo'<script>window.history.back();</script>';
        }
        else if($rw['stock']==0){
            echo "<script type='text/javascript'>alert('Out of stock');</script>";
            echo'<script>window.history.back();</script>';
        }
    }
}
if(isset($_POST['back_details'])){
    echo'<script>window.history.go(-2);</script>';
}
if(isset($_POST['back_indirect'])){
    header("Location:cart.php");
}
if(isset($_POST['back_cart_det'])){
    echo'<script>window.history.go(-2);</script>';

}
if(isset($_POST['add_butt'])){
    $conn=mysqli_connect('localhost','root','','ecommerce');
    $re_s=$conn->query("select name from products where p_id={$_POST['add_butt']}");
    if($rw=mysqli_fetch_assoc($re_s)){
        $current_date_time = date('Y-m-d H:i:s', time());
        session_start();
        $a=$_SESSION['email'];
        $b=$_POST['add_butt'];
        $c=$_POST['quantity'];
        $d=$current_date_time;
        if(mysqli_num_rows($conn->query("select * from cart where cus_id='$a' and p_id='$b'"))){
            echo "<script type='text/javascript'>alert('Product {$rw['name']} already in cart you can modify the quantity');</script>";
            echo'<script>window.history.back();</script>';
        }else{
            $rsp=$conn->query("Insert into cart(cus_id,p_id,qty,time_hour,add_time_hour) values('$a','$b','$c','$current_date_time','$current_date_time')");
            echo "<script type='text/javascript'>alert('Product {$rw['name']} added to cart sucessfully');</script>";
            echo'<script>window.history.back();</script>';
        }
    }
}
if(isset($_POST['buy_direct'])){
    $conn=mysqli_connect('localhost','root','','ecommerce');
    $cus_id=$_POST['email'];
    $name=$_POST['name'];
    $district=$_POST['district'];
    $city=$_POST['city'];
    $area=$_POST['area'];
    $landmark=$_POST['landmark'];
    $mobile=$_POST['mobile'];
    $price=$_POST['p_price'];
    $qty=$_POST['p_qty'];
    $p_id=$_POST['p_id'];
    $time_hour=date("Y-m-d H:i:s", time());
    $status=0;
    $exp_date=date("Y-m-d", strtotime(date("Y-m-d") . ' + 15 days'));
    $discount=$_POST['p_discount'];
    $org_price=$_POST['p_org_price'];  
    $total=$_POST['p_price']*$_POST['p_qty'];
    $conn->query("Insert into orders(cus_id,name,district,city,area,landmark,mobile,price,qty,p_id,time_hour,status,exp_date,discount,org_price,total) values('$cus_id','$name','$district','$city','$area','$landmark','$mobile',$price,$qty,$p_id,'$time_hour',$status,'$exp_date',$discount,$org_price,$total)");
    $conn->query("Update products set stock=stock-{$qty} where p_id={$p_id}");
    header("Location:order.php");
}
if(isset($_POST['buy_indirect'])){
    $conn=mysqli_connect('localhost','root','','ecommerce');
    $cus_id=$_POST['email'];
    $name=$_POST['name'];
    $district=$_POST['district'];
    $city=$_POST['city'];
    $area=$_POST['area'];
    $landmark=$_POST['landmark'];
    $mobile=$_POST['mobile'];
    $price=$_POST['p_price'];
    $qty=$_POST['p_qty'];
    $p_id=$_POST['p_id'];
    $time_hour=date("Y-m-d H:i:s", time());
    $status=0;
    $exp_date=date("Y-m-d", strtotime(date("Y-m-d") . ' + 15 days'));
    $discount=$_POST['p_discount'];
    $org_price=$_POST['p_org_price'];  
    $total=$_POST['p_price']*$_POST['p_qty'];
    $conn->query("Insert into orders(cus_id,name,district,city,area,landmark,mobile,price,qty,p_id,time_hour,status,exp_date,discount,org_price,total) values('$cus_id','$name','$district','$city','$area','$landmark','$mobile',$price,$qty,$p_id,'$time_hour',$status,'$exp_date',$discount,$org_price,$total)");
    $conn->query("Update products set stock=stock-{$qty} where p_id={$p_id}");
    $conn->query("Delete from cart where cus_id='{$_SESSION['email']}' and p_id={$p_id}");
    header("Location:order.php");
}
if(isset($_POST['share_but'])){
    header("Location:prod_det_share.php");
}
echo'</body>
</html>';
?>

