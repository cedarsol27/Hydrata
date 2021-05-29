<!DOCTYPE html>
<html>
<head>
<link href="styles/style.css" rel="stylesheet">
<meta charset="utf-8">
<meta name="description" content="An API to track your gardening data">
<meta name="keywords" content="Garden, hydroponic, agriculture, sustainability">
<meta name="author" content="James Pesta">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hydrata - Search Results</title>
</head>
<body class='body'>
    <h1>Hydrata - Search Results</h1>

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
  case 'seedDataID':
    $sql = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, seed_info.comment FROM seed 
    INNER JOIN seed_info ON 
    seed.seedID = seed_info.seedID WHERE seed_info.seedDataID LIKE '$search'";
    break;

  case 'seedName': 
    $sql = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, seed_info.comment FROM seed 
    INNER JOIN seed_info ON 
    seed.seedID = seed_info.seedID WHERE seed.seedName LIKE '$search%'";
    break;

  case 'dateCheck': 
    $sql = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, seed_info.comment FROM seed 
    INNER JOIN seed_info ON 
    seed.seedID = seed_info.seedID WHERE seed_info.dateCheck LIKE '$search'";
    break;
}

$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
  foreach($result as $row ){
  echo "
    <tr>
      <td>" . $row['seedDataID']."</td>
      <td>" . $row['seedName']."</td>
      <td>" . $row['dateCheck']."</td>
      <td>" . $row['quantity'] ."</td>
      <td>" . $row['comment'] ."</td>
    </tr>";
  }
} 
else {
  echo "<p>ERROR: Not able to execute $sql. </p" . mysqli_error($conn);
}
echo "</table>";

mysqli_close($conn);
?>
    </table>
    <a href='crop-data.php'><button type='button' class='bttn'  >Go Back</button></a>

</body>
</html>
