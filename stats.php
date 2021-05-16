<?php 
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
  require_once("private/config.php");
  header("Location:{$adress}index.html");
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




<style>
* {
  box-sizing: border-box;
}

input[type=number], select, textarea {
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

<div class="topnav" id="myTopnav">
<a href="stats.php" class="active"> Stats</a>
<a href="playgametoken.php" > Play Game</a>
<a href="creategame.php" >Create Game</a>
  <a href="dashboard.php">Standing</a>
  <a href="destroysession.php" onclick="endsession()">Log out </a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>


<div class="chart-container" style="position: relative; height:30vh; width:80vw">
    <canvas id="myChart"></canvas>
</div>

<div class="chart-container" style="position: relative; height:30vh; width:80vw">
    <canvas id="myChart2"></canvas>
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

let myChart = document.getElementById('myChart').getContext('2d');

<?php
require_once("checkhighestaverages.php");
require_once("highestscorepergame.php");



?>

var usernamemaxscores = <?php echo json_encode($js_array_usernamesmaxscores) ?>;
var maxscores = <?php echo json_encode($js_array_maxscores) ?>;

var usernamemaxscores1 = JSON.parse(usernamemaxscores)
var maxscores1 = JSON.parse(maxscores)

var datagast = <?php echo json_encode($js_array) ?>;
var datagast2 = <?php echo json_encode($js_array1) ?>;


var myArray = JSON.parse(datagast)
var myArray2 = JSON.parse(datagast2)


let massPopChart = new Chart(myChart, {
  type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
  data:{
    labels: myArray,
    datasets:[{
      label:'Average score',
      data: myArray2,
      //backgroundColor:'green',
      backgroundColor: '#4CAF50' ,
      borderWidth:1,
      borderColor:'#777',
      hoverBorderWidth:3,
      hoverBorderColor:'#000'
    }]
  },
  options:{ 
    title:{
      display:true,
      text:'Largest Cities In Massachusetts',
      fontSize:25
    },
    legend:{
      display:true,
      position:'right',
      labels:{
        fontColor:'#000'
      }
    },
    layout:{
      padding:{
        left:50,
        right:0,
        bottom:0,
        top:0
      }
    },
    tooltips:{
      enabled:true
    }
  }
});


let myChart2 = document.getElementById('myChart2').getContext('2d');

let massPopChart2 = new Chart(myChart2, {
  type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
  data:{
    labels: usernamemaxscores1,
    datasets:[{
      label:'Highest score',
      data: maxscores1,
      //backgroundColor:'green',
      backgroundColor: '#4CAF50' ,
      borderWidth:1,
      borderColor:'#777',
      hoverBorderWidth:3,
      hoverBorderColor:'#000'
    }]
  },
  options:{
    title:{
      display:true,
      text:'Largest Cities In Massachusetts',
      fontSize:25
    },
    legend:{
      display:true,
      position:'right',
      labels:{
        fontColor:'#000'
      }
    },
    layout:{
      padding:{
        left:50,
        right:0,
        bottom:0,
        top:0
      }
    },
    tooltips:{
      enabled:true
    }
  }
});




</script>

</body>
</html>
