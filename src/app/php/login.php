<?php
  include 'db.inc.php';
  session_start();


  if(isset($_POST)){

      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql = "SELECT Count(*) FROM users WHERE username = ? AND password = ?";
      $sql2 = "SELECT * from users WHERE username = ?";
      $stmt = $conn->prepare($sql);
      $stmt -> bind_param("ss", $username,$password);
      $res = $stmt->execute();
      $stmt->close();

      $stmt = $conn->prepare($sql2);
      $stmt->bind_param('s', $username);

      if($res) {
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        echo(json_encode($row["id"]));
      }

    }
    $conn->close();
?>
