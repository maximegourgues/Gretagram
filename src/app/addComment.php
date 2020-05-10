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
  //echo "Connection successful";
}

$post_id=$_POST['postid'];
$contenu=$_POST['contenu'];
$user_id=$_POST['userid'];

if($contenu!=""){
    mysqli_query($conn, "INSERT INTO comments (user_id,post_id,contenu) VALUES ('$user_id','$post_id','$contenu')");
}

$result = mysqli_query($conn,"SELECT avatar FROM users WHERE id=$user_id");
$row = mysqli_fetch_array($result);
//echo $result['avatar'];

/*$result = mysqli_query($conn,"SELECT comments.comment_id, comments.user_id, comments.post_id, comments.contenu, users.avatar FROM comments INNER JOIN users ON comments.user_id=users.id WHERE comments.post_id = ".$post_id." ORDER BY comment_id");
// $result2 = $conn->query($sql1) or die ("Could not execute query");
 //echo $post_id;
 $post='<table>';
 while($row = mysqli_fetch_array($result)) {
   //echo $contenu;
   //echo "OUI";
   /*$post.='
   <ul>

     <li>
       <span class="comment-avatar float-left">
         <a href=""><img class="rounded-circle" src="'.$avatar.'" alt="..."></a>                            
       </span>
       <div class="search">
         <span>'.$contenu.'</span>
         <!--<button><i class="fa fa-camera"></i></button>-->
       </div><!--/. Search -->
     </li>';
   $post.='<tr>
             <span class="comment-avatar float-left">
               <a href=""><img class="rounded-circle" src="'.$row['avatar'].'" alt="..."></a>                            
             </span></tr>
             <div class="search">
               <label>'.$row['contenu'].'</label>
               <!--<button><i class="fa fa-camera"></i></button>-->
             </div><!--/. Search -->
           </tr>
           ';
 }

 $post.='<tr>
           <span class="comment-avatar float-left">
             <a href=""><img class="rounded-circle" src="'.'profile_pictures/unknown_user.png'.'" alt="..."></a>                            
           </span>
           <div class="search">
           <ul>
             <li>
               <textarea id="text-status" name="text-status" class="comment'.$post_id.'"  placeholder="Remplissez votre nouveau post ici"></textarea>
               <!--<input placeholder="Write a comment" type="text">-->
             </li>
               <li>
                 <button onclick="uploadComment('.$post_id.')"><i class="fa fa-camera"></i></button>
               </li>
             </ul>
           </div><!--/. Search -->
         </tr>
         </table>';

echo $post*/
$avatar=$row['avatar'];
$tab = 'true,'.$avatar;
echo $tab;

?>