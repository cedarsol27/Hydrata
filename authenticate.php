<?php
session_start();
// credits to https://codeshack.io/secure-login-system-php-mysql/

require 'connect.php';

if ( !isset($_POST['username'], $_POST['password']) ) {
	die('Please fill both the username and password fields!');
}

// preparing the SQL statement will prevent SQL injection??
if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) {

	// Bind parameters s = string
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();

	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION["login_time_stamp"] = time();
            header('Location: home.php');
        } else {
            echo 'Incorrect username and/or password!
            <br>
            <a href="index.php">&lt;- Go Back</a>';
        }
    } else {
        echo 'Incorrect username and/or password!';
    }

	$stmt->close();
}