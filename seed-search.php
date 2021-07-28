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
<html lang="en">
<head>
<link href="styles/style.css" rel="stylesheet">
<link href="styles/form.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<meta charset="utf-8">
<meta name="description" content="An API to track your gardening data">
<meta name="keywords" content="Garden, hydroponic, agriculture, sustainability">
<meta name="author" content="James Pesta">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="scripts/script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
  $("#nav-placeholder").load("nav.php");
});
</script>
<title>Hydrata - Seed Search Results</title>
</head>
<body class='body'>
<header class="site-header" role="banner">
    <div id="nav-placeholder"></div>
</header>
<div class="form-container container-md">
<h2 class="data-heading">Hydrata - Search Results</h2>

<?php
require 'connect.php';

$data = filter_var($_POST['query'], FILTER_SANITIZE_STRING);
$search = filter_var($_POST['values'], FILTER_SANITIZE_STRING);

echo "
<table>
  <tr class='displayQuery' style='border: solid;'>
    <th>Entry ID</th>
    <th>Seed</th>
    <th>Date</th>
    <th>Quantity</th>
    <th>Comments</th>
  </tr>";

switch ($data) {
  case 'seedDataID':
    $sql = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, seed_info.comment 
    FROM seed INNER JOIN seed_info ON seed.seedID = seed_info.seedID WHERE seed_info.seedDataID LIKE '$search'";
    break;

  case 'seedName': 
    $sql = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, seed_info.comment 
    FROM seed INNER JOIN seed_info ON seed.seedID = seed_info.seedID WHERE seed.seedName LIKE '$search%'";
    break;

  case 'dateCheck': 
    $sql = "SELECT seed.seedName, seed_info.seedDataID, seed_info.dateCheck, seed_info.quantity, seed_info.comment 
    FROM seed INNER JOIN seed_info ON seed.seedID = seed_info.seedID WHERE seed_info.dateCheck LIKE '$search'";
    break;
}

$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
  foreach($result as $row ){
  echo "
    <tr class='displayQuery'>
      <td>" . $row['seedDataID']."</td>
      <td>" . $row['seedName']."</td>
      <td>" . $row['dateCheck']."</td>
      <td>" . $row['quantity'] ."</td>
      <td>" . $row['comment'] ."</td>
    </tr>";
  }
} 
else {
  echo "<p>ERROR: Not able to execute $sql. </p>" . mysqli_error($conn);
}
echo "</table>";

mysqli_close($conn);
?>
    </table>
    <a href='bath-data.php'><button type='button' class='bttn'>Go Back</button></a>
</div>
</body>
</html>