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
require_once 'connect.php';

// We don't have the password or email info stored in sessions so instead we can get the 
// results from the database.
$stmt = $conn->prepare('SELECT accounts.firstname, accounts.lastname, accounts.password, 
accounts.email, access.accessTitle FROM accounts INNER JOIN access ON accounts.accessLevel 
= access.accessLevel WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $password, $email, $access);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="styles/style.css" rel="stylesheet">
<link href="styles/form.css" rel="stylesheet">
<link href="styles/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<meta charset="utf-8">
<meta name="description" content="An API to track your gardening data">
<meta name="keywords" content="Garden, hydroponic, agriculture, sustainability">
<meta name="author" content="James Pesta">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="scripts/script.js"></script>
<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
  	$("#nav-placeholder").load("nav.php");
});
</script>
</head>
<body class="loggedin">
<header class="site-header" role="banner">
    <div id="nav-placeholder"></div>
</header>
<div class="form-container container-md">
	<h2 class="data-heading">Profile Page</h2>
	<div class="row"><br/>
		<p>Your account details are below:</p>
		<table class="fields table profile-table">
			<tr class="d-flex">
				<td class="col-3">Name:</td>
				<td><?=$firstname . " " . $lastname?></td>
			</tr>
			<tr class="d-flex">
				<td class="col-3">Username:</td>
				<td><?=$_SESSION['name']?></td>
			</tr>
			<tr class="d-flex">
				<td class="col-3">Password:</td>
				<td>******* &emsp;<a href="change-password.php">Change password</td>
			</tr>

			<tr class="d-flex">
				<td class="col-3">Email:</td>
				<td><?=$email?></td>
			</tr>
			<tr class="d-flex">
				<td class="col-3">Privileges:</td>
				<td><?=$access?></td>
		</table>
	</div>
</div>
<footer>
    James Pesta - &copy;2021 - 
    <script>document.write(new Date().getFullYear());</script>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
</html>