<?php
require_once("private/config.php");
require_once("sqlgetgameinfo.php");
$gameid = $_SESSION['gameid'];


if ($_SESSION['playerturn'] == $_SESSION['player1id']){
    $_SESSION['playerturn'] = $_SESSION['player2id'];
    $updateturn2 = $_SESSION['playerturn'];
    var_dump("test");

    $updateturnquery = "UPDATE games SET playerturn = $updateturn2 WHERE gameid = $gameid";      
    if ($conn->query($updateturnquery) === FALSE) {     
              echo "problem";
            die();}

    }


           
?>