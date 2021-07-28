<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

?>

<!-- =================== Nav Bar =================== -->

<nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav-placeholder">
    <a class="navbar-brand" href="home.php">Hydrata</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="home.php">Home</a>
            <a class="nav-item nav-link" href="seed-data.php">Seed Data</a>
            <a class="nav-item nav-link" href="bath-data.php">Bath Data</a>
            <a class="nav-item nav-link" href="previous.php">Previous Data</a>
        </div>

        <!-- ===================  User Profile =================== -->

        <div class="nav navbar-nav ms-auto text-end">
            <span class="nav-link disabled">Welcome back, <?=$_SESSION["name"]?>!</span>
            <a class="nav-item nav-link" href="profile.php">Profile</a>
            <a class="nav-item nav-link" href="logout.php">Logout</a>
        </div>    
    </div>
</nav>
