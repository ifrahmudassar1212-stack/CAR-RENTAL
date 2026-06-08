<?php
ob_start();
include 'db.php';
ob_clean();

if (
    isset($_POST['history_id']) && 
    isset($_POST['car_id']) && 
    isset($_POST['rental_id']) && 
    isset($_POST['payment_id']) && 
    isset($_POST['time_rented']) && 
    isset($_POST['status'])
) {
    $history_id  = trim($_POST['history_id']);
    $car_id      = trim($_POST['car_id']);
    $rental_id   = trim($_POST['rental_id']);
    $payment_id  = trim($_POST['payment_id']);
    $time_rented = trim($_POST['time_rented']);
    $status      = trim($_POST['status']);

    $query = "UPDATE history SET car_id = ?, rental_id = ?, payment_id = ?, time_rented = ?, status = ? WHERE history_id = ?";
    $stmt  = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $car_id, $rental_id, $payment_id, $time_rented, $status, $history_id);
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
