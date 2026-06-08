<?php
include 'db.php';
$id  = $_POST['history_id'];
$sql = "DELETE FROM history WHERE history_id='$id'";
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($conn);
}
?>