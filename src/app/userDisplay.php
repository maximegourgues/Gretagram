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
$profile_id = $_POST['profile_id'];
//echo $user_id;
//echo "oui";

$sql = "SELECT * FROM users WHERE id='$profile_id'";
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
            <div class="profile-userbuttons">';
            $sql1 = "SELECT * FROM followings WHERE (user_id=$user_id AND follow_id='$profile_id')";
            $result1 = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result1) == 1 ){
                $post.='<button type="button" onclick="follow('.$user_id.','.$profile_id.')" class="btn btn-success btn-sm">Suivre</button>';
            }else{
                $post.='<button type="button" onclick="unfollow('.$user_id.','.$profile_id.')" class="btn /*btn-success*/ btn-sm" style="background-color:lightblue;">Suivi</button>';
            }
                $post.='<button type="button" class="btn btn-danger btn-sm">Message</button>
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