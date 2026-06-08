<?php
ob_start();
include 'db.php';
ob_clean();

if (
    isset($_POST['payment_id']) && 
    isset($_POST['customer_id']) && 
    isset($_POST['car_id']) && 
    isset($_POST['payment_mode']) && 
    isset($_POST['amount']) && 
    isset($_POST['payment_date'])
) {
    $payment_id   = trim($_POST['payment_id']);
    $customer_id  = trim($_POST['customer_id']);
    $car_id       = trim($_POST['car_id']);
    $payment_mode = trim($_POST['payment_mode']);
    $amount       = trim($_POST['amount']);
    $payment_date = trim($_POST['payment_date']);

    $query = "UPDATE payments SET customer_id = ?, car_id = ?, payment_mode = ?, amount = ?, payment_date = ? WHERE payment_id = ?";
    $stmt  = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $customer_id, $car_id, $payment_mode, $amount, $payment_date, $payment_id);
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
