<!DOCTYPE html>
<html lang="en">
<head>
<link href="styles/style.css" rel="stylesheet">
<link href="styles/form.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<meta charset="utf-8">
<meta name="description" content="An API to track your gardening data">
<meta name="keywords" content="Garden, hydroponic, agriculture, sustainability">
<meta name="author" content="James Pesta">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="scripts/script.js"></script>
<title>Hydrata - Bath Data</title>
</head>
<body id="body">
<main>
    <h1>Hydrata</h1>
    <fieldset class="form-container container-md">
        <h2 class="data-heading">Crop Data</h2>
        <div class="row">
            <div class="fields col-sm col-md">
                <form class="row form-group" method="POST" action="crop-add.php" style="width: 50%;">
                    <p class="row">
                    <?php 
                        // pull from crop table
                        require 'connect.php';
                        $sql = "SELECT * FROM bath";
                        $result = mysqli_query($conn, $sql);

                        // display crops from table
                        echo "<label for='crop'>Crop:</label>";
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
                        <input type="decimal" id="air" name="air" class="form-control" value="0"/>
                        <label for="water-temp">Water Temp:</label>
                        <input type="decimal" id="water" name="water" class="form-control" value="0"/>
                    </p>

                    <p class="row">
                        <label for="ph-before">pH Initial:</label>
                        <input type="decimal" id="phbefore" name="phbefore" class="form-control" value="0"/>
                        <label for="ph-after">pH Adjustment:</label>
                        <input type="decimal" id="phafter" name="phafter" class="form-control" value="0"/>
                    </p>

                    <p class="row">
                        <label for="ec">EC:</label>
                        <input type="decimal" id="ec" name="ec" class="form-control" value="0"/>
                    </p>

                    <p>
                        <label for="comments">Comments:</label>
                        <br>
                        <textarea type="text" id="comment" name="comment" cols="10" rows="10" class="field-medium"></textarea>
                    </p>
                    <input type="submit" id="adddata" value="Submit Data" />
                    <input type="button"  value="Add New Crop" id="newcrop" onclick="addNew()"/>
                    <button type="submit" id="chngForm" value="Seed Data" formaction="seed-data.php">Seed Data</button>
                </form>
            </div>

            <!-- Alerts and Reminders -->

            <div class="fields col-sm col-md" >
            <?php include 'calendar.php'; ?>
            </div>

            <!-- Show/Hide Previous Data -->

            <h2 class="data-heading" id="h2Hide">Previous Data</h2>
            <button type="button" class="container-fluid" id="showData">Show/Hide Previous Data</button>
            <div id="dataForm">

                <!-- Search form -->
                        
                <form method="POST" action="search.php">
                    <div class='search'>Search in: 
                        <select id='query' name='query'>
                        <option value='dataID'>Data ID</option>
                        <option value='cropName'>Bath Name</option>
                        <option value='dateCheck'>Date</option>
                        </select>
                        Key: <input id='values' name='values' class='field-medium'/>
                        <input type='submit' class='bttn' id="myBtn" value='Search';>
                    </div>
                </form>

                <!-- Delete/Edit Form -->

                <form method="POST" action="edit-crop.php">
                    <div class="delete">Select Data ID: 
                        <input id='editData' size="5" name='editData'> In This Field: 
                        <select id='editQuery' name='editQuery'>
                            <option value='cropName'>Bath Name</option>
                            <option value='dateCheck'>Date</option>
                            <option value='air'>Air Temp</option>
                            <option value='water'>Water Temp</option>
                            <option value='phbefore'>pH Initial Check</option>
                            <option value='phafter'>pH After Additions</option>
                            <option value='ec'>EC</option>
                            <option value='comment'>Comments</option>
                        </select>
                        To This Value: <input id='editValue' size="10" name='editValue'>
                        <input type='submit' name='Edit' class='bttn' value='Edit'>
                        <input type='submit' id='dltBtn' name='Delete' value='Delete'>
                    </div>
                </form>

                <!-- Display Data -->

                <table>
                    <tr style="border-bottom: solid;">
                        <th>Data <br>ID</th>
                        <th>Bath <br>Name</th>
                        <th>Date</th>
                        <th>Air <br>Temp</th>
                        <th>Water <br>Temp</th>
                        <th>pH <br> Initial</th>
                        <th>pH <br> After</th>
                        <th>EC</th>
                        <th>Comments</th>
                    </tr>
                    <?php require 'crop-display.php'; ?>
                </table>
            </div>
    </fieldset>
</main>
<footer>
    James Pesta - &copy;2021 - 
    <script>document.write(new Date().getFullYear());</script>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
</html>