<?php
session_start(); // Start the session

// Check if the user clicked on the "Sign Out" link
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: login.php"); // Redirect to the login page
    exit(); // Ensure no further code is executed
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }
        #sidebar {
            width: 15%;
            background-color: #2c3e50;
            color: white;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }
        #sidebar a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            padding: 12px;
            display: block;
            text-align: center;
            width: 100%;
            border-radius: 5px;
            transition: 0.3s;
            margin-top: 10px;
        }
        #sidebar a:hover {
            background-color: #1abc9c;
        }
        #main {
            width:85%;
            padding: 40px;
            display: flex;
            flex-direction: column;
        }
        #chat-container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            max-height: 80vh;
            overflow-y: auto;
            padding: 10px;
        }
        .message {
            padding: 10px;
            margin: 5px;
            border-radius: 8px;
            max-width: 70%;
        }
        .user-message {
            background: #3498db;
            color: white;
            align-self: flex-end;
        }
        .bot-message {
            background: #ecf0f1;
            color: black;
            align-self: flex-start;
        }
        .options {
            display: flex;
            flex-direction: column;
            align-self: flex-start;
        }
        .options button {
            background: #2c3e50;
            color: white;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .options button:hover {
            background: #1abc9c;
        }
        h2 {
            text-align: center;
            background: #3498db;
            color: white;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div id='sidebar'>
        <a href="all_products.php"><h2>Menu</h2></a><br>
        <a href="profile.php">My Profile</a>
        <a href="track_order.php">Track Order</a>
        <a href="notification.php">Notifications</a>
        <a href="chatbot.php" style="background-color: #1abc9c;">Contact</a>
        <a href="?logout=true">Sign Out</a>
    </div>
    <div id="main">
        <h2>Contact</h2>
        <div id="chat-container">
            <div class="bot-message message">Click on the problem you are facing</div>
        </div>
        <div class="options" id="options">
            <button onclick="sendMessage('Order Issue')">Order Issue</button>
            <button onclick="sendMessage('Payment Issue')">Payment Issue</button>
            <button onclick="sendMessage('General Inquiry')">General Inquiry</button>
        </div>
    </div>
    <script>
        function sendMessage(option) {
            let chatContainer = document.getElementById('chat-container');
            
            // User message
            let userMessage = document.createElement('div');
            userMessage.classList.add('message', 'user-message');
            userMessage.innerText = option;
            chatContainer.appendChild(userMessage);
            
            setTimeout(() => {
                displayBotResponse(option);
            }, 500);
        }

        function displayBotResponse(option) {
            let chatContainer = document.getElementById('chat-container');
            let botMessage = document.createElement('div');
            botMessage.classList.add('message', 'bot-message');
            let optionsContainer = document.getElementById('options');
            optionsContainer.innerHTML = "";
            
            if (option === 'Order Issue') {
                botMessage.innerText = 'What issue are you facing with your order?';
                optionsContainer.innerHTML = '<button onclick="sendMessage(\'Delayed Order\')">Delayed Order</button>' +
                                            '<button onclick="sendMessage(\'Wrong Item\')">Wrong Item</button>' +
                                            '<button onclick="sendMessage(\'Cancel Order\')">Cancel Order</button>';
            } else if (option === 'Payment Issue') {
                botMessage.innerText = 'Please select a payment-related issue:';
                optionsContainer.innerHTML = '<button onclick="sendMessage(\'Refund Request\')">Refund Request</button>' +
                                            '<button onclick="sendMessage(\'Failed Transaction\')">Failed Transaction</button>' +
                                            '<button onclick="sendMessage(\'Other Payment Issues\')">Other Payment Issues</button>';
            } else if (option === 'General Inquiry') {
                botMessage.innerText = 'Please select your inquiry type:';
                optionsContainer.innerHTML = '<button onclick="sendMessage(\'Store Timings\')">Store Timings</button>' +
                                            '<button onclick="sendMessage(\'Return Policy\')">Return Policy</button>' +
                                            '<button onclick="sendMessage(\'Other Queries\')">Other Queries</button>';
            } else {
                botMessage.innerText = 'Thank you for your response! Our support team will assist you shortly.';
            }
            chatContainer.appendChild(botMessage);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    </script>
</body>
</html>
