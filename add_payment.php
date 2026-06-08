<?php
// 1. Trap and discard any accidental whitespace or text output noise from db.php
ob_start();
include 'db.php';
ob_clean();

// 2. Validate that all required POST variables are present
if (
    isset($_POST['payment_id']) && 
    isset($_POST['customer_id']) && 
    isset($_POST['car_id']) && 
    isset($_POST['payment_mode']) && 
    isset($_POST['amount']) && 
    isset($_POST['payment_date'])
) {
    // Strip trailing or leading spaces automatically
    $payment_id   = trim($_POST['payment_id']);
    $customer_id  = trim($_POST['customer_id']);
    $car_id       = trim($_POST['car_id']);
    $payment_mode = trim($_POST['payment_mode']);
    $amount       = trim($_POST['amount']);
    $payment_date = trim($_POST['date_rent']); // Maps to incoming HTML form date field

    // 3. Use parameter markers (?) to enforce secure query execution
    $query = "INSERT INTO payments 
              (payment_id, customer_id, car_id, payment_mode, amount, payment_date) 
              VALUES (?, ?, ?, ?, ?, ?)";
              
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // "ssssss" binds all 6 safely as strings to handle special characters or decimal points securely
        mysqli_stmt_bind_param($stmt, "ssssss", $payment_id, $customer_id, $car_id, $payment_mode, $amount, $payment_date);
        
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
    echo "Error: Missing required payment parameter inputs.";
}

mysqli_close($conn);
?>
