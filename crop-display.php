<?php

require 'connect.php';

$data = "SELECT bath.cropName, bath_info.dataID, bath_info.dateCheck, bath_info.air, bath_info.water, bath_info.phbefore, 
bath_info.phafter, bath_info.ec, bath_info.comment FROM bath INNER JOIN bath_info ON 
bath.bathID = bath_info.bathID ORDER BY bath_info.dateCheck DESC";

$result = mysqli_query($conn, $data);

for ($i = 0; $i < 20; $i++) {
    $row = mysqli_fetch_array($result);
    echo 
        "<tr>
        <td>" . $row['dataID']."</td>
        <td>" . $row['cropName']."</td>
        <td>" . $row['dateCheck']."</td>
        <td>" . $row['air'] ."</td>
        <td>" . $row['water'] ."</td>
        <td>" . $row['phbefore'] ."</td>
        <td>" . $row['phafter'] ."</td>
        <td>" . $row['ec'] ."</td>
        <td>" . $row['comment'] ."</td>
        </tr>";
}
mysqli_close($conn);