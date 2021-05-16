<?php

require_once("private/config.php");

$resultgameinfo = mysqli_query($conn,"SELECT * FROM games WHERE result IS NULL AND player1_active = 'false' OR player2_active = 'false' ");

$data = array();

if (mysqli_num_rows($resultgameinfo) > 0){

  while ($row = mysqli_fetch_assoc($resultgameinfo)) {
    $gameid = $row['gameid'];
    $starttime = $row['starttime'];
    $player1 = $row['player1'];
    $player2 = $row['player2'];
    $result = $row['result'];
    $playerturn = $row['playerturn'];
    $token = $row['token'];
    $player1active = $row['player1_active'];
    $player2active = $row['player2_active'];
    
    $data[$gameid] = $starttime;
    
}
}
else{die();}

$removegameids = array();
$datenow = date("Y-m-d H:i:s");

foreach($data as $key => $value){  

#var_dump($value);

$date1 = new DateTime($value);
$date2 = new DateTime($datenow);
$diff = $date2->diff($date1);
$hours = $diff->h;
$hours = $hours + ($diff->days*24);

if ($hours > 1){
    $removegameids[$key] = $value;

    $sql = "DELETE FROM games WHERE gameid=$key";

if ($conn->query($sql) === FALSE) {

  echo "Error deleting record: " . $conn->error;
}

$message = "gameid: $key, starttime of game:  $value, player1: $player1, player1active: $player1active, player2: $player2, player2active: $player2active ";

$myFile = 'deletedgames.txt';
if (file_exists($myFile)) {
    $fh = fopen($myFile, 'a');
    fwrite($fh, $message."\n");
  } else {
    $fh = fopen($myFile, 'w');
    fwrite($fh, $message."\n");
  }
  fclose($fh);

}

}


   ?>