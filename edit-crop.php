<?php
require 'connect.php';

$id = $_POST['editData'];
$data = $_POST['editQuery'];
$value = $_POST['editValue'];

if ($_POST['Edit']){
    switch ($data) {
        case 'cropName':
            $sql = "UPDATE bath_info SET bathID = (SELECT bath.bathID FROM bath WHERE bath.cropName = '$value') WHERE dataID = '$id'";
            break;
        case 'dateCheck':
            $sql = "UPDATE bath_info SET dateCheck = '$value' WHERE dataID = '$id'";
            break;
        case 'air':
            $sql = "UPDATE bath_info SET air = '$value' WHERE dataID = '$id'";
            break;
        case 'water':
            $sql = "UPDATE bath_info SET water = '$value' WHERE dataID = '$id'";
            break;
        case 'phbefore':
            $sql = "UPDATE bath_info SET phbefore = '$value' WHERE dataID = '$id'";
            break;
        case 'phafter':
            $sql = "UPDATE bath_info SET phafter = '$value' WHERE dataID = '$id'";
            break;
        case 'ec':
            $sql = "UPDATE bath_info SET ec = '$value' WHERE dataID = '$id'";
            break;
        case 'comment':
            $sql = "UPDATE bath_info SET comment = '$value' WHERE dataID = '$id'";
            break;
    }
}
    else if ($_POST['Delete']) {
        $sql = "DELETE FROM bath_info WHERE dataID = '$id'";
    }
$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: confirm.html");
}
else {
    echo "<p>ERROR: Not able to execute $sql. </p" . mysqli_error($conn);
}
      
mysqli_close($conn);