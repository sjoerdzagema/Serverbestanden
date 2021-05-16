<?php
require_once("private/config.php");

$id = $_SESSION['userid'];

$result = "UPDATE users SET loggedin=NOW() WHERE userID = $id";

if ($conn->query($result) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }
  
  $conn->close();





?>