<?php
session_start();

require_once 'connect.php';
// set time zone
date_default_timezone_set("America/Los_Angeles");

// reusable date
$unixDate = strtotime(date("Y-m-d"));
$date = date('l F d, Y', $unixDate);
$sqlDate = date('Y-m-d', $unixDate);
$users = $_SESSION['name'];

echo "
<div id='bRem'>Alerts and Reminders</div>
<br>
<p>Today is <em><strong>" . $date . "</strong></em></p><br>
<p>Upcoming reminders:</p>
";

// table for dates
echo '
<table class="calendar">
    <tr class="calendar">
        <th>ID</th>
        <th>Date</th>
        <th>Reminder</th>
        <th>Summary</th>
';
$sql = "SELECT username, accessLevel FROM accounts WHERE username = '$users';";
$results = mysqli_query($conn, $sql);
if ($results && mysqli_num_rows($results) > 0){
    while($row = mysqli_fetch_assoc($results)) {
        if ($row['accessLevel'] >= '2') {
            echo "<th>Remove entry</th>";
        }
    }
}
echo '</tr>';
// Editable is blank for user level - maybe edit to be completely gone?

$data = "SELECT * FROM reminders WHERE reminderDate BETWEEN '$sqlDate' 
and '2100-12-31' ORDER BY reminderDate";

// display only 10 most recent upcoming events
$result = mysqli_query($conn, $data);

// Limit 
$total_rows = mysqli_affected_rows($conn);
if ($total_rows > 10) {
    $row_limit = 10;
}
else {
    $row_limit = $total_rows;
}
for ($i = 0; $i < $row_limit; $i++) {
    $row = mysqli_fetch_array($result);
    echo "
    <tr class='calendar'>
        <td>" . $row['id'] . "</td>
        <td>" . $row['reminderDate'] . "</td>
        <td>" . $row['reminder'] . "</td>
        <td>" . $row['summary'] . "</td>
    ";

    // Only display delete button with mod+ access


    $results = mysqli_query($conn, $sql);
    if ($results && mysqli_num_rows($results) > 0){
        while($rows = mysqli_fetch_array($results)) {
            if ($rows['accessLevel'] >= '2') {                
                echo "
                <td>
                <a id='delete-cal' href='delete-event.php?id=$row[id]'>Delete</a>
                </td>
                ";
                // get the row id number per line, delete with identified id
            }
        }
    }

    echo "

    </tr>
    ";
}
echo '
</table>

<div class="div-spacing"></div>
<div class="openBtn">
    <button class="openButton" onclick="openForm()"><strong>Add Reminder</strong></button>
</div>

<div class="eventPopup">
<div class="formPopup" id="popupForm">
<form method="POST" action="calendar-event.php" class="formContainer">
    <h3>Create New Reminder</h3>
    <label for="date" style="text-align: center;"><strong>Select Date: </strong></label>
    <input type="date" id="rmdrDate" name="rmdrDate" style="text-align: center;">
    <label for="reminder" style="text-align: center;"><Strong>Reminder: </strong></label>
    <input type="text" id="reminder" name="reminder">
    <label for="summary" style="text-align: center;"><Strong>Summary: </strong></label>
    <input type="text" id="summary" name="summary">
    <button type="submit" id="submit" class="btnRmdr">Add Reminder</button>
    <button type="button" class="btnRmdr cancel" onclick="closeForm()">Close</button>
</form>
</div>
</div>
';
?>