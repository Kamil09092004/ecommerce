<?php
session_start();
echo'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
                * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            }

            body {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                background-color: #f4f4f4;
                padding: 20px;
            }

            .container {
                display: flex;
                flex-direction: column;
                width: 90%;
                max-width: 1100px;
                background: white;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                border-radius: 10px;
                overflow: hidden;
            }

            .top-section {
                display: flex;
            }

            #slider-container {
                width: 50%;
                max-height: 575px;
                margin-top: 25px;            
                position: relative;
                overflow: hidden;
            }

            #part_2 {
                width: 50%;
                padding: 30px;
                background: linear-gradient(135deg, #007bff, #6610f2);
                color: white;
                overflow-y: auto;
                max-height: 600px; /* Increased height */
            }

            h2 {
                text-align: center;
                margin-bottom: 10px;
                font-size: 24px;
            }

            hr {
                border: 1px solid white;
                margin-bottom: 20px;
            }

            .info {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
            }

            .label {
                font-weight: bold;
                width: 40%;
            }

            .value {
                width: 60%;
                text-align: left;
            }

            .price {
                font-size: 22px;
                font-weight: bold;
                color: #ffdd57;
            }

            .rating {
                font-size: 20px;
                color: gold;
            }

            .stock {
                color: #ff4d4d;
                font-size: 16px;
                font-weight: bold;
                margin-top: 10px;
                text-align: center;
            }

            .purchase-info {
                font-size: 16px;
                font-weight: bold;
                margin-bottom: 15px;
            }

            .quantity-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
            }

            .quantity-label {
                font-weight: bold;
                width: 40%;
            }

            .quantity-input {
                width: 60px;
                padding: 5px;
                font-size: 16px;
                text-align: center;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            .btn-container {
                display: flex;
                justify-content: space-between;
                gap: 10px;
            }

            .btn {
                flex: 1;
                padding: 10px;
                text-align: center;
                font-size: 18px;
                font-weight: bold;
                text-transform: uppercase;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
            }

            .cart-btn {
                background: #ffdd57;
                color: #333;
            }

            .cart-btn:hover {
                background: #ffd000;
            }
            .slider img {
                width: 100%;
                height:100%;
                display: none;
                overflow: hidden;
            }
            .slider img.active {
                display: block;
            }
            .prev, .next {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: rgba(0, 0, 0, 0.5);
                color: white;
                border: none;
                padding: 10px;
                cursor: pointer;
            }
            .prev { left: 10px; }
            .next { right: 10px; }
            .buy-btn {
                background: #ff4d4d;
                color: white;
            }

            .buy-btn:hover {
                background: #e60000;
            }

            .bottom-section {
                width: 100%;
                background: #007bff;
                color: white;
                text-align: center;
                padding: 20px;
                font-size: 18px;
                font-weight: bold;
                height: 300px;
            }
            .share-container {
                display: flex;
                justify-content: center;  /* Centers the button */
                margin-top: 15px;
            }

            #share_but {
                padding: 5px 10px;
                background: #28a745;  /* Green color for a distinct look */
                color: white;
                font-size: 16px;
                font-weight: bold;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
            }

            #share_but:hover {
                background: #218838; /* Slightly darker green on hover */
            }
            .bottom-section {
            #background: linear-gradient(135deg, #4CAF50, #2E8B57);
            padding: 25px;
            margin-bottom:20px;
            border-radius: 12px;
            width: 60%;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            color: white;
            margin-left:20%;
            margin-top:20px;
            text-align: center;
        }
        .feedback {
            margin-top: 15px;
        }
        .feedback-item {
            background: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 10px;
            box-shadow: 3px 3px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            color: #333;
        }
        .feedback-item:hover {
            transform: scale(1.05);
        }
        h3 {
            margin-bottom: 8px;
            color: #2E8B57;
        }
        .rating {
            color: gold;
            font-size: 20px;
            font-weight: bold;
        }

        


    </style>
</head>';
if(isset($_GET["product_id"]))
{
echo'
<body>

    <div class="container">
        <div class="top-section">
            <div id="slider-container">';
                echo'<div class="slider">';
                $conn=mysqli_connect('localhost','root','','ecommerce');
                $conn->query("Update seq_product set `{$_SESSION['email']}`=`{$_SESSION['email']}`+1 where p_id={$_GET["product_id"]}");
               $result=$conn->query("Select * from product_views where p_id={$_GET['product_id']}");
                if(mysqli_num_rows($result)){
                    if($row=mysqli_fetch_assoc($result)){
                        if($row['time_hour']!=date('H')){
                            $conn->query("DELETE from product_views where p_id={$_GET['product_id']}");
                            $conn->query("INSERT INTO product_views (p_id, views, time_hour) VALUES ({$_GET['product_id']}, 1, " . date('H') . ")");
                            $resu_1=$conn->query("select * from products where p_id={$_GET['product_id']}");
                            if($row_1=mysqli_fetch_assoc($resu_1)){
                                $a=$row_1['discount'];
                                $b=$row_1['price'];
                                $resu_2=$conn->query("select * from product_modification where p_id={$_GET['product_id']}");
                                if($row_2=mysqli_fetch_assoc($resu_2)){
                                    if($row_1['price']>$row_2['price']){
                                        $conn->query("update products set discount={$row_2['dis']},price={$row_2['price']} where p_id={$_GET['product_id']}");
                                        $conn->query("update product_modification set dis={$a},price={$b} where p_id={$_GET['product_id']}");
                                    }
                                }
                            }
                        }
                        else{
                            $result_4=$conn->query("select * from users");
                            if(($row['views']+1)>=(0.75*mysqli_num_rows($result_4))){
                                    $conn->query("update product_views set views=views+1 where p_id={$_GET['product_id']}");
                                    $result_set=$conn->query("Select * from product_modification where p_id={$_GET['product_id']}");
                                    if($row=mysqli_fetch_assoc($result_set)){
                                        $a=$row['dis'];
                                        $b=$row['price'];
                                        $resu=$conn->query("Select * from products where p_id={$_GET['product_id']}");
                                        if($row_1=mysqli_fetch_assoc($resu)){
                                            $a_1=$row_1['discount'];
                                            $b_1=$row_1['price'];
                                            if($b_1<$b){
                                            $conn->query("update products set discount={$a},price={$b} where p_id={$_GET['product_id']}");
                                            $conn->query("update product_modification set dis={$a_1},price={$b_1} where p_id={$_GET['product_id']}");
                                        } 
                                        }
                                    }
                            }
                            else{
                                $conn->query("update product_views set views=views+1 where p_id={$_GET['product_id']}");
                            }
                        }
                    }
                }else{
                    $conn->query("INSERT INTO product_views (p_id, views, time_hour) VALUES ({$_GET['product_id']}, 1, " . date('H') . ")");
                }
                $result=$conn->query("select * from product_images where p_id={$_GET['product_id']}");
                $result_2=$conn->query("select category from products where p_id={$_GET['product_id']}");
                $cat=null;
                if($row=mysqli_fetch_assoc($result_2)){
                    $cat=$row['category'];
                }
                $st=1;
                while($row=mysqli_fetch_assoc($result)){
                    if($row['sub_file']=="{$_GET['product_id']}.jpeg"){
                        echo"<img class='active' src='images\\{$cat}\\{$row['sub_file']}' alt='Image {$st}'>";
                    }else{
                        echo"<img src='images\\{$cat}\\{$row['sub_file']}' alt='Image {$st}'>";
                    }
                    $st+=1;
                }

                echo'</div>
                <button class="prev" onclick="prevSlide()">❮</button>
                <button class="next" onclick="nextSlide()">❯</button>
            </div>';

           echo" <script>
                const images = document.querySelectorAll('.slider img');
                let currentIndex = 0;

                function showSlide(index) {
                    images.forEach(img => img.classList.remove('active'));
                    images[index].classList.add('active');
                }

                function prevSlide() {
                    currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
                    showSlide(currentIndex);
                }

                function nextSlide() {
                    currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
                    showSlide(currentIndex);
                }
            </script>";

                $conn=mysqli_connect('localhost','root','','ecommerce');
                $result_3=$conn->query("Select * from products where p_id={$_GET['product_id']}");
                if($row=mysqli_fetch_assoc($result_3)){
            echo'<div id="part_2">
                <form method="post" action="shipping.php" enctype="multipart/form-data">
                    <h2>Product Details</h2>
                    <hr>

                    <div class="info">
                        <div class="label">Name:</div>
                        <div class="value">'.$row['name'].'</div>
                    </div>

                    <div class="info">
                        <div class="label">Company:</div>
                        <div class="value">'.$row['brand'].'</div>
                    </div>

                    <div class="info">
                        <div class="label">Original Price:</div>
                        <div class="value"><s>&#x20B9;'.$row['org_price'].'</s></div>
                    </div>

                    <div class="info">
                        <div class="label">Discount:</div>
                        <div class="value">-'.$row['discount'].'%</div>
                    </div>

                    <div class="info">
                        <div class="label">Price:</div>
                        <div class="value price">&#x20B9;'.$row['price'].'</div>
                    </div>
                    <div class="info">
                        <div class="label">Quantity:</div>
                        <div class="value">
                            <input type="number" id="quantity" class="quantity-input" name="quantity" min="1" max="5" value="1" required>
                        </div>
                    </div>


                    <div class="info">
                        <div class="label">Details:</div>
                        <div class="value">'.$row['description'].'</div>
                    </div>';
                    $co=mysqli_connect("localhost","root","","ecommerce");
                    $r_r=mysqli_fetch_assoc($co->query("Select avg(rating) as rating from feedback where p_id={$_GET["product_id"]}"))['rating'];
                    
                    if($r_r){
                        echo'<div class="info">
                        <div class="label">Rating:</div>
                        <div class="value rating">'.round($r_r,2).'&#9733;</div>
                    </div>';
                }else{
                    echo'<div class="info">
                    <div class="label">Rating:</div>
                    <div class="value rating">4&#9733;</div>
                </div>';
                    }
                    $nr=mysqli_num_rows($co->query("select * from  orders where p_id={$_GET["product_id"]}"));
                    
                    if($nr){
                        echo'
                    <br>
                    <p class="purchase-info">'.($nr*100).' bought in past one month</p>';
                    }else{
                        echo'
                    <br>
                    <p class="purchase-info">100 bought in past one month</p>';
                    }

                    
                    echo'<div class="btn-container">';
                    echo'
                        <button type="submit" class="btn cart-btn" name="add_butt" value='.$_GET["product_id"].'>Add to Cart</button>';
                    if($row['stock']==0){
                        echo'<button type="submit" class="btn buy-btn" name="buy_butt" onclick="this.disabled=true;" value='.$_GET["product_id"].'>Buy Now</button>';
                    }
                    else{
                        echo'<button type="submit" class="btn buy-btn" name="buy_butt" value='.$_GET["product_id"].'>Buy Now</button>';
                    }
                    echo'</form>';
                    echo'<div class="share-container">
                    <form action="prod_det_share.php" method="get">
                            <button id="share_but" name="share_but" value='.$_GET["product_id"].'>🔗 Share</button>
                        </form>
                            </div>';
                    echo'</div>';
                    if($row['stock']==0){
                   echo' <p class="stock">Out of stock!</p>';
                    }else if($row['stock']<6){
                        echo' <p class="stock">Only 5 left in stock!</p>';
                    }
                    
            echo'</div>';
                }
        echo'</div>

    <div class="bottom-section">
        <h2>Customer Feedback</h2>';
        $conn=mysqli_connect("localhost","root","","ecommerce");
        $relt = $conn->query(
            "SELECT * FROM notification 
            WHERE (from_email = '" . $conn->real_escape_string($_SESSION['email']) . "' 
            OR to_email = '" . $conn->real_escape_string($_SESSION['email']) . "') 
            AND value = '" . intval($_GET['product_id']) . "' and type=0"
        );       
        $arr = [];
if ($relt) {
    // Loop through each row from the result set
    while ($rw = mysqli_fetch_assoc($relt)) {
        // Determine the relevant email based on conditions
        $temp = $rw['from_email'] !== $_SESSION['email'] ? $rw['from_name'] : $rw['to_name'];

        // Add $temp to the array if it's not already present
        if (!in_array($temp, $arr)) {
            $arr[] = $temp; // Append the unique value to the array
        }

        // Display the value of $tem
    }
    if(count($arr)>0){
    echo "<p style='color:black;font-size:12px;'>";
    foreach($arr as $nm){
        echo"{$nm},";
    }
        echo" Bought this product</p>";
    } else {
        echo "";
    }
}
        #echo")</p>";
        #echo'<p>(Your friends)</p>';
        echo'<div class="feedback">';
        $r=$conn->query("Select * from feedback where p_id={$_GET["product_id"]}");
        while($rw=mysqli_fetch_assoc($r)){
            $stars = str_repeat('⭐️', $rw['rating']);
            echo'<div class="feedback-item">
                <h3>'.$rw['username'].'<h3>
                <p>"'.$rw['description'].'"</p>
                <span class="rating">'.$stars.'</span>
            </div>';   
        }
            
        echo'</div>
    </div>
</div>

    </div>

</body>
</html>';
}
?>
