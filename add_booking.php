<?php
// 1. Clear out hidden output noise or whitespaces
ob_start();
include 'db.php';
ob_clean();

// 2. Validate that the required POST parameters are present
if (
    isset($_POST['rental_id']) && 
    isset($_POST['customer_id']) && 
    isset($_POST['car_id']) && 
    isset($_POST['payment_id']) && 
    isset($_POST['location']) && 
    isset($_POST['date_rent']) && 
    isset($_POST['date_return'])
) {
    // Trim input data fields to strip unexpected trailing space wrappers
    $rental_id   = trim($_POST['rental_id']);
    $customer_id = trim($_POST['customer_id']);
    $car_id      = trim($_POST['car_id']);
    $payment_id  = trim($_POST['payment_id']);
    $location    = trim($_POST['location']);
    $date_rent   = trim($_POST['date_rent']);
    $date_return = trim($_POST['date_return']);

    // 3. Use parameter placeholder question marks (?) to secure SQL structure
    $query = "INSERT INTO bookings 
              (rental_id, customer_id, car_id, payment_id, location, date_rent, date_return) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
              
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // "sssssss" tells MySQL to safely bind 7 incoming string parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $rental_id, $customer_id, $car_id, $payment_id, $location, $date_rent, $date_return);
        
        if (mysqli_stmt_execute($stmt)) {
            // Trim whitespace to keep JS string evaluation from failing
            echo "success"; 
        } else {
            echo "Database error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Statement preparation failed: " . mysqli_error($conn);
    }
} else {
    echo "Error: Missing required form submission fields.";
}

mysqli_close($conn);
?>
