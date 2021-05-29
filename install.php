<?php

// connect before database created
$host = 'localhost';
$user = 'root';
$password = '';
$dbase = 'crop_data';

$conn = mysqli_connect($host, $user, $password);
if ($conn === false) {
  die("<p>ERROR: Could not connect. </p>" . mysqli_connect_error());
}

// Create Database
$sql = "CREATE DATABASE IF NOT EXISTS crop_data";

if (mysqli_query($conn, $sql)){
  echo "<p>Database Created successfully!</p>";
} 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}

// Connect with new database
$conn = mysqli_connect($host, $user, $password, $dbase);
if ($conn === false) {
  die("<p>ERROR: Could not connect. </p>" . mysqli_connect_error());
}

// Create crop container
$sql = "CREATE TABLE IF NOT EXISTS bath (bathID int(3) NOT NULL AUTO_INCREMENT, 
cropName varchar(25) NOT NULL, PRIMARY KEY (bathID));";

if (mysqli_query($conn, $sql)){
  echo "<p>Crop table created successfully!</p>";
} 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}

// Create table crop_info
$sql = "CREATE TABLE IF NOT EXISTS bath_info (dataID int(3) NOT NULL AUTO_INCREMENT UNIQUE, 
bathID int(3) NOT NULL, dateCheck DATE NOT NULL, air DECIMAL(3,1) NOT NULL, 
water DECIMAL(3,1) NOT NULL, phbefore DECIMAL(2,1) NOT NULL, phafter DECIMAL(2,1) NULL, 
ec DECIMAL(2,1) NOT NULL, comment VARCHAR(250) NULL, PRIMARY KEY (dataID), 
CONSTRAINT FK_CropName FOREIGN KEY (bathID) REFERENCES bath(bathID) ON DELETE RESTRICT);";

if (mysqli_query($conn, $sql)){
  echo "<p>crop_info table created successfully!</p>";
} 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}

// Create table seed
$sql = "CREATE TABLE IF NOT EXISTS seed (seedID int(3) NOT NULL AUTO_INCREMENT, 
seedName varchar(25) NOT NULL, PRIMARY KEY (seedID));";

if (mysqli_query($conn, $sql)){
  echo "<p>Seed table created successfully!</p>";
} 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}


// Create table seed_info
$sql = "CREATE TABLE IF NOT EXISTS seed_info (seedDataID int(3) NOT NULL AUTO_INCREMENT, 
seedID int(3) NOT NULL, dateCheck DATE NOT NULL, quantity int(2) NOT NULL, comment VARCHAR(250) NULL, 
PRIMARY KEY (seedDataID), CONSTRAINT FK_seedName FOREIGN KEY (seedID) REFERENCES seed(seedID) ON DELETE RESTRICT);";

if (mysqli_query($conn, $sql)){
  echo "<p>Seed_info table created successfully!</p>";
} 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
}

if (mysqli_query($conn, $sql)){
  echo "<p>Database and tables created successfully!</p>";
  mysqli_close($conn);
  header("Location: confirm.html");
} 
else {
  echo "<p>ERROR: Could not able to execute $sql. </p>" . mysqli_error($conn);
  mysqli_close($conn);
}