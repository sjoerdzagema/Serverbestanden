<?php

session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    require_once("private/config.php");
    header("Location:{$adress}");
    die();
}

require_once("private/config.php");

$player1 = $_SESSION['userid'];
$player2 = ($_POST['player2']);
$token = ($_POST['token']);
$playerstartgame = ($_POST['playercanstart']);
//var_dump($playerstartgame);


$result1 = mysqli_query($conn,"SELECT userID,username FROM users WHERE username = '$player2'");

if (mysqli_num_rows($result1) == 1){

    while ($row = mysqli_fetch_assoc($result1)) {
        $_SESSION['player2id'] = $row['userID'];
        $player2id = $_SESSION['player2id'];

    }
  }
else{
    echo "user needs to put in a new number";
}

$result2 = mysqli_query($conn,"SELECT userID,username FROM users WHERE username = '$playerstartgame'");

if (mysqli_num_rows($result2) == 1){

    while ($row = mysqli_fetch_assoc($result2)) {
        $_SESSION['playerturn'] = $row['userID'];
        $playerstartnameid = $_SESSION['playerturn'];
        }
    }
else{
    echo "user needs to put in a new number";
}

$date = date('Y-m-d H:i:s');

require_once("private/config.php");

$result = "INSERT INTO games(player1,player2,token,playerturn,starttime) VALUES ($player1, $player2id,$token,$playerstartnameid,'$date')";
if ($conn->query($result) === TRUE) {header("Location:{$adress}/playgametoken.php");}
else {
    echo "Error: " . $result . "<br>" . $conn->error;
  }

$conn->close();

?>
