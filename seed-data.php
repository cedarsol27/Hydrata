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
<title>Hydrata - Seed Data</title>
</head>
<body>
<header class="site-header" role="banner">
    <div id="nav-placeholder"></div>
</header>
<fieldset class="form-container container-md container-sm">
    <h2 class="data-heading">Seed Data</h2>
    <div class="row">
        <div class="fields col-sm col-md">
            <form class="row form-group" method="POST" action="seed-add.php" style="width: 50%;">
                <p class="row">
                <?php 
                    // pull from crop table
                    require 'connect.php';
                    $sql = "SELECT * FROM seed";
                    $result = mysqli_query($conn, $sql);

                    // display crop option from table
                    echo "<label for='seed'>Seed:</label>";
                    echo "<select id='seed' name='seed'>";
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['seedID']."'>" . $row['seedName'].'</option>';
                    }
                    echo "</select>";  
                ?>
                </p>

                <p class="row">
                    <label>Date Planted: </label>
                    <input type="date" id="dateCheck" name="dateCheck"/>
                    <label>Quantity: </label>
                    <input type="integer" id="quantity" name="quantity" value="0" min="1" max="499" />
                </p>

                <p>
                    <label for="comments">Comments:</label>
                    <br>
                    <textarea type="text" id="idlabel" name="comment" cols="10" rows="10" 
                    class="field-medium"></textarea>
                </p>
                <input type="submit" value="Submit Data" id="adddata" />
                <input type="button" value="Add New Seed" id="newcrop" onclick="addSeed()"/>
            </form>
        </div>
    
    <!-- Alerts and Reminders -->

    <div class="fields col-sm col-md">
    <?php include 'calendar.php'; ?>
    </div>
        </table>
    </div>
</fieldset>
<footer>
    James Pesta - &copy;2021 - 
    <script>document.write(new Date().getFullYear());</script>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</html>