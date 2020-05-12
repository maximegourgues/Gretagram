<?php

$server ="localhost";
$login = "root";
$mdp = "";
$db = "gretabase";

$conn = new mysqli($server, $login, $mdp, $db);

if($conn->connect_error){
  die("Failed to connect".$conn->connect_error);
}else{
  // header("Location: index.html?connectionsucces");
  //echo "Connection successful</br>";
}

$user_id = $_POST['user_id'];

$result = mysqli_query($conn,"SELECT * FROM users WHERE id='$user_id' ");
$row = mysqli_fetch_array($result);
echo $row['username'];

?>