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
<title>Hydrata - Seed Data</title>
</head>
<body id="body">
<main>
    <h1>Hydrata</h1>
    <fieldset class="form-container container-md">
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
                        <input type="integer" id="quantity" name="quantity" value="0"/>
                    </p>

                    <p>
                        <label for="comments">Comments:</label>
                        <br>
                        <textarea type="text" id="idlabel" name="comment" cols="10" rows="10" class="field-medium"></textarea>
                    </p>
                    <input type="submit" value="Submit Data" id="adddata" />
                    <input type="button" value="Add New Seed" id="newcrop" onclick="addSeed()"/>
                    <button type="submit" value="Crop Data" id="chngForm" formaction="crop-data.php">Crop Data</button>
                </form>
            </div>
        
        <!-- Alerts and Reminders -->

        <div class="fields col-sm col-md">
        <?php include 'calendar.php'; ?>
        </div>

        <!-- Show Previous entries -->

        <h2 class="data-heading" id="h2Hide">Previous Data</h2>
        <button type="button" value="Show Previous Data" id="showData">Show/Hide Previous Data</button>
        <div  id="dataForm">

            <!-- Add search and edit functions -->

            <form method="POST" action="search-seed.php">
                <div class='search'>Search in: 
                    <select id='query' name='query'>
                    <option value='seedDataID'>Entry ID</option>
                    <option value='seedName'>Seed Name</option>
                    <option value='dateCheck'>Date</option>
                    </select>
                    Key: <input id='values' name='values' size="10" class='field-medium' value=''/>
                    <input type='submit' class='bttn' id="myBtn" value='search'>
                </div>
            </form>

            <!-- Delete/edit data -->

            <form method="POST" action="edit-seed.php">
                <div class="delete">Select Data ID: 
                    <input id='editData' size="5" name='editData'> In This Field: 
                    <select id='editQuery' name='editQuery'>
                        <option value='seedName'>Seed Name</option>
                        <option value='dateCheck'>Date</option>
                        <option value='quantity'>Quantity</option>
                        <option value='comment'>Comments</option>
                    </select>
                    To This Value: <input id='editValue' size="10" name='editValue'>
                    <input type='submit' class='bttn' name='Edit' value='Edit'>
                    <input type='submit' id='dltBtn' name='Delete' value='Delete'>
                </div>
            </form>
            
            <!-- Display Previous Data -->
            
            <table>
                <tr style="border-bottom: solid;">
                    <th>Data ID</th>
                    <th>Seed</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Comments</th>
                </tr>
            <?php include 'seed-display.php'; // display upto 20 entries ?>
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
</html>