<?php
ob_start();
include 'db.php';
ob_clean();

if (
    isset($_POST['customer_id']) && 
    isset($_POST['full_name']) && 
    isset($_POST['email']) && 
    isset($_POST['phone']) && 
    isset($_POST['city']) && 
    isset($_POST['joined_date'])
) {
    $customer_id = trim($_POST['customer_id']);
    $full_name   = trim($_POST['full_name']);
    $email       = trim($_POST['email']);
    $phone       = trim($_POST['phone']);
    $city        = trim($_POST['city']);
    $joined_date = trim($_POST['joined_date']);

    $query = "UPDATE customers SET full_name = ?, email = ?, phone = ?, city = ?, joined_date = ? WHERE customer_id = ?";
    $stmt  = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $full_name, $email, $phone, $city, $joined_date, $customer_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "Database error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Statement failed: " . mysqli_error($conn);
    }
} else {
    echo "Missing parameters";
}
mysqli_close($conn);
?>
