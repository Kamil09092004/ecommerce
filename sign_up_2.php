<?php
session_start();

// Set timer when the page loads for the first time
if (!isset($_SESSION['otp_time'])) {
    $_SESSION['otp_time'] = time();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Verification Code</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
        }
        h2 {
            margin-bottom: 15px;
        }
        input {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 50%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        #just {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        #timer {
            font-size: 14px;
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" id="otpForm">
        <div class="container">
            <h2>Enter the OTP</h2>
            <button id="just" disabled><?= $_SESSION['email'] ?></button><br>
            <input type="text" name="otp" id="userContact" placeholder="Enter the OTP" required maxlength="6">
            <button name="submit" value="submit">Submit</button>
            <div id="timer">OTP expires in: <span id="countdown">60</span> seconds</div>
        </div>
    </form>

    <script>
        let timeLeft = 60;
        const timerElement = document.getElementById("countdown");

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(countdown);
                alert("Session expired! Redirecting...");
                window.location.href = "sign_up_1.php";
            }
        }, 1000);

        const otpInput = document.getElementById("userContact");
        otpInput.addEventListener("input", function () {
            if (this.value.length === 6) {
                document.getElementById("otpForm").submit();
            }
        });
    </script>
</body>
</html>

<?php
// Server-side OTP timeout validation
if (time() - $_SESSION['otp_time'] > 60) {
    session_destroy();
    header("Location: sign_up_1.php");
    exit();
}

if (isset($_POST['submit']) || isset($_POST['otp'])) {
    if ((int)$_POST['otp'] === $_SESSION['otp']) {
        echo "<script>alert('Registration successful');</script>";
        $_SESSION['otp'] = null;
        $_SESSION['otp_time'] = null;
        header('Location: sign_up.php');
        exit();
    } else {
        session_destroy();
        header('Location: sign_up_1.php');
        exit();
    }
}
?>
