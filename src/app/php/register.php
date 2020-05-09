<?php

include 'db.inc.php';

if(isset($_POST)){
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  //$check = "SELECT username FROM users WHERE username = ? Limit 1";
  $sql = "INSERT INTO users (username, fullname, password) VALUES (?,?,?)";

    //check if username is already in db
  //  $stmtcheck = $db->prepare($check);
  //  $num = $stmtcheck->execute([$username]);
  //  $user = $num->fetch();


  //  if($user){
  // $username+' is already registered';
  //  }
  //  else{
    $stmt = $conn->prepare($sql);
    $stmt -> bind_param("sss", $username,$fullname,$password);
    $res = $stmt->execute();
    if($res) {
          echo 1;
    }
    else {
      echo 2;
    }

  //  }
  }
  $conn->close();
?>
