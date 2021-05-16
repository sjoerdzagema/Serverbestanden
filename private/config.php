<?php

$myIp = getHostByName(getHostName());

if ($myIp == '172.21.16.1'){
  $username = "root";
$password = "";
$adress = 'https://localhost/Serverbestanden/';
}
else{
  $username = "sjaakdarts";
$password = "rjA1p^39";
$adress = 'https://sjaak63-darts.nl/';
}

$servername = "localhost";
$dbname = "darts";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>