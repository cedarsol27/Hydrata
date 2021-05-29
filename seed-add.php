<?php

require 'connect.php';

// insert data and trim any blankspace
$seed = $_POST['seed'];
$dateCheck = $_POST['dateCheck'];
$quantity = $_POST['quantity'];
$comment = $_POST['comment'];


// minor bug with require value for phafter and comment
$sql = "INSERT INTO seed_info ( seedID, dateCheck, quantity, comment) VALUES 
('$seed', '$dateCheck', '$quantity', '$comment')"; 

if (mysqli_query($conn, $sql)) {
    echo "<p>Data entered successfully</p>";
    header("Location: confirm.html");
} else {
  echo "<p>ERROR: Not able to execute $sql. </p" . mysqli_error($conn);
}

mysqli_close($conn);
