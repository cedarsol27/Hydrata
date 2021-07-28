<?php

/*=================== Install user Profile first =================== */

session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$dbase = 'hydrata';

// Create Connection
$conn = mysqli_connect($host, $user, $password);
if ($conn === false) {
  die("<p>ERROR: Could not connect. </p>" . mysqli_connect_error());
}

// create login database
$sql = "CREATE DATABASE IF NOT EXISTS hydrata;";
if (mysqli_query($conn, $sql)){
} 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}

// Connect to HydrataLogin database
$conn = mysqli_connect($host, $user, $password, $dbase);
if ($conn === false) {
  die("<p>ERROR: Could not connect. </p>" . mysqli_connect_error());
}

// Create access and accounts table - New users automatically have access level 1
$sql = "CREATE TABLE IF NOT EXISTS access (accessLevel int(1) NOT NULL, accessTitle varchar(10) NOT NULL, 
PRIMARY KEY (accessLevel));
CREATE TABLE IF NOT EXISTS accounts (id int(3) NOT NULL AUTO_INCREMENT, username varchar(50) NOT NULL, 
password varchar(255) NOT NULL, email varchar(100) NOT NULL, firstname varchar(20) NOT NULL, lastname 
varchar(20) NULL, accessLevel int(1) NOT NULL, PRIMARY KEY (id), CONSTRAINT FK_userAccess FOREIGN KEY 
(accessLevel) REFERENCES accounts(accessLevel) 
ON DELETE RESTRICT);";

if (mysqli_query($conn, $sql)){
  // do something
} 
else {
echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}

// insert access info
// User level only can add and view
// Mod level can do user and edit/delete data
// Admin can do mod level and change access levels, delete databases and users

$sql = "INSERT INTO access (accessId, accessLevel, accessTitle) VALUES( 1, 'user'),
( 2, 'moderator'), ( 3, 'admin');";
if (mysqli_query($conn, $sql)){
  // do something
} 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}

$password = password_hash('UnderBelly&403', PASSWORD_DEFAULT);
// Create admin user
$sql = "INSERT INTO accounts (username, password, email, firstname, lastname, accessLevel) VALUES( 'hydrataAdmin', '$sha1Pass', 
'jamesmapesta@gmail.com', 'Hydrata', 'Admin', 3);";
if (mysqli_query($conn, $sql)){
  // do something
}
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}

/*------------------------------ Install Bath Table ------------------------------*/

$sql = "CREATE TABLE IF NOT EXISTS bath (bathID int(3) NOT NULL AUTO_INCREMENT, 
cropName varchar(25) NOT NULL, PRIMARY KEY (bathID));
CREATE TABLE IF NOT EXISTS bath_info (dataID int(3) NOT NULL AUTO_INCREMENT UNIQUE, 
bathID int(3) NOT NULL, dateCheck DATE NOT NULL, air DECIMAL(3,1) NOT NULL, 
water DECIMAL(3,1) NOT NULL, phbefore DECIMAL(2,1) NOT NULL, phafter DECIMAL(2,1) NULL, 
ec DECIMAL(2,1) NOT NULL, comment VARCHAR(250) NULL, PRIMARY KEY (dataID), 
CONSTRAINT FK_CropName FOREIGN KEY (bathID) REFERENCES bath(bathID) ON DELETE RESTRICT);
CREATE TABLE IF NOT EXISTS seed (seedID int(3) NOT NULL AUTO_INCREMENT, 
seedName varchar(25) NOT NULL, PRIMARY KEY (seedID));
CREATE TABLE IF NOT EXISTS seed_info (seedDataID int(3) NOT NULL AUTO_INCREMENT, 
seedID int(3) NOT NULL, dateCheck DATE NOT NULL, quantity int(2) NOT NULL, comment VARCHAR(250) NULL, 
PRIMARY KEY (seedDataID), CONSTRAINT FK_seedName FOREIGN KEY (seedID) REFERENCES seed(seedID) ON DELETE RESTRICT);";

if (mysqli_query($conn, $sql)){
} 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}

$sql = "CREATE TABLE IF NOT EXISTS reminders (id int(3) NOT NULL AUTO_INCREMENT, 
reminderDate DATE NOT NULL, reminder VARCHAR(100) NOT NULL, summary VARCHAR(250) NULL DEFAULT NULL, 
PRIMARY KEY (id));";


if (mysqli_query($conn, $sql)){
} 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}