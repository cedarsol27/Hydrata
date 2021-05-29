<?php
require 'connect.php';

$id = $_POST['editData'];
$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $del_   sql)) {
    mysqli_close($conn);
    header("Location: confirm.html");
}

else {
    echo "<p>ERROR: Not able to execute $sql. </p" . mysqli_error($conn);
}
      
mysqli_close($conn);