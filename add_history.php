<?php
// 1. Trap and clear out any accidental whitespace or text output noise from db.php
ob_start();
include 'db.php';
ob_clean();

// 2. Validate that all required POST variables are present
if (
    isset($_POST['history_id']) && 
    isset($_POST['car_id']) && 
    isset($_POST['rental_id']) && 
    isset($_POST['payment_id']) && 
    isset($_POST['time_rented']) && 
    isset($_POST['status'])
) {
    // Strip trailing or leading spaces automatically
    $history_id  = trim($_POST['history_id']);
    $car_id      = trim($_POST['car_id']);
    $rental_id   = trim($_POST['rental_id']);
    $payment_id  = trim($_POST['payment_id']);
    $time_rented = trim($_POST['time_rented']);
    $status      = trim($_POST['status']);

    // 3. Use parameter markers (?) to prevent SQL structure failures
    $query = "INSERT INTO history 
              (history_id, car_id, rental_id, payment_id, time_rented, status) 
              VALUES (?, ?, ?, ?, ?, ?)";
              
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // "ssssss" binds all 6 incoming fields safely as text string variables
        mysqli_stmt_bind_param($stmt, "ssssss", $history_id, $car_id, $rental_id, $payment_id, $time_rented, $status);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "success"; 
        } else {
            echo "Database insertion failure: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Statement preparation failed: " . mysqli_error($conn);
    }
} else {
    echo "Error: Missing required history parameter inputs.";
}

mysqli_close($conn);
?>
