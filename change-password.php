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
<div class="form-container container-md container-sm">
	<h2 class="data-heading">Change Password</h2>
	<div style="margin-left:10px;" class="col-sm col-md">
		<form method="POST" action="change-submit.php" enctype="multipart/form-data">
		<table>
			<tr>
			<label for="password">New password: </label>
				<input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" 
					title="Password must contain at least one number, one uppercase and lowercase letter, 
					and at least 6 characters"
					placeholder="Password" id="password" required/><br>
				<div class="password-meter-message">
					<div class="password-meter-message"></div>
					<div class="password-meter-bg">
						<div class="password-meter-bar"></div>
					</div>
				</div>
			</tr>
			<tr>
				<label for="confirm_password">Re-type password: </label>
				<input type="password" name="confirm_password" placeholder="Password" id="confirm_password" 
				required/><br>
			</tr>
			<input class="bttn" type="submit" value="Submit">
		</table>
	</form>
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