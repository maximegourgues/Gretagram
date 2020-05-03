<?php
$server ="localhost";
$login = "root";
$mdp = "";
$db = "gretabase";

///Connexion au serveur MySQL

$conn = new mysqli($server, $login, $mdp, $db);

if($conn->connect_error){
  die("Failed to connect".$conn->connect_error);
}

?>
