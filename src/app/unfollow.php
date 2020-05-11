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
    mysqli_query($conn, "DELETE FROM followings WHERE user_id=$user_id AND follow_id=$follow_id");
    mysqli_query($conn, "DELETE FROM followers WHERE user_id=$follow_id AND follower_id=$user_id");
}else{
    echo "echec du unfollow";
}
echo $user_id;
?>