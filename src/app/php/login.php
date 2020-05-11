<?php
$server = 'localhost';
$login = 'root';
$mdp = '';
$db = 'gretabase';

///Connexion au serveur MySQL

$conn = new mysqli($server, $login, $mdp, $db);

if($conn->connect_error){
  die("Failed to connect".$conn->connect_error);
}

  session_start();


  if(isset($_POST)){

      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql = "SELECT * FROM users WHERE username = ? AND password = ?";

      $stmt = $conn->prepare($sql);
      $stmt -> bind_param("ss", $username,$password);
      $res = $stmt->execute();

      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $stmt->close();
      if($row["id"]) {
        echo(json_encode($row["id"]));
      }
      else{
        echo (0);
      }


    }
    $conn->close();
?>
