<?php

require_once("private/config.php");

$result301 = mysqli_query($conn,"SELECT player1,player2,result FROM games ORDER BY endtime DESC LIMIT 1");
  
if (mysqli_num_rows($result301) == 1){

  while ($row = mysqli_fetch_assoc($result301)) {
    $winner = $row['result'];
    $player1 = $row['player1'];
    $player2 = $row['player2'];
  
   
  }
}
else {echo 'problem';
   die();}

   if ($player1 == $winner){
        // 10 - (verschil ranking / rating player1 + rating player 2) * 10
        $loser = $player2;
   }

   if ($player2 == $winner){
    // 10 - (verschil ranking / rating player1 + rating player 2) * 10
    $loser = $player1;
}