<?php
/*=================== If user is not logged in, head to index.php =================== */

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
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hydrata - Home</title>
</head>
<body class='body'>
<!-- =================== Nav Bar (nav.html) =================== -->
<header class="site-header" role="banner">
    <div id="nav-placeholder"></div>
</header>
<!-- =================== Intro container =================== -->
<div class="container clearfix">
    <h1>Introduction</h1>
    <p class="lead">Welcome to Hydrata, a hydroponic data tracking app.</p>

    <p>This app is designed to keep track of the data for your hydroponic system.
        Hydrata gives you the fields to track the pH, EC, temperature, and your 
        additions. Hydrata also keeps track of the seed that you plant. The alerts are 
        designed to remind you when to plant a new seed.
    </p>
    <p>
        If you have any comments, questions, suggestions, or concerns, please email me at 
        <a href="mailto:jamesmapesta@gmail.com">jamesmapesta@gmail.com</a>
    </p>
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