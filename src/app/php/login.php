<?php
  include 'db.inc.php';
  session_start();

  $sql = "SELECT * FROM user where id = '".$_POST["userid"].
  "' AND password='".$_POST["password"]."';"

  if($result -> num_rows > 0){
    $_SESSION["user"] = $_POST["username"];
  }
?>
