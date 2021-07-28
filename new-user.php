<?php
// strict types add additional security by preventing the wrong type being passed

session_start();
require_once 'connect.php';

// filtering prevents user entries to execute actions
if ((isset($_POST['username'])) && (isset($_POST['email'])) && (isset($_POST['password']))
&& (isset($_POST['firstname'])) && (isset($_POST['lastname']))) {
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  $first = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
  $last = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);

  // hash password

  $epassword = password_hash($password, PASSWORD_DEFAULT);
  $sql = "SELECT * FROM accounts WHERE username = '$username'";
  $queue = mysqli_query($conn, $sql);
  $data = mysqli_fetch_array($queue);

  // identifies if a username is already created
  if ($data[0] > 1){
    echo "That user name already exists. Please try another user name" . 
    "<br><a href='new-user.html'>&lt;- Go Back</a>";
  }
  else {
    $sql = "INSERT INTO accounts (username, email, password, firstname, lastname, accessLevel) VALUES 
    ('$username', '$email', '$epassword', '$first', '$last', 1)";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Your account has been created.\nYou may login now.");</script>';
        header("Location: index.php");
    } 
    else {
      echo "<p>ERROR: Not able to execute $sql. </p>" . mysqli_error($conn);
    }
  }
}
else {
  print "<p>Missing or invalid parameters. Please enter vaild information. <a href='new-user.php'>Refresh</a>";
}
mysqli_close($conn);
