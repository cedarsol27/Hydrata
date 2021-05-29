<?php
require 'connect.php';

// pull name from Add new crop
$crop = $_GET['crop'];
$seed = $_GET['seed'];

if ($crop) {
  $sql = "INSERT INTO bath (cropName) VALUES ('{$crop}')";
  if (mysqli_query($conn, $sql)){
      echo "<p>Crop inserted successfully!</p>";
      header("Location: confirm.html");
      } 
      else {
        echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
      }
}
if ($seed){
  $sql = "INSERT INTO seed (seedName) VALUES ('{$seed}')";
  if (mysqli_query($conn, $sql)){
      echo "<p>Crop inserted successfully!</p>";
      header("Location: confirm.html");
      } 
      else {
        echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
      }
  }
mysqli_close($conn);