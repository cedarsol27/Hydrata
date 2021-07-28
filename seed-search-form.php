<?php 

// Pull up user information

session_start();

require_once 'connect.php';

$users = $_SESSION['name'];

$sql = "SELECT username, accessLevel FROM accounts WHERE username = '$users';";
$result = mysqli_query($conn, $sql);

// end here to print user accessibility

?>


<!-- Seed Search data -->

<form method="POST" action="seed-search.php">
    <div class='search'>Search in: 
        <select id='query' name='query'>
        <option value='seedDataID'>Entry ID</option>
        <option value='seedName'>Seed Name</option>
        <option value='dateCheck'>Date</option>
        </select>
        Key: <input id='values' name='values' size="10" class='field-medium' value=''/>
        <input type='submit' class='bttn' id="myBtn" value='Search'>
    </div>
</form>

<!-- Delete/edit data -->
<form method='POST' action='seed-edit.php'>
<?php

// create access level for mod+

if ($result && mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) {
        if ($row['accessLevel'] >= '2') {
            echo "
            <div class='delete'>Select Data ID: 
                <input id='editData' size='5' name='editData'> In This Field: 
                <select id='editQuery' name='editQuery'>
                    <option value='seedName'>Seed Name</option>
                    <option value='dateCheck'>Date</option>
                    <option value='quantity'>Quantity</option>
                    <option value='comment'>Comments</option>
                </select>
                To This Value: <input id='editValue' size='10' name='editValue'>
                <input type='submit' class='bttn' name='Edit' value='Edit'>
                <input type='submit' class='dltBtn' name='Delete' value='Delete'>
            </div>";
        }
    }
}
?>

<!-- Display Previous Data and return user+ level access -->

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
</form> 