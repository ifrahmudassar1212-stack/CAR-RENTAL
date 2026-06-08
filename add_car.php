<?php
include 'db.php';
$id       = $_POST['car_id'];
$name     = $_POST['car_name'];
$category = $_POST['category'];
$price    = $_POST['price_per_day'];
$image    = $_POST['image_url'];
$status   = $_POST['status'];

$sql = "INSERT INTO cars 
        (car_id, car_name, category, price_per_day, image_url, status)
        VALUES ('$id','$name','$category','$price','$image','$status')";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($conn);
}
?>