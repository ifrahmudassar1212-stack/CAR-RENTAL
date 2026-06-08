<?php
// 1. Trap and clear out any accidental text or spaces echoed by db.php
ob_start(); 
include 'db.php';
ob_clean(); 

// 2. Explicitly tell the browser to treat this as strict JSON data
header('Content-Type: application/json; charset=utf-8');

$result = mysqli_query($conn, "SELECT * FROM payments ORDER BY payment_date DESC");
$data = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

// 3. Print the perfectly formed single JSON dataset
echo json_encode($data);

// 4. Force the server to stop immediately so no background duplicates can execute
exit(); 
?>
