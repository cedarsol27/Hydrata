<?php

require_once 'connect.php';

$delCal = $_GET['id'];
$query = "DELETE FROM reminders WHERE id = $delCal";
$result = mysqli_query($conn, $query);

if (mysqli_query($conn, $result)) {
    // change confirmation 
    echo '<script>alert("Data removed successfully!</script>';
    header("Location: home.php");
}

else {
    echo "<p>ERROR: Not able to execute $query. </p>" . mysqli_error($conn);
}
      
mysqli_close($conn);