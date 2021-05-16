<?php 
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
  require_once("private/config.php");
  header("Location:{$adress}");
    die();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 10px;
  }
}
</style>

</head>
<body>


<div class="topnav" id="myTopnav">
<a href="creategame.php" class="active">Create Game</a>
  <a href="dashboard.php"> </i>Standing</a>
  <a href="playgametoken.php">Play Game</a>
  <a href="stats.php"> Stats</a>  
  <a href="destroysession.php" onclick="endsession()">Log out </a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<?php $username = $_SESSION['usernamelogin'] ?>

<div class="container">
<form name="myForm" action="newgame.php" method="POST" onsubmit="return validateForm()">
    <div class="row">
      <div class="col-25">
        <label for="fname">Player 1</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" readonly name="player1" placeholder= " <?php echo $username?> ">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Player 2</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="player2" placeholder="Enter the name of your opponent">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Token</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="token" placeholder="Fill in number between 1 and 9 and remember this">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Player that can start the game</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="playercanstart" placeholder="Enter the name of the player that can start">
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Create Game">
    </div>
  </form>
</div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

<script>
function validateForm() {

 var player1 = '<?php echo $_SESSION['usernamelogin'];?>';
  var player2 = document.forms["myForm"]["player2"].value;
  var token = document.forms["myForm"]["token"].value;
  var playercanstart = document.forms["myForm"]["playercanstart"].value;

  if (player2 == "" || token == "" || playercanstart == "" ) {
  alert("Fill in all the fields");
  return false;
}


if (player2 != "sjoerd" && player2 != "boris" && player2 != "selena" && player2 != "arnout" && player2 != "monique" 
&& player2 != "iris" && player2 != "ingrid" && player2 != "linda" && player2 != "tommie" && player2 != "zoe" 
&&player2 != "nicolas" &&player2 != "shanne" &&player2 != "jelle" &&
player2 != "jeroen" && player2 != "arjen") {
  alert("name player 2 not correct. examples: arnout zoe nicolas");
  return false;
}

if (player2 == player1 ) {
  alert("You can not play against yourself");
  return false;
}

if (isNaN(+token) == true){
      alert("token: fill in a number between 1 and 9");
    return false;

  }


  if (playercanstart != player1 && playercanstart != player2) {
    alert("Fill in name of player1 or player2 for start player");
    return false;
  }



}

 </script>

</body>
</html>
