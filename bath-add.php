<?php
require_once 'connect.php';

/*=================== This adds the crop data =================== */

$crop = filter_var($_POST['crop'], FILTER_SANITIZE_STRING);
$dateCheck = filter_var($_POST['dateCheck'], FILTER_SANITIZE_STRING);
$air = filter_var($_POST['air'], FILTER_SANITIZE_STRING);
$water = filter_var($_POST['water'], FILTER_SANITIZE_STRING);
$phbefore = filter_var($_POST['phbefore'], FILTER_SANITIZE_STRING);
$phafter = filter_var($_POST['phafter'], FILTER_SANITIZE_STRING);
$ec = filter_var($_POST['ec'], FILTER_SANITIZE_STRING);
$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

$sql = "INSERT INTO bath_info ( bathID, dateCheck, air, water, phbefore, phafter, ec, comment) VALUES 
('$crop', '$dateCheck', '$air', '$water', '$phbefore', '$phafter', '$ec', '$comment')";

if(mysqli_query($conn, $sql)){
  echo json_encode(array("statusCode" => 200));
    // echo "<script>alert('Complete')</script>";
} else {
  echo json_encode(array("statusCode" => 201));
  // echo "<p>ERROR: Not able to execute $sql. </p" . mysqli_error($conn);
}

mysqli_close($conn);