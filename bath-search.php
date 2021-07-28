<?php
session_start();

if (isset($_SESSION['loggedin'])) {
    if(time()-$_SESSION['login_time_stamp'] > 1200) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        // The session should automatically destroy after 10 minutes = 10*60 seconds = 600 seconds
    }
}
else {
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="styles/style.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
/*=================== nav script =================== */
$(function(){
  $("#nav-placeholder").load("nav.php");
});
</script>
<meta charset="utf-8">
<meta name="description" content="An API to track your gardening data">
<meta name="keywords" content="Garden, hydroponic, agriculture, sustainability">
<meta name="author" content="James Pesta">
<title>Hydrata - Search Results</title>
<script>
    $(function(){
        $("#nav-placeholder").load("bath-search-form.html");
    });
</script>
</head>
<body class='body'>
<header class="site-header" role="banner">
    <div id="nav-placeholder"></div>
</header>
<div class="form-container container-md">
    <h2 class="data-heading">Hydrata - Bath Search Results</h2>

<?php
require 'connect.php';

$data = filter_var($_POST['query'], FILTER_SANITIZE_STRING);
$search = filter_var($_POST['values'], FILTER_SANITIZE_STRING);

echo "
<table class='ajax-table'>
  <tr class='displayQuery''>
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
    <tr class='displayQuery'>
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
  echo "<p>ERROR: Not able to execute $sql. </p>" . mysqli_error($conn);
}
echo "</table>";

mysqli_close($conn);

?>
</table>
</div>
<footer>
    James Pesta - &copy;2021 - 
    <script>document.write(new Date().getFullYear());</script>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" 
  crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
</html>