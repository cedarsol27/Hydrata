<?php
/*=================== If user is not logged in build login form =================== */
session_start();
if ((!isset($_POST['username'])) || (!isset($_POST['password'])))
{


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<link rel="stylesheet" href="./styles/login.css" type="text/css">
</head>
<body>
	<!-- =================== Login =================== -->
	<div class="login">
		<h1>Hydrata Login</h1>
				<!-- =================== Authenticate =================== -->
		<form action="authenticate.php" method="post">
			<label for="username">
				<i class="fas fa-user"></i>
			</label>
			<input type="text" name="username" placeholder="Username" id="username" required/>
			<label for="password">
				<i class="fas fa-lock"></i>
			</label>
			<input type="password" name="password" placeholder="Password" id="password" required/>
			<input type="submit" value="Login">
			<h3><a href="new-user.html">New User?</a></h3>
		</form>
	</div>
</body>
</html>
<?php
/*=================== If user is logged in go to home.php =================== */
}
else {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
	header("Location: home.php");
}