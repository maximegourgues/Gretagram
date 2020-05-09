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
  echo "Connection successful</br>";
}

echo "oui";


$sql = "SELECT * FROM posts INNER JOIN users WHERE (users.id=posts.user_id) ORDER BY post_id";
$result = $conn->query($sql) or die ("Could not execute query");
 
while($row = mysqli_fetch_array($result)) {
    extract($row);
    //echo $row;
    
    $post='<section class="hero">
            <div class="container">
              <div class="row">	
      
                <div class="col-lg-6 offset-lg-3">
      
                  <div class="cardbox shadow-lg bg-white">
        
                    <div class="cardbox-heading">
                    <!-- START dropdown-->
                    <div class="dropdown float-right">
                      <button class="btn btn-flat btn-flat-icon" type="button" data-toggle="dropdown" aria-expanded="false">
                      <em class="fa fa-ellipsis-h"></em>
                      </button>
                      <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="#">Hide post</a>
                        <a class="dropdown-item" href="#">Stop following</a>
                        <a class="dropdown-item" href="#">Report</a>
                      </div>
			              </div><!--/ dropdown -->
			              <div class="media m-0">
			                <div class="d-flex mr-3">
                       <a href=""><img class="img-fluid rounded-circle" src="'.'profile_pictures/unknown_user.png'.'" alt="User"></a>
                      </div>
			                <div class="media-body">
                        <p class="m-0">'.$fullname.'</p>
                        <small><span><i class="icon ion-md-pin"></i> '.$nom_position.'</span></small>
                        <small><span><i class="icon ion-md-time"></i> '.'AJOUTER UN TIMER ICI'.'</span></small>
                      </div>
			              </div><!--/ media -->
                  </div><!--/ cardbox-heading -->
                  <div class="cardbox-item">
                    <img class="img-fluid" src="'.$image_location.'" alt="Image">
                  </div><!--/ cardbox-item -->
                  <div class="cardbox-base">
                    <ul class="float-right">
                      <li><a><i class="fa fa-comments"></i></a></li>
                      <li><a><em class="mr-5">'.$comment.'</em></a></li>
                      <li><a><i class="fa fa-share-alt"></i></a></li>
                      <li><a><em class="mr-3">'.'PLACER LE NOMBRE DE PARTAGES ICI'.'</em></a></li>
                    </ul>
                    <ul>
                      <li><a><i class="fa fa-thumbs-up"></i></a></li>
                      <!--<li><a href="#"><img src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/3.jpeg" class="img-fluid rounded-circle" alt="User"></a></li>
                      <li><a href="#"><img src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/1.jpg" class="img-fluid rounded-circle" alt="User"></a></li>
                      <li><a href="#"><img src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/5.jpg" class="img-fluid rounded-circle" alt="User"></a></li>
                      <li><a href="#"><img src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/2.jpg" class="img-fluid rounded-circle" alt="User"></a></li>-->
                      <li><a><span>'.$likes.' Likes</span></a></li>
                    </ul>			   
                  </div><!--/ cardbox-base -->
                  <div class="cardbox-comments">
                    <span class="comment-avatar float-left">
                    <a href=""><img class="rounded-circle" src="'.'profile_pictures/unknown_user.png'.'" alt="..."></a>                            
                    </span>
                    <div class="search">
                      <input placeholder="Write a comment" type="text">
                      <button><i class="fa fa-camera"></i></button>
                    </div><!--/. Search -->
                  </div><!--/ cardbox-like -->			  
					
			            </div><!--/ cardbox -->

                </div><!--/ col-lg-6 -->	
		   
			
              </div><!--/ row -->
            </div><!--/ container -->
         </section>';
         //echo $image_location;
      echo $post;
    //$rssfeed .= '<title>' . $title . '</title>';
    
    }




?>