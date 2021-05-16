<?php 
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
  require_once("private/config.php");
  header("Location:{$adress}/playgame.php");
    die();
	
}

// This is to check if the request is coming from a specific domain
$ref = $_SERVER['HTTP_REFERER'];
#$refData = parse_url($ref);
require_once("private/config.php");

/*
if($ref !== '{$adress}/playgame.php') {
  //Output string and stop execution
	echo $ref;
	header("Location:{$adress}/dashboard.php");
	die();
}
*/

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css">
<link rel="stylesheet" href="dashboard.css">


<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.container {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}


/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
.display-1 {
  font-size: 400%;
  text-align: center;
}

.display-2 {
  font-size: 175%;
  text-align: center;
}

.btn-success {
  margin-top: 20px !important;
}

#progressBar {
  font-size: 175%;
  text-align: center;

}

#gekhuis {
  text-align: center;
  margin-top: 100px !important;
}

</style>

</head>
<body>


<?php

$username = $_SESSION['usernamelogin'];
require_once("private/config.php");
require_once("calculatescore.php");
require_once("displaystatstemp.php");
	
$sql = "INSERT INTO winners_info (gameid,winnerusername,loserusername,ratingchange) VALUES ($gameid, '$winnerusername','$loserusername',$rankingchange1)";

if ($conn->query($sql) === FALSE) {
 
  echo "Error: " . $sql . "<br>" . $conn->error;
}
	

	
?>
<div class="container">
<div class="row">
  <div class="col-sm"><h5 class="display-1"><?php echo 'Winner ', $winnerusername; ?></h5></div>
  <div class="col-sm" ><h1 class="display-2"><?php echo '+ ', $rankingchange1; ?></h1></div>
  <div class="col-sm"><h5 class="display-1"><?php echo 'Loser ', $loserusername; ?></h5></div>
  <div class="col-sm" ><h1 class="display-2"><?php echo '- ', $rankingchange1; ?></h1></div>    
  </div>   
</div>

<div class="table-responsive-sm">
<table class="table">
  <caption></caption>
  <thead>
    <tr>
    <th scope="col">Name</th>
      <th scope="col">Highest score</th>
      <th scope="col">Game average</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?php echo $usernameplayer1; ?></th>
      <td><?php echo $highestscoreplayer1; ?></td>
      <td><?php echo $averageplayer1; ?></td>
      
    </tr>
    <tr>
      <th scope="row"><?php echo $usernameplayer2; ?></th>
      <td><?php echo $highestscoreplayer2; ?></td>
      <td><?php echo $averageplayer2; ?></td>
      
    </tr>

  </tbody>
</table>

<div id = "gekhuis">
<progress value="0" max="10" id="progressBar"></progress>
</div>


<script>
window.setTimeout(function(){

// Move to a new location or you can do something else
var adress = <?php echo json_encode($adress) ?>;
window.location.href = adress+"dashboard.php";

}, 11000);
</script>

<script>
  var timeleft = 10;
var downloadTimer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(downloadTimer);
  }
  document.getElementById("progressBar").value = 10 - timeleft;
  timeleft -= 1;
}, 1000);
  </script>
  
</body>
</html>
