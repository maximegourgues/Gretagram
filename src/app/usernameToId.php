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

$user_name = $_POST['user_name'];

$result = mysqli_query($conn,"SELECT * FROM users WHERE username='$user_name' ");
$row = mysqli_fetch_array($result);
echo $row['id'];

?>