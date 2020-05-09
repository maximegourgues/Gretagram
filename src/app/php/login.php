<?php
  include 'db.inc.php';

  if(isset($_POST)){

      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql = "SELECT Count(*) FROM users WHERE username = ? AND password = ?";
      $stmt = $conn->prepare($sql);
      $stmt -> bind_param("ss", $username,$password);
      $res = $stmt->execute();
      if($res) {
        echo 1;
      }
      else {
        echo data;
      }

    }
    $conn->close();
?>
