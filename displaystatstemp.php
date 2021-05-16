<?php
require_once("private/config.php");

$result301 = mysqli_query($conn,"SELECT gameid,player1,player2,result FROM games ORDER BY endtime DESC LIMIT 1");
  
$player2scores = array();

if (mysqli_num_rows($result301) == 1){

  while ($row = mysqli_fetch_assoc($result301)) {
    $winner = $row['result'];
    $player1 = $row['player1'];
    $player2 = $row['player2'];
    $gameid = $row['gameid'];
 
$result302 = mysqli_query($conn,"SELECT gameid,score FROM scores WHERE playerid = $player2 AND gameid = $gameid");
  
if (mysqli_num_rows($result302) > 0){

  while ($row = mysqli_fetch_assoc($result302)) {
    $bijzonder = (int)$row['score'];  
    array_push($player2scores, $bijzonder);
    
      }
      
      
}
  }
}

$result399 = mysqli_query($conn,"SELECT gameid,player1,player2,result FROM games ORDER BY endtime DESC LIMIT 1");
$player1scores = array();

if (mysqli_num_rows($result399) == 1){

  while ($row = mysqli_fetch_assoc($result399)) {
    $winner = $row['result'];
    $player1 = $row['player1'];
    $player2 = $row['player2'];
    $gameid = $row['gameid'];
    
$result309 = mysqli_query($conn,"SELECT gameid,score FROM scores WHERE playerid = $player1 AND gameid = $gameid");
  
if (mysqli_num_rows($result309) > 0){

  while ($row = mysqli_fetch_assoc($result309)) {
    $bijzonder1 = (int)$row['score'];  
    array_push($player1scores, $bijzonder1);
    
      }
      
      
}
  }
}

$result303 = mysqli_query($conn,"SELECT username FROM users WHERE userID = $player1");
  
if (mysqli_num_rows($result303) == 1){

  while ($row = mysqli_fetch_assoc($result303)) {
    $usernameplayer1 = $row['username'];       
      
}
  }

  $result304 = mysqli_query($conn,"SELECT username FROM users WHERE userID = $player2");
  
if (mysqli_num_rows($result304) == 1){

  while ($row = mysqli_fetch_assoc($result304)) {
    $usernameplayer2 = $row['username'];       
      
}
  }

$averageplayer1 = array_sum($player1scores) / count($player1scores);
$averageplayer2 = array_sum($player2scores) / count($player2scores);
$averageplayer1 = number_format((float)$averageplayer1, 2, '.', '');
$averageplayer2 = number_format((float)$averageplayer2, 2, '.', '');


$highestscoreplayer2 = max($player2scores);
$highestscoreplayer1 = max($player1scores);

#$highestscoreplayer1 = max($player1scores);

?>