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
    <th>Data ID</th>
    <th>Crop</th>
    <th>Date</th>
    <th>Air Temp</th>
    <th>Water Temp</th>
    <th>pH - Initial</th>
    <th>pH - Adjustment</th>
    <th>EC</th>
    <th>Comments</th>
  </tr>";

switch ($data) {
  case 'dataID':
    $sql = "SELECT bath.cropName, bath_info.dataID, bath_info.dateCheck, bath_info.air, bath_info.water, bath_info.phbefore, 
    bath_info.phafter, bath_info.ec, bath_info.comment FROM bath INNER JOIN bath_info ON 
    bath.bathID = bath_info.bathID WHERE bath_info.dataID LIKE '$search'";
    break;

  case 'cropName': 
    $sql = "SELECT bath.cropName, bath_info.dataID, bath_info.dateCheck, bath_info.air, bath_info.water, bath_info.phbefore, 
    bath_info.phafter, bath_info.ec, bath_info.comment FROM bath INNER JOIN bath_info ON 
    bath.bathID = bath_info.bathID WHERE bath.cropName LIKE '$search%'";
    break;

  case 'dateCheck': 
    $sql = "SELECT bath.cropName, bath_info.dataID, bath_info.dateCheck, bath_info.air, bath_info.water, bath_info.phbefore, 
    bath_info.phafter, bath_info.ec, bath_info.comment FROM bath INNER JOIN bath_info ON 
    bath.bathID = bath_info.bathID WHERE bath_info.dateCheck LIKE '$search'";
    break;
}

$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
  foreach($result as $row ){
  echo "
    <tr>
      <td>" . $row['dataID']."</td>
      <td>" . $row['cropName']."</td>
      <td>" . $row['dateCheck']."</td>
      <td>" . $row['air'] ."</td>
      <td>" . $row['water'] ."</td>
      <td>" . $row['phbefore'] ."</td>
      <td>" . $row['phafter'] ."</td>
      <td>" . $row['ec'] ."</td>
      <td>" . $row['comment'] ."</td>
    </tr>
    ";
    
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
