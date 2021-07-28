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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<meta charset="utf-8">
<meta name="description" content="An API to track your gardening data">
<meta name="keywords" content="Garden, hydroponic, agriculture, sustainability">
<meta name="author" content="James Pesta">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
<script src='select2/dist/js/select2.min.js'></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="./scripts/script.js"></script>
<script>
    // Nav Bar
    $(function(){
        $("#nav-placeholder").load("nav.php");
    });

    // Ajax for loading search panel
    function showData(str) {
        if (str == "") {
            document.getElementById("displayData").innerHTML = "";
            return;
        } 
        else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("displayData").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET",str+"-search-form.php");
            xmlhttp.send();
        }
    }
</script>
<title>Hydrata - Bath Data</title>
</head>
<body>
<header class="site-header" role="banner">
    <div id="nav-placeholder"></div>
</header>
<fieldset class="form-container container-md">
<h2 class="data-heading" id="h2Hide">Previous Data</h2>
    <div class="row" style="margin:0;">
        <!-- Create AJAX to select from different databases -->

        <div class='search'>Select Database Table: 
            <select id='query' name='query' onchange="showData(this.value)">
            <option value='' selected>-Select an option-</option>
            <option value='bath' id='bath'>Bath Data</option>
            <option value='seed'>Seed Data</option>
            </select>
        </div>
        <div id="displayData"></div>
    </div>
</fieldset>
<footer>
    James Pesta - &copy;2021 - 
    <script>document.write(new Date().getFullYear());</script>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
</html>