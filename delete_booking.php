<?php
include 'db.php';
$id  = $_POST['rental_id'];
$sql = "DELETE FROM bookings WHERE rental_id='$id'";
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($conn);
}
?>