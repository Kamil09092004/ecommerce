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
        #box {
            width: 60%;
            margin-left: 18%;
            background: white;
            padding: 40px;
            padding-top: 20px;
            border-radius: 15px;
            margin-top: 10px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            background: #007bff;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .form-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: center;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-weight: bold;
        }
        input, select, textarea {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }
        textarea {
            height: 100px;
        }
        .full-width {
            grid-column: span 2;
        }
        .side-by-side {
            display: flex;
            gap: 30px;
        }
        .side-by-side .form-group {
            flex: 1;
        }
        button {
            width: 60%;
            margin-left:20%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background: #0056b3;
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
    <div id='box'>
        <h1>Add a New Product</h1>
        <form action="add_product.php" method="post" enctype="multipart/form-data">
            <div class="form-container">
                <div class="form-group">
                    <label>Product Name:</label>
                    <input type="text" name='product_name' required/>
                </div>
                <div class="form-group">
                    <label>Main Image:</label>
                    <input type="file" name='main_image' accept="image/png,image/jpg,image/jpeg" required/>
                </div>
                <div class="form-group full-width">
                    <label>Description:</label>
                    <textarea name='description' required></textarea>
                </div>
                <div class="form-group">
                    <label>Category:</label>
                    <select name="category">
                        <?php
                        $conn=mysqli_connect('localhost','root','','ecommerce');
                        $result=$conn->query('SELECT name,id FROM categories');
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<option value='{$row['name']}_{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Price:</label>
                    <input type="number" name='org_price' required min='10'/>
                </div>
                <div class="side-by-side full-width">
                    <div class="form-group">
                        <label>Discount:</label>
                        <input type='number' name='discount' required min='11' max='100'/>
                    </div>
                    <div class="form-group">
                        <label>Stock Available:</label>
                        <input type="number" name='stock' required min='10'/>
                    </div>
                </div>
                <div class="form-group">
                    <label>Brand:</label>
                    <input type='text' name='brand' required/>
                </div>
                <div class="form-group">
                    <label>General name:</label>
                    <input type='text' name='name' required/>
                </div>
                <div class="form-group full-width">
                    <label>Sub Images:</label>
                    <input type="file" name='sub_files[]' multiple required/>
                </div>
            </div>
            <button type='submit' name='submit_1'>Add Product</button>
        </form>
    </div>
</body>
</html><?php
    if(isset($_POST['submit_1'])){
        $conn=mysqli_connect('localhost','root','','ecommerce');
        $resp=$conn->query('select max(p_id) as id from products');
        if($row=mysqli_fetch_assoc($resp)){
            $z=$row['id']+1;
            $a=$_POST['product_name'];
            $cat=$_POST['category'];
                
            $fileTmpPath = $_FILES['main_image']['tmp_name'];
            //echo"{$fileTmpPath}<br>";
            $fileName = $_FILES['main_image']['name'];
            $ext=pathinfo($fileName,PATHINFO_EXTENSION);
            //echo"{$fileName}<br>";
            move_uploaded_file($fileTmpPath, 'images/'.$cat.'/'.$z.'.'.$ext);
            $f=''.$z.'.'.$ext;
            $prc=$_POST['org_price'];
            $dis=$_POST['discount'];
            $prc_fin=(int)((100-$dis)*($prc/100));
            $stk=$_POST['stock'];
            $nm=$_POST['name'];
            $brd=$_POST['brand'];
            $dsp=$_POST['description'];
            $response=$conn->query("insert into products(p_id,name,main_file,category,org_price,discount,price,stock,general_name,brand,description) values('$z','$a','$f','$cat','$prc','$dis','$prc_fin','$stk','$nm','$brd','$dsp')");
            $dis_2=$dis-10;
            $prc_2=$prc*(100-$dis_2)/100;
            $conn->query("Insert into product_modification(p_id,dis,price) values('$z','$dis_2','$prc_2')");
            $total_count=count($_FILES["sub_files"]["name"]);
            $conn->query("insert into product_images(p_id,sub_file) values('$z','$f')");
            $conn->query("Insert into seq_product(p_id,category) values('$z','$cat')");
            for($i=0;$i<$total_count;$i++){
                $file_tmp = $_FILES["sub_files"]["tmp_name"][$i];
                $ext_1=pathinfo($_FILES["sub_files"]["name"][$i],PATHINFO_EXTENSION);
                $test=$i+1;
                move_uploaded_file($file_tmp,'images/'.$cat.'/'.$z.'_'.$test.'.'.$ext_1);
                $tp_file=$z.'_'.$test.'.'.$ext_1;
                $conn->query("insert into product_images(p_id,sub_file) values('$z','$tp_file')");
            }

            if($response){
                echo "<script type='text/javascript'>alert('product:{$a} added sucessfully');</script>";
            }
        }
    }
?>
