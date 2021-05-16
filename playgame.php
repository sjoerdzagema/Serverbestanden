<?php 
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    
    die();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

</style>

</head>
<body>


<?php
require_once("private/config.php");
require_once("sqlgetgameinfo.php");

// in this case player1 id 
if($_SESSION['player1id'] == $_SESSION['userid']){
  $scoreplayer = $_SESSION['player1score'];
  $otherplayer = (int)$_SESSION['player2id'];
  $otherscore = $_SESSION['player2score'];
  $getotherusername = mysqli_query($conn,"SELECT username FROM users WHERE userID = $otherplayer");

  if (mysqli_num_rows($getotherusername) == 1){

    while ($row = mysqli_fetch_assoc($getotherusername)) {
      $_SESSION['otherusername'] = $row['username'];}
  

}
}


else{$scoreplayer = $_SESSION['player2score'];
  $otherplayer = $_SESSION['player1id'];
  $otherscore = $_SESSION['player1score'];

  $getotherusername1 = mysqli_query($conn,"SELECT username FROM users WHERE userID = $otherplayer");

  if (mysqli_num_rows($getotherusername1) == 1){

    while ($row = mysqli_fetch_assoc($getotherusername1)) {
      $_SESSION['otherusername'] = $row['username'];}
  

}

}

?>

<div class="container">
<div class="row">
  <div class="col-sm"><h5 class="display-2"><?php echo $_SESSION['usernamelogin']; ?></h5></div>
  <div class="col-sm" ><h1 class="display-1"><?php echo $scoreplayer ?></h1></div>

  <?php
if ($_SESSION['playerturn'] == $_SESSION['userid'] ) : ?>
 
  <form action="updatescore.php" method="POST">
    <div class="row">
    <div class="col text-center">
      <div class="col-xs-12">
        <label for="ex1">score <?php echo  $_SESSION['usernamelogin']?></label>
        <input class="form-control" name="score" type="number">
      </div>      
      <button type="submit" class="btn btn-success">Submit score</button>
      </form>
      </div>  
  </div>
</div>
</div>
<?php endif; ?>

<div class="container">
<div class="row">
  <div class="col-sm"><h5 class="display-2"><?php echo $_SESSION['otherusername'];
?></h5></div>
  <div class="col-sm" ><h1 class="display-1"><?php echo $otherscore ?></h1></div>
</div>
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

$(document).ready(function() {
  setInterval(function() {
    cache_clear()
  }, 11000);
});


function cache_clear() {
  window.location.reload(true);
  // window.location.reload(); use this if you do not remove cache
}


</script>

<script>

//Call the yourAjaxCall() function every 1000 millisecond
setInterval("yourAjaxCall()",1000);


function yourAjaxCall(){
  $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "checkresult.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){  
          if (response == "finished"){
            //alert(response);
            var adress = <?php echo json_encode($adress) ?>;
            window.location.replace(adress+"/winAJAX.php");
              }                  
        },
        failure: function (response) {
            if (response != 'inprogress' || response != 'problem sir') fail(response);
        }

    });
}
  
</script>


</body>
</html>
