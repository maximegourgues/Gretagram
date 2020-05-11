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

//$user_id = $_POST['user_id'];

$sql = "SELECT users.username FROM users";
$result = mysqli_query($conn,$sql);

$emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

$fp = fopen('users.json', 'w');
fwrite($fp, json_encode($emparray));
fclose($fp);

//echo json_encode($emparray);

?>