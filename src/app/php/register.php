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


$fullname = $_POST['fullname'];
$username = $_POST['username'];
$userpass = $_POST['password'];

$SELECT = "SELECT username FROM users WHERE username = ? Limit 1";
$INSERT = "INSERT INTO users (username, fullname, password) VALUES (?,?,?)";

fonction save ($username,$fullname,$password) {

  //prepare Statement
  $stmt = $conn->prepare($SELECT);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->bind_result($username);
  $stmt->store_result();
  $rnum = $stmt->num_rows;

  if($rnum==0) {
    $stmt->close();
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("sss", $username, $fullname, $password);
    $stmt->execute();

  }
  $stmt-> close();
  $conn -> close();
  return true;
}

$pass = save($username,$fullname,$password);
header('Location : ../sign.html')

echo json_encode([
  "status" => $pass ? 1 : 0,
  "message" => $pass ? "OK" : "An error has occured"
]);
exit();

?>
