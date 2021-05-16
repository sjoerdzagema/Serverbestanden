<?php

session_start();
require_once("private/config.php");
require_once("sqlgetgameinfo.php");
require_once("private/config.php");

$score = ($_POST['score']);
$playerid = $_SESSION['userid'];
$gameid = $_SESSION['gameid'];

if ($score > 180){
  require_once("private/config.php");
  header("Location:{$adress}/playgame.php");
          die(); 
}

if ($score < 0){
  header("Location:{$adress}/playgame.php");
          die(); 
}

if ($_SESSION['player1id'] == $_SESSION['userid']){
if (($_SESSION['player1score'] - $score) < 0){
  header("Location:{$adress}/playgame.php");
          die(); 
}
}


if ($_SESSION['player2id'] == $_SESSION['userid']){
if (($_SESSION['player2score'] - $score) < 0){
  header("Location:{$adress}/playgame.php");
          die(); 
}
}

if ($_SESSION['player1id'] == $_SESSION['userid']){
  if(($_SESSION['player1score'] - $score) > 0 && $score <= 180){
  $_SESSION['player1score'] = ($_SESSION['player1score'] - $score);
  $newscore = $_SESSION['player1score'];
 

  $updatescore = "UPDATE games SET player1score = $newscore WHERE gameid = $gameid";      
  if ($conn->query($updatescore) === FALSE) {     
            echo "problem";
          die();}
          require_once("updateplayer1.php");

          $sql = "INSERT INTO scores (playerid, gameid, score)
VALUES ($playerid, $gameid, $score)";

if ($conn->query($sql) === FALSE) {
 
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location:{$adress}/playgame.php");
die();
}
}


  if ($_SESSION['player2id'] == $_SESSION['userid']){
    if(($_SESSION['player2score'] - $score) > 0 && $score <= 180){
    $_SESSION['player2score'] = ($_SESSION['player2score'] - $score);
    $newscore = $_SESSION['player2score'];    

    $updatescore = "UPDATE games SET player2score = $newscore WHERE gameid = $gameid";      
    if ($conn->query($updatescore) === FALSE) {     
              echo "problem";
            die();}
            
            require_once("updateplayer2.php");
            $sql = "INSERT INTO scores (playerid, gameid, score)
VALUES ($playerid, $gameid, $score)";

if ($conn->query($sql) === FALSE) {
 
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location:{$adress}/playgame.php");
die();
}
}


if ($_SESSION['player1id'] == $_SESSION['userid']){
  if(($_SESSION['player1score'] - $score) == 0 && $score <= 180){
    $player1id = $_SESSION['player1id'];
      $endresult1 = "UPDATE games SET result = $player1id WHERE gameid = $gameid";      
    if ($conn->query($endresult1) === FALSE) {     
              echo "problem2";
            die();}
            $date = date('Y-m-d H:i:s');
            $endresult10 = "UPDATE games SET endtime = '$date' WHERE gameid = $gameid";      
            if ($conn->query($endresult10) === FALSE) {     
                      echo "problem2";
                    die();}
	            $sql20 = "INSERT INTO scores (playerid, gameid, score) VALUES ($playerid, $gameid, $score)";
	  if ($conn->query($sql20) === FALSE) {
 
  echo "Error: " . $sql20 . "<br>" . $conn->error;
}

$conn->close();
header("Location:{$adress}/win.php");        
            die();     
    // 10 - (verschil ranking / rating player1 + rating player 2) * 10

    }
  }

  if ($_SESSION['player2id'] == $_SESSION['userid']){
    if(($_SESSION['player2score'] - $score) == 0 && $score <= 180){
      $player2id = $_SESSION['player2id'];
        $endresult2 = "UPDATE games SET result = $player2id WHERE gameid = $gameid";      
      if ($conn->query($endresult2) === FALSE) {     
                echo "problem3";
              die();}
              $date = date('Y-m-d H:i:s');
              $endresult10 = "UPDATE games SET endtime = '$date' WHERE gameid = $gameid";      
              if ($conn->query($endresult10) === FALSE) {     
                        echo "problem2";
                      die();}
		           $sql23 = "INSERT INTO scores (playerid, gameid, score) VALUES ($playerid, $gameid, $score)";
	  if ($conn->query($sql23) === FALSE) {
 
  echo "Error: " . $sql23 . "<br>" . $conn->error;
}

$conn->close();
header("Location:{$adress}/win.php");  
              die();      

      // 10 - (verschil ranking / rating player1 + rating player 2) * 10
  
      }
    }

?>