<?php

require 'connect.php';

// insert data and trim any blankspace
$crop = $_POST['crop'];
$dateCheck = $_POST['dateCheck'];
$air = trim($_POST['air']);
$water = trim($_POST['water']);
$phbefore = trim($_POST['phbefore']);
$phafter = trim($_POST['phafter']);
$ec = trim($_POST['ec']);
$comment = $_POST['comment'];


$sql = "INSERT INTO bath_info ( bathID, dateCheck, air, water, phbefore, phafter, ec, comment) VALUES 
('$crop', '$dateCheck', '$air', '$water', '$phbefore', '$phafter', '$ec', '$comment')"; 

if (mysqli_query($conn, $sql)) {
    echo "<p>Data entered successfully</p>";
    header("Location: confirm.html");
} else {
  echo "<p>ERROR: Not able to execute $sql. </p" . mysqli_error($conn);
}

mysqli_close($conn);