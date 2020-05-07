<?php


include 'upload.php';



$server ="localhost";
$login = "root";
$mdp = "";
$db = "gretabase";

///Connexion au serveur MySQL

$conn = new mysqli($server, $login, $mdp, $db);

if($conn->connect_error){
  die("Failed to connect".$conn->connect_error);
}else{
  // header("Location: index.html?connectionsucces");
}

$user_id = 1;

//$user_id = $mysqli->real_escape_string($_REQUEST['user_id']);
$nom_position = $_POST['myInput'];
$lat = $_POST['lat_input'];
$lon = $_POST['lon_input'];
$image_location = $fileDestination;
$contenu = $_POST['text-status'];
$likes = 0;
$comment = 0;

echo "User: $user_id";
echo "</br>Latitude: $lat";
echo "</br>Longitude: $lon";
echo "</br>Nom de la position: $nom_position";
echo "</br>Chemin de l\n'image: $image_location";
echo "</br>Texte: $contenu";
echo "</br>Likes: $likes";
echo "</br>Commentaires: $comment";




function addNewPost($user_id,$latitude,$longitude,$nom_position,$image_location,$contenu,$likes,$comment){

}












