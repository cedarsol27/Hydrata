<?php
// needs separate conection for reminders database
require_once 'connect.php';

$date = $_POST['rmdrDate']; // = user input
$reminder = $_POST['reminder']; // = user input
$summary = $_POST['summary']; // = user imput

$sql = "INSERT INTO reminders (reminderDate, reminder, summary) VALUES 
('$date', '$reminder', '$summary')";

if (mysqli_query($conn, $sql)){
  
  header("Location: home.php");
  // change confirmation location to an alert

    } 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}
mysqli_close($conn);

