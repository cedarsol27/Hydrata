<?php 
session_start();


require_once 'connect.php';

$users = $_SESSION['name'];

$sql = "SELECT username, accessLevel FROM accounts WHERE username = '$users';";
$result = mysqli_query($conn, $sql);
?>

<!-- =================== Search box for crop type =================== -->

<form method="POST" action="bath-search.php">
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

<!-- =================== Delete form for crop type, require =================== -->
<form method="POST" action="bath-edit.php">
<?php
if ($result && mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)) {
        
        if ($row['accessLevel'] >= '2') {
            echo '
                <div class="delete">Select Data ID: 
                    <input id="editData" size="5" name="editData"> In This Field: 
                    <select id="editQuery" name="editQuery">
                        <option value="cropName">Bath Name</option>
                        <option value="dateCheck">Date</option>
                        <option value="air">Air Temp</option>
                        <option value="water">Water Temp</option>
                        <option value="phbefore">pH Initial Check</option>
                        <option value="phafter">pH After Additions</option>
                        <option value="ec">EC</option>
                        <option value="comment">Comments</option>
                    </select>
                    To This Value: <input id="editValue" size="10" name="editValue">
                    <input type="submit" name="Edit" class="bttn" value="Edit">
                    <input type="submit" class="dltBtn" name="Delete" value="Delete">
                </div>
            ';
        }
    }
}
?>
<!-- =================== display data for crop type =================== -->

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
        <?php require 'bath-display.php'; ?>
    </table>
</form>
