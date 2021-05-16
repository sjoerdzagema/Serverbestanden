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
 <!-- Tell the browser to be responsive to screen width -->
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="dashboard.css">

</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="#home" class="active"> </i>Standing</a>
  <a href="creategame.php">Create Game</a>
  <a href="playgametoken.php">Play Game</a>
  <a href="stats.php"> Stats</a>
  <a href="destroysession.php" onclick="endsession()">Log out </a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>



<div class="table-responsive-sm">
<table class="table">
  <caption></caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Rating</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require_once("private/config.php");

  $result = mysqli_query($conn,"SELECT name,rating FROM standings ORDER BY rating DESC");

  $counter = 1;

  while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $counter . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['rating'] . "</td>";
  echo "</tr>";
  $counter = $counter + 1;
  }
        ?>
</tbody>
</table>
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

</body>
</html>
