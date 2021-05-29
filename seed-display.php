<?php

require 'connect.php';

$data = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, seed_info.comment FROM seed 
INNER JOIN seed_info ON 
seed.seedID = seed_info.seedID ORDER BY seed_info.dateCheck DESC";

$result = mysqli_query($conn, $data);

for ($i = 0; $i < 20; $i++) {
    $row = mysqli_fetch_array($result);
    echo 
        "<tr>
        <td>" . $row['seedDataID']."</td>
        <td>" . $row['seedName']."</td>
        <td>" . $row['dateCheck']."</td>
        <td>" . $row['quantity']."</td>
        <td>" . $row['comment']."</td>
        </tr>";
}
mysqli_close($conn);