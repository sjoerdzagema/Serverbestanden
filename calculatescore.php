<?php

require_once("checkwinner.php");

//get rating from player1
// get rating from player2

$result301 = mysqli_query($conn,"SELECT gameid,player1,player2,result FROM games ORDER BY endtime DESC LIMIT 1");
  
if (mysqli_num_rows($result301) == 1){

  while ($row = mysqli_fetch_assoc($result301)) {
	$gameid = $row['gameid'];
    $winner = $row['result'];
    $player1 = $row['player1'];
    $player2 = $row['player2'];

    $result302 = mysqli_query($conn,"SELECT userID,rating FROM standings WHERE userID = $player1");

    if (mysqli_num_rows($result302) ==1){

        while ($row = mysqli_fetch_assoc($result302)) {
          $ratingplayer1 = $row['rating'];  
   
  }
}

$result302 = mysqli_query($conn,"SELECT userID,rating FROM standings WHERE userID = $player2");

    if (mysqli_num_rows($result302) ==1){

        while ($row = mysqli_fetch_assoc($result302)) {
          $ratingplayer2 = $row['rating'];
    
  }
}

  }
}
else {echo 'problem';
   die();}


   // 10 - (verschil ranking / rating player1 + rating player 2) * 10

   $rankingchange = 10 -((abs($ratingplayer1-$ratingplayer2)/($ratingplayer1+$ratingplayer2)) * 10);
   $rankingchange1 = number_format((float)$rankingchange, 2, '.', '');

   if ($ratingplayer1 > $ratingplayer2){

    if ($winner == $player1){
       $newratingplayer1 = $ratingplayer1 + $rankingchange1;
    $updateturnquery1 = "UPDATE standings SET rating = $newratingplayer1 WHERE userID = $winner";      
    if ($conn->query($updateturnquery1) === FALSE) {     
              echo "problem";
            die();}

        $newratingplayer2 = $ratingplayer2 - $rankingchange1;
        $updateturnquery2 = "UPDATE standings SET rating = $newratingplayer2 WHERE userID = $loser";      
        if ($conn->query($updateturnquery2) === FALSE) {     
                    echo "problem";
                die();}


    }
    elseif ($winner == $player2) {
      $rankingchange1 = (20 - $rankingchange1);
        $newratingplayer2 = $ratingplayer2 + $rankingchange1;
    $updateturnquery3 = "UPDATE standings SET rating = $newratingplayer2 WHERE userID = $winner";      
    if ($conn->query($updateturnquery3) === FALSE) {     
              echo "problem";
            die();}
                  
        $newratingplayer1 = $ratingplayer1 - $rankingchange1;
        $updateturnquery4 = "UPDATE standings SET rating = $newratingplayer1 WHERE userID = $loser";      
        if ($conn->query($updateturnquery4) === FALSE) {     
                    echo "problem";
                die();}

    }
}


if ($ratingplayer2 > $ratingplayer1){

    if ($winner == $player2){
       $newratingplayer2 = $ratingplayer2 + $rankingchange1;
    $updateturnquery5 = "UPDATE standings SET rating = $newratingplayer2 WHERE userID = $winner";      
    if ($conn->query($updateturnquery5) === FALSE) {     
              echo "problem";
            die();}

        $newratingplayer1 = $ratingplayer1 - $rankingchange1;
        $updateturnquery6 = "UPDATE standings SET rating = $newratingplayer1 WHERE userID = $loser";      
        if ($conn->query($updateturnquery6) === FALSE) {     
                    echo "problem";
                die();}


    }
    elseif ($winner == $player1) {
      $rankingchange1 = (20 - $rankingchange1);//19.96
        $newratingplayer1 = $ratingplayer1 + $rankingchange1;
    $updateturnquery7 = "UPDATE standings SET rating = $newratingplayer1 WHERE userID = $winner";      
    if ($conn->query($updateturnquery7) === FALSE) {     
              echo "problem";
            die();}

        $newratingplayer2 = $ratingplayer2 - $rankingchange1;
        $updateturnquery8 = "UPDATE standings SET rating = $newratingplayer2 WHERE userID = $loser";      
        if ($conn->query($updateturnquery8) === FALSE) {     
                    echo "problem";
                die();}

    }
}

if ($ratingplayer2 == $ratingplayer1){
    if ($winner == $player1){
        $newratingplayer1 = $ratingplayer1 + 10;
        $newratingplayer2 = $ratingplayer2 - 10;
        $updateturnquery5 = "UPDATE standings SET rating = $newratingplayer1 WHERE userID = $winner";      
        if ($conn->query($updateturnquery5) === FALSE) {     
                  echo "problem";
                die();}
        
        $updateturnquery50 = "UPDATE standings SET rating = $newratingplayer2 WHERE userID = $loser";      
        if ($conn->query($updateturnquery50) === FALSE) {     
                  echo "problem";
                die();}

    }

    if ($winner == $player2){
        $newratingplayer1 = $ratingplayer2 + 10;
        $newratingplayer2 = $ratingplayer1 - 10;
        $updateturnquery5 = "UPDATE standings SET rating = $newratingplayer2 WHERE userID = $winner";      
        if ($conn->query($updateturnquery5) === FALSE) {     
                  echo "problem";
                die();}
        
        $updateturnquery50 = "UPDATE standings SET rating = $newratingplayer1 WHERE userID = $loser";      
        if ($conn->query($updateturnquery50) === FALSE) {     
                  echo "problem";
                die();}

    }

}

    $resultwinnerusername = mysqli_query($conn,"SELECT username FROM users WHERE userID = $winner");
  
    if (mysqli_num_rows($resultwinnerusername) == 1){
    
      while ($row = mysqli_fetch_assoc($resultwinnerusername)) {
        $winnerusername = $row['username'];      
      
         
      }
    }

    $resultwinnerusernameloser = mysqli_query($conn,"SELECT username FROM users WHERE userID = $loser");
  
    if (mysqli_num_rows($resultwinnerusernameloser) == 1){
    
      while ($row = mysqli_fetch_assoc($resultwinnerusernameloser)) {
        $loserusername = $row['username'];
            
        
      }
    }
   
 


?>