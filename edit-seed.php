<?php
require 'connect.php';

$id = $_POST['editData'];
$data = $_POST['editQuery'];
$value = $_POST['editValue'];

if ($_POST['Edit']){
    switch ($data) {
        case 'seedName':
            $sql = "UPDATE seed_info SET seedID = (SELECT seed.seedID FROM seed WHERE seed.seedName = '$value') WHERE seedDataID = '$id'";
            break;
        case 'dateCheck':
            $sql = "UPDATE seed_info SET dateCheck = '$value' WHERE seedDataID = '$id'";
            break;
        case 'quantity':
            $sql = "UPDATE seed_info SET quantity = '$value' WHERE seedDataID = '$id'";
            break;
        case 'comment':
            $sql = "UPDATE seed_info SET comment = '$value' WHERE seedDataID = '$id'";
            break;
    }
}
else if ($_POST['Delete']) {
    $sql = "DELETE FROM seed_info WHERE seedDataID = '$id'";
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