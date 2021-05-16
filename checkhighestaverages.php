<?php

require_once("private/config.php");

$result301 = mysqli_query($conn,"SELECT users.username as USERNAME, AVG(score) as average
FROM scores JOIN users ON scores.playerid = users.userID
group by scores.playerid ORDER BY average DESC");


$data = array();
  
if (mysqli_num_rows($result301) > 0){

  while ($row = mysqli_fetch_assoc($result301)) {
    $playerid = $row['USERNAME'];
    $avgscore = $row['average'];
    $roundedavgscore = number_format((float)$avgscore, 2, '.', '');
    #echo 'playerid: ',$playerid, 'score: ', $roundedavgscore;
    $data[$playerid] = $roundedavgscore;
   
  }
}
else {echo 'problem';
   die();}

   
$labelsr = array();
$datar = array();

$counter = 0;
$maxnumplayers = 7;


foreach($data as $key => $value){  
    if ($counter < $maxnumplayers) {
    $labelsr[] = $key;
    $datar[] = $value;
    $counter = $counter + 1;}
    else {break;}
}

$outputlabels = array_values($labelsr);
$outputdata = array_values($datar);

$js_array = json_encode($outputlabels);
$js_array1 = json_encode($outputdata);



//print_r($js_array);
//print_r($labelsr);



?>