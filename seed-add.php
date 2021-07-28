<?php
session_start();
require_once 'connect.php';

$seed = filter_var($_POST['seed'], FILTER_SANITIZE_STRING);
$dateCheck = filter_var($_POST['dateCheck'], FILTER_SANITIZE_STRING);
$quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);
$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

$sql = "INSERT INTO seed_info (seedID, dateCheck, quantity, comment) VALUES 
('$seed', '$dateCheck', '$quantity', '$comment')"; 

if (mysqli_query($conn, $sql)) {
    echo '<script>alert("Seed entered into database!");</script>';
    header("Location: seed-data.php");
} 
else {
  echo "<p>ERROR: Not able to execute $sql. </p>" . mysqli_error($conn);
}

mysqli_close($conn);
