<?php
ob_start();
include 'db.php';
ob_clean();

if (
    isset($_POST['rental_id']) && 
    isset($_POST['customer_id']) && 
    isset($_POST['car_id']) && 
    isset($_POST['payment_id']) && 
    isset($_POST['location']) && 
    isset($_POST['date_rent']) && 
    isset($_POST['date_return'])
) {
    $rental_id   = trim($_POST['rental_id']);
    $customer_id = trim($_POST['customer_id']);
    $car_id      = trim($_POST['car_id']);
    $payment_id  = trim($_POST['payment_id']);
    $location    = trim($_POST['location']);
    $date_rent   = trim($_POST['date_rent']);
    $date_return = trim($_POST['date_return']);

    $query = "UPDATE bookings SET customer_id = ?, car_id = ?, payment_id = ?, location = ?, date_rent = ?, date_return = ? WHERE rental_id = ?";
    $stmt  = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $customer_id, $car_id, $payment_id, $location, $date_rent, $date_return, $rental_id);
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
