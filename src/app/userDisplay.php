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
echo $user_id;
//echo "oui";

$sql = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

        $post='<!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
                <img src="profile_pictures/unknown_user.png" class="img-responsive" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    '.$row['fullname'].'
                </div>
                <div class="profile-usertitle-job">
                    '.$row['username'].'
                </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
                <button type="button" class="btn btn-success btn-sm">Follow</button>
                <button type="button" class="btn btn-danger btn-sm">Message</button>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            <!-- SIDEBAR MENU -->
            <!--<div class="profile-usermenu">
                <ul class="nav">
                    <li class="active">
                         <a href="#">
                        <i class="glyphicon glyphicon-home"></i>
                        Overview </a>
                    </li>
                    <li>
                         <a href="#">
                         <i class="glyphicon glyphicon-user"></i>
                        Account Settings </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                        <i class="glyphicon glyphicon-ok"></i>
                    Tasks </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="glyphicon glyphicon-flag"></i>
                        Help </a>
                    </li>
                </ul>
            </div>-->
            <!-- END MENU -->';

echo $post;

?>