<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbase = 'crop_data';

$conn = mysqli_connect($host, $user, $password, $dbase);
if ($conn === false) {
  die("<p>ERROR: Could not connect. </p>" . mysqli_connect_error());
}