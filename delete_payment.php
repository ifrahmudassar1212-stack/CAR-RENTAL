<?php
include 'db.php';
$id  = $_POST['payment_id'];
$sql = "DELETE FROM payments WHERE payment_id='$id'";
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($conn);
}
?>