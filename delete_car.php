<?php
include 'db.php';
$id  = $_POST['car_id'];
$sql = "DELETE FROM cars WHERE car_id='$id'";
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($conn);
}
?>