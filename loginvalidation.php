<?php

require_once("private/config.php");

if (empty($_POST['username']) ||
    empty($_POST['password'])) {
    
    header('Location:', $adress);
}


$username = ($_POST['username']);
$password = ($_POST['password']);

$sql = "SELECT userID,username,password FROM users WHERE username = '$username' and password = '$password'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    $row = $result->fetch_row();
session_start();
$_SESSION['userLogin'] = "Loggedin";
$_SESSION['usernamelogin'] = $username;
$_SESSION['userid'] = $row[0];
require_once("settimelogin.php");

echo $adress;
echo "Location:{$adress}dashboard.php";

header("Location:{$adress}dashboard.php");
     }
  else {
    header("Location:{$adress}");
  }

  $conn->close();


?>