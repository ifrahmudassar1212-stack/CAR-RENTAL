<?php
// 1. Trap and clear out any accidental whitespaces or echo leaks from db.php
ob_start(); 
include 'db.php';
ob_clean(); 

// 2. Set the correct content header for parsing JSON data strings
header('Content-Type: application/json; charset=utf-8');

// 3. Executed clean single-space query sorted chronologically by History ID
$result = mysqli_query($conn, "SELECT * FROM history ORDER BY history_id DESC");
$data = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

// 4. Print clean single-array JSON output and exit immediately
echo json_encode($data);
exit();
?>
