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
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            position: relative;
        }
        h1 {
            color: #333;
            background-color: #007BFF;
            margin-bottom: 0px;
            padding: 10px;
            border-radius: 10px;
            margin-top: 0px;
            text-align: center;
        }
        #back-button {
            position: absolute;
            top: 30px;
            left: 25px;
            width: 70px;
            margin-top: 0px;
            margin-left:10px;
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        #back-button:hover {
            background-color: #0056b3;
        }
        #part {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        #part_1, #part_2, #part_3 {
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        #part_1 {
            width: 39%;
            height: 300px;
            background-color: #007BFF;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        #slider {
            width: 100%;
            height: 100%;
            position: relative;
        }
        .slides {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }
        #part_2 {
            width: 30%;
            background-color: #17A2B8;
            color: white;
            text-align: left;
        }
        #part_3 {
            width: 30%;
            background-color: #6F42C1;
            color: white;
            text-align: left;
        }
        h2 {
            border-bottom: 2px solid white;
            padding-bottom: 5px;
        }
        p {
            font-size: 16px;
            margin: 5px 0;
        }
        strong{
            display: inline-block;
            width: 30%;
        }
        #feedback-form {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, textarea, select {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input{
        }
        button {
            margin-top: 15px;
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 50%;
            margin-left: 25%;
        }
        button:hover {
            background-color: #218838;
        }
    </style>';
echo'</head>
<body>';
if(isset($_GET['order_id'])){
    $conn=mysqli_connect('localhost','root','','ecommerce');
    $res=$conn->query("select * from orders where order_id={$_GET['order_id']}");
    if($row=mysqli_fetch_assoc($res)){
        $rs=$conn->query("select * from products where p_id={$row['p_id']}");
        $r_l=mysqli_fetch_assoc($rs);
        $cat=$r_l['category'];
        $re=$conn->query("select sub_file from product_images where p_id={$row['p_id']}");    
        echo'<button id="back-button" onclick="history.back()">Back</button>
        <h1>Order Details</h1>
        <div id="part">
            <div id="part_1">
                <div id="slider">';
            while($rw=mysqli_fetch_assoc($re)){
                echo'<img class="slides" src="images/'.$cat.'/'.$rw['sub_file'].'" alt="Product Image 1">';
            }
            echo'</div>
            </div>';
        
        echo'<div id="part_2">
            <h2>Product Details</h2>
            <p><strong>Name</strong>: '.$r_l['name'].' Product</p>
            <p><strong>Original price</strong>: <del>'.$row['org_price'].'</del></p>
            <p><strong>Discount</strong>: -'.$row['discount'].'%</p>
            <p><strong>Price</strong>: '.$row['price'].'</p>
            <p><strong>Qty</strong>: '.$row['qty'].'</p>
            <p><strong>Total</strong>: '.$row['total'].'</p>
            <p><strong>Order ID</strong>: '.$row['order_id'].'</p>
            <p><strong>Description</strong>:<br><br>'.$r_l['description'].'<br><br></p>
            <p><strong>Brand</strong>: '.$r_l['brand'].'</p>
            <p><strong>Expected on</strong>: '.$row['exp_date'].'</p>';
            if($row['status']==0){
            echo'<p><strong>Status</strong>: Pending</p>';
            }else if($row['status']==1 || $row['status']==2){
                echo'<p><strong>Status</strong>: Completed</p>';
            }
            if($row['del_date']){

            }else{
            echo'<p><strong>Delivered on</strong>: '.$row['del_date'].'</p>';
            }
            echo'<p><strong>Ordered on</strong>: '.$row['time_hour'].'</p>
        </div>
        <div id="part_3">
            <h2>Shipped Details</h2>
            <p><strong>Name</strong>: '.$row['name'].'</p>
            <p><strong>District</strong>: '.$row['district'].'</p>
            <p><strong>Area</strong>: '.$row['area'].'</p>
            <p><strong>Location</strong>: '.$row['landmark'].'</p>
            <p><strong>Mobile</strong>: '.$row['mobile'].'</p>
        </div>
    </div>';
    if($row['status']==1){
    echo'<div id="feedback-form">
        <h2 style="background-color:#007BFF;text-align: center;padding: 15px;border-radius: 10px;">Feedback Form</h2>
        <form action="order_details.php" method="get">
            
            <label for="comment">Your Comment:</label>
            <textarea id="comment" rows="4" placeholder="Write your feedback here..." name="comment" required></textarea>
            
            <label for="rating">Rating:</label>
            <select id="rating" name="rating">
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Good</option>
                <option value="3">3 - Average</option>
                <option value="2">2 - Poor</option>
                <option value="1">1 - Bad</option>
            </select>
            <input type="hidden" name="order_id" value='.$_GET['order_id'].'>
            
            <button type="submit" name="sub_feed_back" value='.$row['p_id'].'>Submit Feedback</button>
        </form>
    </div>';
    }

    echo'<script>
        let index = 0;
        function showSlides() {
            let slides = document.querySelectorAll(".slides");
            slides.forEach(slide => slide.style.display = "none");
            index = (index + 1) % slides.length;
            slides[index].style.display = "block";
            setTimeout(showSlides, 2000);
        }
        showSlides();
    </script>';
        
    }
}
echo'</body>
</html>';
if(isset($_GET['sub_feed_back'])){
    $p_id=$_GET['sub_feed_back'];
    $order_id=$_GET['order_id'];
    $comment=$_GET['comment'];
    $rating=$_GET['rating'];
    $email=$_SESSION['email'];
    $conn=mysqli_connect("localhost","root","","ecommerce");
    $x=$conn->query("select username from users where email='{$email}'");
    $us_name=mysqli_fetch_assoc($x)['username'];
    $conn->query("insert into feedback(p_id,username,email,rating,description) values($p_id,'$us_name','$email',$rating,'$comment')");
    $conn->query("Update orders set status=2 where order_id={$order_id}");
    echo '<script>
    alert("Thank you for providing your feedback");
    window.location.href = "order.php";
</script>';
}
?>
