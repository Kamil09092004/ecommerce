<?php
    if(isset($_POST['submit_cat'])){
        $conn=mysqli_connect('localhost','root','','ecommerce');
        $res=$conn->query("select max(id) as id from categories");
        if($row=mysqli_fetch_assoc($res)){
            $maximum_id= $row['id']+1;
            $name=$_POST['cate_gory'];
            handleFileUpload('file1',$_POST['cate_gory'].'_'.$maximum_id.'_1', "images/");
            handleFileUpload('file2', $_POST['cate_gory'].'_'.$maximum_id.'_2', "images/");
            $file=$name."_".$maximum_id.".php";
            $resp_onse=$conn->query("insert into categories(id,name,file) values('$maximum_id','$name','$file')");
            if($resp_onse){
                $file_1 = fopen($file, "w");
                mkdir("images/".$name."_".$maximum_id, 0777, true);
                $file_2=fopen('Electronics_1.php','r');
                $_file_content=fread($file_2,filesize('Electronics_1.php'));
                fclose($file_2);
                fwrite($file_1, $_file_content);
                fclose($file_1);

                echo "<script type='text/javascript'>alert('Category:{$name}.php added sucessfully');</script>";
            }
        }
        $uploadDir = "images/";
    function handleFileUpload($fileInput, $newFileName, $uploadDir) {
        if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$fileInput]['tmp_name'];
            $fileExt = pathinfo($_FILES[$fileInput]['name'], PATHINFO_EXTENSION);
            $newFilePath = $uploadDir . $newFileName . '.' . $fileExt;
    
            if (move_uploaded_file($fileTmpPath, $newFilePath)) {
                #echo "File uploaded successfully: $newFilePath <br>";
            } else {
                #echo "Error moving file: $newFilePath <br>";
            }
        } else {
            #echo "Error uploading file: " . $_FILES[$fileInput]['error'] . "<br>";
        }
    }
    }
    
    
    // Handle both files
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        .navbar ul li {
            padding: 15px 20px;
            margin: 0 10px;
            background: #0056b3;
            border-radius: 5px;
            cursor: pointer;
        }
        .navbar ul li:hover {
            background: #003f80;
        }
        .container {
            display: flex;
            background: #ffffff;
            width: 80%;
            margin-top: 10px;
            margin-left: 10%;
            height: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .left-panel {
            width: 50%;
            padding: 30px;
            background: linear-gradient(135deg, #007BFF, #0056b3);
            color: white;
            text-align: center;
        }
        .right-panel {
            width: 50%;
            padding: 30px;
            background: #f8f9fa;
        }
        h1 {
            margin-bottom: 20px;
        }
        .category-list {
            list-style: none;
            padding: 0;
        }
        .category-list li {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            width: 80%;
            padding: 10px;
            background: #007BFF;
            color: white;
            margin-left: 10%;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        .file-label {
            display: block;
            background: #007BFF;
            color: white;
            text-align: center;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
            transition: 0.3s;
        }
        .file-label:hover {
            background: #0056b3;
        }
        .file-input {
            display: none;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li onclick="location.href='add_product.php'">Add Product</li>
            <li onclick="location.href='add_category.php'">Add Category</li>
            <li onclick="location.href='manage_tracking.php'">Manage Tracking</li>
            <li onclick="location.href='notifications.php'">Notifications</li>
            <li onclick="location.href='orders.php'">Orders</li>
        </ul>
    </div>
    <div class="container">
        <div class="left-panel">
            <h1>Existing Categories</h1>
            <ul class="category-list">
                <?php
                    $con = mysqli_connect('localhost', 'root', '', 'ecommerce');
                    $res = $con->query("SELECT name FROM categories");
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<li>" . htmlspecialchars($row['name']) . "</li>";
                    }
                ?>
            </ul>
        </div>
        <div class="right-panel">
            <h1>Add New Category</h1>
            <form action="add_category.php" method="post" enctype="multipart/form-data">
                <label for="name">Category Name</label>
                <input type="text" name="cate_gory" id="name" placeholder="Enter new category name" required>
                <label for="b_1" class="file-label">Upload Banner 1</label>
                <input type="file" name="file1" id="b_1" required accept=".jpg" class="file-input">

                <label for="b_2" class="file-label">Upload Banner 2</label>
                <input type="file" name="file2" id="b_2" required accept=".jpg" class="file-input">

                <input type="submit" name="submit_cat" value="Add Category">
            </form>
        </div>
    </div>
</body>
</html>
