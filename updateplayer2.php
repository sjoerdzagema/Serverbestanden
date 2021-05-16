<?php
require_once("private/config.php");
require_once("sqlgetgameinfo.php");
$gameid = $_SESSION['gameid'];


    if ($_SESSION['playerturn'] == $_SESSION['player2id']){
        $_SESSION['playerturn'] = $_SESSION['player1id'];
        $updateturn = $_SESSION['playerturn'];
        var_dump("test");

        $updateturnquery1 = "UPDATE games SET playerturn = $updateturn WHERE gameid = $gameid";      
        if ($conn->query($updateturnquery1) === FALSE) {     
                  echo "problem";
                die();}
    
        }
        
?>