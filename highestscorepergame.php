<?php

require_once("private/config.php");

$result301 = mysqli_query($conn,"SELECT users.username as USERNAME, MAX(score) as maxscore
FROM scores JOIN users ON scores.playerid = users.userID
group by scores.playerid ORDER BY maxscore DESC");


$data1 = array();
  
if (mysqli_num_rows($result301) > 0){

  while ($row = mysqli_fetch_assoc($result301)) {
    $playerid = $row['USERNAME'];
    $avgscore = $row['maxscore'];
    $roundedavgscore = number_format((float)$avgscore, 2, '.', '');
    #echo 'playerid: ',$playerid, 'score: ', $roundedavgscore;
    $data1[$playerid] = $roundedavgscore;
   
  }
}
else {echo 'problem';
   die();}

   
$usernamesmaxscores = array();
$maxscores = array();

$counter = 0;


foreach($data1 as $key => $value){  
    if ($counter < 7) {
    $usernamesmaxscores[] = $key;
    $maxscores[] = $value;
    $counter = $counter + 1;}
    else {break;}
}

$js_array_usernamesmaxscores = json_encode($usernamesmaxscores);
$js_array_maxscores = json_encode($maxscores);



print_r($js_array_usernamesmaxscores);
//print_r($labelsr);



?>