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

require_once 'connect.php';

// Change password submit


$username = $_SESSION['name'];
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$epassword = password_hash($password, PASSWORD_DEFAULT);
$sql = "UPDATE accounts SET password = '$epassword' WHERE username = '$username'";
if (mysqli_query($conn, $sql)) {
    header("Location: confirm.html");
} 
else {
  echo "<p>ERROR: Not able to execute $sql. </p>" . mysqli_error($conn);
}

?>