<?php
echo'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search result</title>
    
    <script src="https://kit.fontawesome.com/207edb97e5.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            margin: 0;
            user-select: none;
            font-family: \'Open Sans\', sans-serif;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #007bff;
            width: 97%;
            height: 60px;
            position: sticky;
            top: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .menu {
            cursor: pointer;
            display: flex;
            align-items: center;
            position: relative;
        }
        #category-list {
            width: 200px;
            position: absolute;
            top: 60px;
            left: -250px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            text-align: center;
            padding: 10px;
            opacity: 0;
            transform: translateX(-100%);
            transition: all 0.5s ease-in-out;
        }
        .menu:hover #category-list {
            left: 0;
            opacity: 1;
            transform: translateX(0);
        }
        .search-bar {
            flex-grow: 1;
            margin: 0 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .search-bar input {
            width: 400px;
            padding: 12px;
            border-radius: 20px;
            border: none;
            outline: none;
            font-size: 16px;
        }
        .search-bar button {
            padding: 12px 20px;
            border: none;
            background-color: #fff;
            color: #007bff;
            border-radius: 20px;
            cursor: pointer;
            margin-left: 10px;
            font-size: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .user-section {
            display: flex;
            align-items: center;
        }
        .user-section div {
            margin-left: 10px;
            cursor: pointer;
            padding: 10px 15px;
            background-color: #fff;
            color: #007bff;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .user-section div:hover {
            transform: scale(1.1);
        }
        .user-section div a {
            text-decoration: none;
            color: inherit;
            margin-left: 5px;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
        }
        .product-box {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .product-box img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>';
echo'
<body>
    <div class="header">  
        <div class="menu">
            <h2><i class="fa-solid fa-list"></i></h2>
            <div id="category-list">
                <h2>Categories</h2>
                <hr>';
                    $conn = mysqli_connect('localhost', 'root', '', 'ecommerce');
                    $result = $conn->query("SELECT * FROM categories");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<a href='{$row['file']}' class='category-item'>{$row['name']}</a><br>";
                    }
            echo'
            </div>
        </div>
        
        <div class="search-bar">
            <form action="search_result.php" method="get">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit" name="button_search">Search</button>
            </form>
        </div>';
        echo'
        <div class="user-section">
            <div>
                <i class="fa-solid fa-cart-shopping"></i> <a href="cart.php">Cart</a>
            </div>
            <div>
                <a href="">Orders</a>
            </div>
            <div>
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </div>

    <div class="products">';
    if(isset($_GET['button_search'])){
        $search=strtolower(trim($_GET['search']));
        $product_result = $conn->query("SELECT * FROM products WHERE LOWER(general_name) LIKE '%$search%'");
        while ($product = mysqli_fetch_assoc($product_result)) {
                echo "<div class='product-box' style='border: 1px solid #ddd; padding: 15px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); text-align: center; background-color: #fff;'>
    <form action='product_details.php' method='get'>
        <button type='submit' name='product_id' value='{$product['p_id']}' style='border:none;background-color:transparent;cursor:pointer;'>
            <img src='images/{$product['category']}/{$product['main_file']}' alt='{$product['name']}' style='width: 100%; max-width: 200px; border-radius: 5px;'>
        </button>
    </form>
    <h3 style='margin-top: 10px; font-size: 1.2em; color: #333;'>{$product['name']}</h3>
    
    <p style='font-size: 1em; margin-top: 5px;'>
        <span style='text-decoration: line-through; color: red; font-size: 0.9em;'>\${$product['org_price']}</span>  
        <span style='color: green; font-weight: bold; font-size: 1.2em;'>\${$product['price']}</span>  
        <span style='color: blue; font-size: 0.9em;'>({$product['discount']}% off)</span>
    </p>
</div>
";
            }
        }else{
            echo"No result found....";
        }
    echo"    
    </div>

    </body>
</html>";
?>
