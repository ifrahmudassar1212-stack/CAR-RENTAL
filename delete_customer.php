<?php
include 'db.php';
$id  = $_POST['customer_id'];
$sql = "DELETE FROM customers WHERE customer_id='$id'";
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($conn);
}
?>