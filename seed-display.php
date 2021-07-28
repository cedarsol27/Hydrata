<?php
session_start();
require_once 'connect.php';

$data = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, seed_info.comment FROM seed 
INNER JOIN seed_info ON 
seed.seedID = seed_info.seedID ORDER BY seed_info.dateCheck DESC";

$result = mysqli_query($conn, $data);
$total_rows = mysqli_affected_rows($conn);
if ($total_rows > 20) {
    $row_limit = 20;
}
else {
    $row_limit = $total_rows;
}


for ($i = 0; $i < $row_limit; $i++) {
    $row = mysqli_fetch_array($result);
    echo 
        "<tr class='displayQuery'>
        <td>" . $row['seedDataID']."</td>
        <td>" . $row['seedName']."</td>
        <td>" . $row['dateCheck']."</td>
        <td>" . $row['quantity']."</td>
        <td>" . $row['comment']."</td>
        </tr>";
}
mysqli_close($conn);