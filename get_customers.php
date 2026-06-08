<?php
// 1. Force the browser to render this as a beautiful, structured data layout
header('Content-Type: application/json; charset=utf-8');

include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM customers ORDER BY joined_date DESC");
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
echo json_encode($data);
?>
