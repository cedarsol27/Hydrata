<?php

require_once 'connect.php';

$id = $_POST['editData'];
$delCal = $_GET['id'];
$query = "DELETE FROM bath_info WHERE 'dataID' = '$delCal'";
$result = mysqli_query($conn, $query);

if (mysqli_query($conn, $result)) {
    mysqli_close($conn);

    // change confirmation 

    header("Location: confirm.html");
}

else {
    echo "<p>ERROR: Not able to execute $query. </p>" . mysqli_error($conn);
}
      
mysqli_close($conn);