<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Database connection failed"]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['email']) || empty($data['contacts']) || empty($data['productId']) || empty($data['message'])) {
    die(json_encode(["success" => false, "error" => "Invalid request"]));
}

$customerEmail = $_SESSION['email'];
$productId = intval($data['productId']);
$message = $data['message'];
$time_hour = date("Y-m-d H:i:s");

$productQuery = $conn->query("SELECT category, main_file FROM products WHERE p_id = $productId");
$product = $productQuery->fetch_assoc();
if (!$product) {
    die(json_encode(["success" => false, "error" => "Product not found"]));
}

$image = $product['category'] . "/" . $product['main_file'];
$customerNameQuery = $conn->query("SELECT name FROM users WHERE email = '$customerEmail'");
$customerName = $customerNameQuery->fetch_assoc()['name'];

foreach ($data['contacts'] as $contactEmail) {
    $header = "Product Suggestion";
    $from_name = mysqli_fetch_assoc($conn->query("SELECT name FROM users WHERE email='{$customerEmail}'"))['name'];
    $to_name = mysqli_fetch_assoc($conn->query("SELECT name FROM users WHERE email='{$contactEmail}'"))['name'];
    $type = 0;

    $stmt = $conn->prepare("INSERT INTO notification (from_email, to_email, from_name, to_name, image, value, header, message, time_hour, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssi", $customerEmail, $contactEmail, $from_name, $to_name, $image, $productId, $header, $message, $time_hour, $type);
    $stmt->execute();
}

echo json_encode(["success" => true]);
?>
