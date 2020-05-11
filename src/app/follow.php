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
$follow_id = $_POST['follow_id'];

$sql = "SELECT * FROM followings WHERE user_id=$user_id AND follow_id=$follow_id";
$result = mysqli_query($conn,$sql);
//$row = mysqli_fetch_array($result);

if (mysqli_num_rows($result) == 1 ){
    echo "echec du follow";
}else{
    mysqli_query($conn, "INSERT INTO followings (user_id, follow_id) VALUES ($user_id,$follow_id)");
    mysqli_query($conn, "INSERT INTO followers (user_id, follower_id) VALUES ($follow_id,$user_id)");
}
echo $user_id;
?>