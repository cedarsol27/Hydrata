<?php
require_once 'connect.php';

// pull name from Add new crop
$crop = $_GET['crop'];
$seed = $_GET['seed'];

/*=================== if a value in crop is selected, insert data =================== */

if ($crop) {
  $sql = "INSERT INTO bath (cropName) VALUES ('{$crop}')";
  if (mysqli_query($conn, $sql)){
    
    // change confirmation location to an alert

    echo '<script>alert("Bath entered into database!");
    window.location.href = "bath-data.php";
    </script>';
      } 
      else {
        echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
      }
}
/*=================== if a value in seed is selected, insert data =================== */

if ($seed){
  $sql = "INSERT INTO seed (seedName) VALUES ('{$seed}')";
  if (mysqli_query($conn, $sql)){

    // change confirmation location to an alert

    echo '<script>alert("Seed entered into database!");
    window.location.href = "seed-data.php";
    </script>';
    // header("Location: seed-data.php");
  } 
  else {
    echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
  }
}
mysqli_close($conn);
