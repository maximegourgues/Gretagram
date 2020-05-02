<?php
$server ="localhost";
$login = "root";
$mdp = "";
$db = "gretabase";

///Connexion au serveur MySQL

$conn = new mysqli($server, $login, $mdp, $db);

if($conn->connect_error){
  die("Failed to connect".$conn->connec_error);
}

?>

<?php
if(empty($_COOKIE["Login"]) || empty($_COOKIE["Password"]==0)) {
	header('Location: sign.html');
	}
?>
