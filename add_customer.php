<?php
include 'db.php';
$id    = $_POST['customer_id'];
$name  = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city  = $_POST['city'];
$date  = $_POST['joined_date'];

$sql = "INSERT INTO customers 
        (customer_id, full_name, email, phone, city, joined_date)
        VALUES ('$id','$name','$email','$phone','$city','$date')";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($conn);
}
?>