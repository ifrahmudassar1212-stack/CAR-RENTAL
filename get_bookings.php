<?php
// 1. Clear any accidental whitespace or text outputs from db.php
ob_start(); 
include 'db.php';
ob_clean(); 

// 2. Set strict JSON response headers
header('Content-Type: application/json; charset=utf-8');

$result = mysqli_query($conn, "SELECT * FROM bookings ORDER BY date_rent DESC");
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// 3. Output the perfectly formed JSON array
echo json_encode($data);

// 4. Force the script to stop immediately so no trailing data can append
exit(); 
?>
