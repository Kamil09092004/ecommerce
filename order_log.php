<?php
$ipAddress = $_SERVER['REMOTE_ADDR'];
#echo "User IP Address: " . $ipAddress;
$link = urlencode("{$ipAddress}:8080/ecommerce/log_track.php?order_id=1");  // Encode the URL
$size = 300;

// Generate QR Code using QuickChart.io (No GD required)
$qrcode_url = "https://quickchart.io/qr?text={$link}&size={$size}";

echo "<img src='$qrcode_url' />";
?>