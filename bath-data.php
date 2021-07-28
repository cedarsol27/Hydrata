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
    /*=================== nav script =================== */

        $(function(){
            $("#nav-placeholder").load("nav.php");
        });


        $(document).ready(function() {
            $('#adddata').click(function() {
                var crop = $('#crop').val();
                var dateCheck = $('#dateCheck').val();
                var air = $('#air').val();
                var water = $('#water').val();
                var phbefore = $('#phbefore').val();
                var phafter = $('#phafter').val();
                var ec = $('#ec').val();
                var comment = $('#comment').val();

                $.ajax({
                    url: "bath-add.php",
                    type: "POST",
                    data: {
                        crop:crop,
                        dateCheck:dateCheck,
                        air:air,
                        water:water,
                        phbefore:phbefore,
                        phafter:phafter,
                        ec:ec,
                        comment:comment
                    },
                    success: function(data) {
                        // alert("success!");
                        $("#adddata").removeAttr("disabled");
                        $("#bathForm").find('input:text').val("");
                        $("#success").show();
                        $("#success").html("Data added successfully!");
                    }
                });
            });
        });
</script>
<title>Hydrata - Bath Data</title>
</head>
<body>
<!-- =================== Nav Bar (nav.php) =================== -->
<header class="site-header" role="banner">
    <div id="nav-placeholder"></div>
</header>
<fieldset class="form-container container-md">
    <h2 class="data-heading">Bath Data</h2>
    <div class="row">

        <!-- =================== crop data form =================== -->
        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	    </div>
        <div class="fields col-sm col-md">
            <form class="row form-group" id="bathForm" style="width: 50%;">
                <p class="row">
                <?php 

                    // pull from crop database table
                    require_once 'connect.php';
                    $sql = "SELECT * FROM bath";
                    $result = mysqli_query($conn, $sql);

                    // display crops from table
                    echo "<label for='crop'>Bath:</label>";
                    echo "<select id='crop' name='crop'>";
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['bathID']."'>" . $row['cropName'].'</option>';
                    }
                    echo "</select>";  
                ?>
                </p>

                <p class="row">
                    <label for="date">Date:</label>
                    <input type="date" id="dateCheck" class="form-control" name="dateCheck"/>
                </p>

                <p class="row">
                    <label for="air-temp">Air Temp:</label>
                    <input type="decimal" id="air" name="air" class="form-control" value="0" min="40" max="120" />
                    <label for="water-temp">Water Temp:</label>
                    <input type="decimal" id="water" name="water" class="form-control" value="0" min="40" max="120"/>
                </p>

                <p class="row">
                    <label for="ph-before">pH Initial:</label>
                    <input type="decimal" id="phbefore" name="phbefore" class="form-control" value="0" min="1" max="14" />
                    <label for="ph-after">pH Adjustment:</label>
                    <input type="decimal" id="phafter" name="phafter" class="form-control" value="0" min="1" max="14" />
                </p>

                <p class="row">
                    <label for="ec">EC:</label>
                    <input type="decimal" id="ec" name="ec" class="form-control" value="0" min="0" max="5" />
                </p>

                <p>
                    <label for="comments">Comments:</label>
                    <br>
                    <textarea type="text" id="comment" name="comment" cols="10" rows="10" class="field-medium"></textarea>
                </p>
                <input type="submit" id="adddata" value="Submit Data" />
                <input type="button"  value="Add New Bath" id="newcrop" onclick="addNew()"/>
            </form>
        </div>

        <!-- Alerts and Reminders -->

        <div class="fields col-sm col-md" >
            <?php include 'calendar.php'; ?>
        </div>
    </div>
</fieldset>
<footer>
    James Pesta - &copy;2021 - 
    <script>document.write(new Date().getFullYear());</script>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
</html>