<?php

session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
  require_once("private/config.php");
  header("Location:{$adress}");
    die();
}

require_once("private/config.php");

$token = ($_POST['token']);

$usernamecheck = $_SESSION['usernamelogin'];
$useridcheck = $_SESSION['userid'];
//var_dump($usernamecheck);

// player 1 or player 2
//ppl

$result30 = mysqli_query($conn,"SELECT player1_active,player2_active FROM games WHERE result IS NULL AND token = $token ORDER BY starttime DESC LIMIT 1" );

  
if (mysqli_num_rows($result30) == 1){

  while ($row = mysqli_fetch_assoc($result30)) {
    if ($row['player1_active'] == 'true' && $row['player2_active'] == 'true' ){
      echo 'gameready';
      die();
    }
  }
}
else {echo 'problem';
   die();}

$result = mysqli_query($conn,"SELECT gameid,player1,player2 FROM games WHERE result IS NULL AND token = $token ORDER BY starttime DESC LIMIT 1");


if (mysqli_num_rows($result) == 1){

  while ($row = mysqli_fetch_assoc($result)) {

    if ($useridcheck == $row['player2']){
      //var_dump($useridcheck);
      $_SESSION["playertype"] = 'player1';
      $rowgameid =(int)$row['gameid'];
     $updateactivestatus = "UPDATE games SET player2_active = 'true' WHERE gameid = $rowgameid";
      
    if ($conn->query($updateactivestatus) === FALSE) {     
              echo "problem";}
    }

    if ($useridcheck == $row['player1']){
      //var_dump($useridcheck);
      $_SESSION["playertype"] = 'player2';
      $rowgameid =(int)$row['gameid'];
     $updateactivestatus = "UPDATE games SET player1_active = 'true' WHERE gameid = $rowgameid";
      
    if ($conn->query($updateactivestatus) === FALSE) {     
              echo "problem";}
    }

  }

    }
    
 


else{die();}


?>
