<?php
session_start();
echo'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            font-family: "Poppins", sans-serif;
        }
        .contact-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 500px;
            text-align: center;
        }
        h2 {
            color: white;
            background: #5a67d8;
            padding: 15px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .search-box {
            margin-bottom: 15px;
        }
        .search-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }
        .search-box input:focus {
            border-color: #5a67d8;
            outline: none;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.5);
        }
        .contact-list {
            text-align: left;
            margin-bottom: 20px;
            max-height: 200px; /* Reduced height */
            overflow-y: auto; /* Enables scrolling */
            min-height: 200px; /* Ensures that the box height remains constant */
        }
        .contact-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            font-weight: 500;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 10px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }
        .contact-item input {
            position: absolute;
            opacity: 0;
        }
        .contact-item label {
            flex: 1;
            cursor: pointer;
        }
        .contact-item .contact-checkmark {
            font-size: 20px;
            color: white;
            background: #5a67d8;
            width: 24px;
            height: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            position: absolute;
            right: 10px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .contact-item input:checked ~ .contact-checkmark {
            opacity: 1;
        }
        textarea {
            width: 100%;
            padding: 12px;
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
        button {
            width: 100%;
            padding: 14px;
            background: #5a67d8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }
        button:hover {
            background: #434190;
            transform: translateY(-2px);
        }
    </style>';
echo'<script>
        function filterContacts() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let contacts = document.getElementsByClassName("contact-item");
            
            for (let i = 0; i < contacts.length; i++) {
                let label = contacts[i].getElementsByTagName("label")[0];
                let textValue = label.textContent || label.innerText;
                
                if (textValue.toLowerCase().indexOf(input) > -1) {
                    contacts[i].style.display = "flex";
                } else {
                    contacts[i].style.display = "none";
                }
            }
        }
    </script>';
echo'</head>
<body>
    <div class="contact-box">
        <h2>Select Contacts</h2>
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search contacts..." onkeyup="filterContacts()">
        </div>';
        if(isset($_GET['share_but'])){
        echo'<form action="prod_det_share.php" method="get">
            <div class="contact-list">';
                $conn=mysqli_connect("localhost","root","","ecommerce");
                $re=$conn->query("Select * from users");
                $r=0;
                while($rw=mysqli_fetch_assoc($re)){
                    $r=$r+1;
                    echo'<div class="contact-item">
                    <input type="checkbox" id="contact'.$r.'" name="contacts[]" value="'.$rw['email'].'">
                    <label for="contact'.$r.'">'.$rw['name'].'</label>
                    <div class="contact-checkmark">✔</div>
                </div>';
                }
            
                
            echo'</div>
            <textarea name="message" placeholder="Your Message" rows="4" required></textarea>
            <button type="submit" name="share_but" value='.$_GET['share_but'].'>Send</button>
        </form>';
            }
    echo'</div>
</body>
</html>';
?>

<?php
if (isset($_GET['share_but'])) {
    if (!empty($_GET['contacts'])) {
        $conn=mysqli_connect("localhost","root","","ecommerce");
        $re=$conn->query("select * from products where p_id={$_GET['share_but']}");
        $rw=mysqli_fetch_assoc($re);
        $image=$rw['category'].'/'.$rw['main_file'];
        $from_email=$_SESSION['email'];
        $value=$_GET['share_but'];
        $from_name=mysqli_fetch_assoc($conn->query("Select name from users where email='{$_SESSION['email']}'"))['name'];
        $header="Product sugesstion";
        $message = htmlspecialchars($_GET['message']);
        $time_hour = date("Y-m-d H:i:s");
        $type=0;
        #$conn->query("Insert into notification(from_email,to_email,image,value,header,message,time_hour,type) values()");
        #echo $_GET['share_but']."<br>";
        $contacts = $_GET['contacts'];
        for($i=0;$i<count($contacts);$i++){
            $to_name=mysqli_fetch_assoc($conn->query("select name from users where email='{$contacts[$i]}'"))['name'];
            $conn->query("Insert into notification(from_email,to_email,from_name,to_name,image,value,header,message,time_hour,type) 
            values('$from_email','$contacts[$i]','$from_name','$to_name','$image',$value,'$header','$message','$time_hour',$type)");
        }
        echo'<script>alert("Notification sent successfully");window.history.go(-2);</script>';
    }
}
?>
