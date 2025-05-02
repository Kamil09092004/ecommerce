<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EZ MART - Your Smart Shopping Destination</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            user-select: none;
        }
        body {
            background-color: #f8f9fa;
            text-align: center;
        }
        .navbar {
            background-color: #2c3e50;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar a {
            text-decoration: none;
            color: white;
            margin: 0 15px;
            font-size: 18px;
            transition: 0.3s;
        }
        .navbar a:hover {
            color: #1abc9c;
        }
        .hero {
            position: relative;
            height: 60vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 42px;
            font-weight: bold;
            margin-top: 30px;
            text-shadow: 3px 3px 15px rgba(0, 0, 0, 0.7);
            top: 0;
        }
        .slider {
            position: absolute;
            display: flex;
            width: 5000%;
            animation: slide 1000s linear infinite;
            height: 100%;
        }
        .slide {
            width: 100%;
            display: flex;
        }
        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        @keyframes slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }
        .welcome-message {
            height: 40vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 50px 0;
        }
        .product {
            width: 280px;
            background: white;
            margin: 20px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 3px 3px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product:hover {
            transform: scale(1.1);
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.3);
        }
        .product img {
            width: 100%;
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div><h2>EZ MART</h2></div>
        <div>
            <a href="#">Home</a>
            <a href="#">Shop</a>
            <a href="#">Contact</a>
        </div>
        <div class="auth-buttons">
            <a href="login.php">Login</a>
            <a href="sign_up_1.php">Sign Up</a>
        </div>
    </div>
    <div class="hero">
        <div class="slider">
            <div class="slide"><img src="images/home_1.jepg" width="500px"><img src="images/home_2.jpeg" width="300px"></div>
            <div class="slide"><img src="images/home_3.jpg" width="500px"><img src="images/home_4.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_5.jpg" width="500px"><img src="images/home_6.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_7.jpg" width="500px"><img src="images/home_8.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_9.jpg" width="500px"><img src="images/home_10.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_11.jpg" width="500px"><img src="images/home_12.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_13.jpg" width="500px"v><img src="images/home_14.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_15.jpeg" width="500px"><img src="images/home_16.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_17.jpg" width="500px"><img src="images/home_18.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_19.jpg" width="500px"><img src="images/home_20.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_1.jpg" width="500px"><img src="images/home_2.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_3.jpg" width="500px"><img src="images/home_4.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_5.jpg" width="500px"><img src="images/home_6.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_7.jpg" width="500px"><img src="images/home_8.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_9.jpg" width="500px"><img src="images/home_10.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_11.jpg" width="500px"><img src="images/home_12.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_13.jpg" width="500px"v><img src="images/home_14.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_15.jpeg" width="500px"><img src="images/home_16.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_17.jpg" width="500px"><img src="images/home_18.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_19.jpg" width="500px"><img src="images/home_20.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_1.jpg" width="500px"><img src="images/home_2.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_3.jpg" width="500px"><img src="images/home_4.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_5.jpg" width="500px"><img src="images/home_6.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_7.jpg" width="500px"><img src="images/home_8.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_9.jpg" width="500px"><img src="images/home_10.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_11.jpg" width="500px"><img src="images/home_12.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_13.jpg" width="500px"><img src="images/home_14.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_15.jpeg" width="500px"><img src="images/home_16.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_17.jpg" width="500px"><img src="images/home_18.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_19.jpg" width="500px"><img src="images/home_20.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_1.jpg" width="500px"><img src="images/home_2.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_3.jpg" width="500px"><img src="images/home_4.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_5.jpg" width="500px"><img src="images/home_6.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_7.jpg" width="500px"><img src="images/home_8.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_9.jpg" width="500px"><img src="images/home_10.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_11.jpg" width="500px"><img src="images/home_12.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_13.jpg" width="500px"><img src="images/home_14.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_15.jpeg" width="500px"><img src="images/home_16.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_17.jpg" width="500px"><img src="images/home_18.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_19.jpg" width="500px"><img src="images/home_20.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_1.jpg" width="500px"><img src="images/home_2.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_3.jpg" width="500px"><img src="images/home_4.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_5.jpg" width="500px"><img src="images/home_6.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_7.jpg" width="500px"><img src="images/home_8.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_9.jpg" width="500px"><img src="images/home_10.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_11.jpg" width="500px"><img src="images/home_12.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_13.jpg" width="500px"><img src="images/home_14.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_15.jpeg" width="500px"><img src="images/home_16.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_17.jpg" width="500px"><img src="images/home_18.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_19.jpg" width="500px"><img src="images/home_20.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_1.jpg" width="500px"><img src="images/home_2.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_3.jpg" width="500px"><img src="images/home_4.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_5.jpg" width="500px"><img src="images/home_6.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_7.jpg" width="500px"><img src="images/home_8.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_9.jpg" width="500px"><img src="images/home_10.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_11.jpg" width="500px"><img src="images/home_12.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_13.jpg" width="500px"><img src="images/home_14.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_15.jpeg" width="500px"><img src="images/home_16.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_17.jpg" width="500px"><img src="images/home_18.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_19.jpg" width="500px"><img src="images/home_20.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_1.jpg" width="500px"><img src="images/home_2.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_3.jpg" width="500px"><img src="images/home_4.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_5.jpg" width="500px"><img src="images/home_6.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_7.jpg" width="500px"><img src="images/home_8.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_9.jpg" width="500px"><img src="images/home_10.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_11.jpg" width="500px"><img src="images/home_12.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_13.jpg" width="500px"><img src="images/home_14.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_15.jpeg" width="500px"><img src="images/home_16.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_17.jpg" width="500px"><img src="images/home_18.jpg" width="300px"></div>
            <div class="slide"><img src="images/home_19.jpg" width="500px"><img src="images/home_20.jpg" width="300px"></div>
        
        </div>
    </div>
    <div class="welcome-message">
        Welcome to EZ MART - Your Smart Shopping Destination!
    </div>
    <div class="products">
        <div class="product">
            <img src="images\\Electronics_home_1.jpg" alt="Product">
            <h3>Electronics</h3>
        </div>
        <div class="product">
            <img src="images\\fashion_home_2.jpg" alt="Product">
            <h3>Fashion</h3>
        </div>
        <div class="product">
            <img src="images\\accessories_home_3.jpg" alt="Product">
            <h3>Accessories</h3>
        </div>
        <div class="product">
            <img src="images\\home_furniture_home_4.jpg" alt="Product">
            <h3>Home & Furniture</h3>
        </div>
    </div>
</body>
</html>