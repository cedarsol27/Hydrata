<?php
require 'connect.php';

$data = $_POST['query'];
$search = $_POST['values'];

echo "
<table>
  <tr style='border: solid;'>
    <th>Entry ID</th>
    <th>Seed</th>
    <th>Date</th>
    <th>Quantity</th>
    <th>Comments</th>
  </tr>";
  
switch ($data) {

  // Get seed id
  case 'seedDataID':
    $sql = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, 
    seed_info.comment FROM seed INNER JOIN seed_info ON seed.seedID = seed_info.seedID WHERE 
    seed_info.seedDataID LIKE '$search'";
    break;

  // Get seed name
  case 'seedName': 
    $sql = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, 
    seed_info.comment FROM seed INNER JOIN seed_info ON seed.seedID = seed_info.seedID WHERE 
    seed.seedName LIKE '$search%'";
    break;

  // Get date checked
  case 'dateCheck': 
    $sql = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, 
    seed_info.comment FROM seed INNER JOIN seed_info ON seed.seedID = seed_info.seedID WHERE 
    seed_info.dateCheck LIKE '$search'";
    break;
}

$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
  foreach($result as $row ){
  echo "
    <tr>
      <td>" . $row['seedDataID'] . "</td>
      <td>" . $row['seedName'] . "</td>
      <td>" . $row['dateCheck'] . "</td>
      <td>" . $row['quantity'] . "</td>
      <td>" . $row['comment'] . "</td>
    </tr>";
  }
} 
else {
  echo "
  <p>ERROR: Not able to execute $sql. </p>
  " . mysqli_error($conn);
}
echo "
</table>
";

mysqli_close($conn);
?>
