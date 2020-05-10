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

//echo "oui";


function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function timeAgo($time_ago){
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "A l'instant";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "Il y a une minute";
        }
        else{
            return "Il y a $minutes minutes";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "Il y a une heure";
        }else{
            return "Il y a $hours heures";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "Hier";
        }else{
            return "$days jours";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "La semaine dernière";
        }else{
            return "$weeks semaines";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "Il y a un mois";
        }else{
            return "Il y a $months mois";
        }
    }
    //Years
    else{
        /*if($years==1){
            return "one year ago";
        }else{*/
            return "$years ans";
        //}
    }
}

$user_id = 1;

//$sql = "SELECT * FROM posts INNER JOIN users WHERE (users.id=posts.user_id) ORDER BY date_now DESC";
//$sql = "SELECT DISTINCT users.id, users.avatar, users.fullname,posts.post_id, posts.user_id, posts.latitude, posts.longitude, posts.nom_position, posts.image_location, posts.contenu, posts.likes, posts.comment, posts.date_now FROM (followings INNER JOIN posts ON (followings.follow_id=posts.user_id) OR posts.user_id=1 ) INNER JOIN users ON posts.user_id=users.id WHERE(followings.user_id = 1) ORDER BY date_now DESC";
$sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id=users.id WHERE user_id=$user_id ORDER BY date_now DESC";
$result = $conn->query($sql) or die ("Could not execute query");
 
while($row = mysqli_fetch_array($result)) {
    extract($row);
    //echo $row;
    //$actual_hour = time_elapsed_string($date_now, true);
    $actual_hour = timeAgo($date_now);
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
                        <a class="dropdown-item" href="#">Stop following</a>
                      </div>
			              </div><!--/ dropdown -->
			              <div class="media m-0">
			                <div class="d-flex mr-3">
                       <a href=""><img class="img-fluid rounded-circle" src="'.$avatar.'" alt="User"></a>
                      </div>
			                <div class="media-body">
                        <p class="m-0">'.$fullname.'</p>
                        <small><span onclick="showOnMap('.$latitude.','.$longitude.')" style="cursor: pointer;"><i class="icon ion-md-pin"></i> '.$nom_position.'</span></small>
                        </br>
                        <small><span><i class="icon ion-md-time"></i>'.$actual_hour.'</span></small>
                      </div>
			              </div><!--/ media -->
                  </div><!--/ cardbox-heading -->
                  <div class="cardbox-item">
                    <img class="img-fluid" src="'.$image_location.'" alt="Image inafficheable">
                  </div><!--/ cardbox-item -->
                  <div class="cardbox-base">
                    <ul class="float-right">
                      <li><a><i class="fa fa-comments"></i></a></li>
                      <li><a><em class="mr-5">'.$comment.'</em></a></li>
                      <!--<li><a><i class="fa fa-share-alt"></i></a></li>
                      <li><a><em class="mr-3">'.'PLACER LE NOMBRE DE PARTAGES ICI'.'</em></a></li>-->
                    </ul>
                    <ul>
                      <!--<li><a><i class="fa fa-thumbs-up"></i></a></li>
                      <!--<li><a href="#"><img src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/3.jpeg" class="img-fluid rounded-circle" alt="User"></a></li>
                      <li><a href="#"><img src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/1.jpg" class="img-fluid rounded-circle" alt="User"></a></li>
                      <li><a href="#"><img src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/5.jpg" class="img-fluid rounded-circle" alt="User"></a></li>
                      <li><a href="#"><img src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/2.jpg" class="img-fluid rounded-circle" alt="User"></a></li>-->
                      ';
                      
                      // determine if user has already liked this post
                      $results1 = mysqli_query($conn, "SELECT * FROM likes WHERE user_id=$user_id AND post_id=".$row['post_id']."");

                      if (mysqli_num_rows($results1) == 1 ){ 
                        $post.='<!-- user already likes post -->
                        <li><a><i id="'.$post_id.'" onclick="unlike('.$post_id.')" class="unlike fa fa-thumbs-up" data-id="'.$row['id'].'"></i> </a></li>
                        <li><a><i id="'.$post_id.'" onclick="like('.$post_id.')" class="like hide fa fa-thumbs-o-up" data-id="'.$row['id'].'"></i></a></li> ';
                      }
                      else{
                        $post.='<!-- user has not yet liked post -->
                        <li><a><i id="'.$post_id.'" onclick="like('.$post_id.')" class="like fa fa-thumbs-o-up" data-id="'.$row['id'].'"></i> </a></li>
                        <li><a><i id="'.$post_id.'" onclick="unlike('.$post_id.')" class="unlike hide fa fa-thumbs-up" data-id="'.$row['id'].'"></i></a></li> ';
                      }
                      $post.='<li><a><span id="'.$post_id.'" class="likes_count">'.$likes.'</span></a></li>';
                      
                $post.='</ul>			   
                  </div><!--/ cardbox-base -->
                  <div class="cardbox-comments ">';

                  $result2 = mysqli_query($conn,"SELECT comments.comment_id, comments.user_id, comments.post_id, comments.contenu, users.avatar FROM comments INNER JOIN users ON comments.user_id=users.id WHERE comments.post_id = ".$row['post_id']." ORDER BY comment_id");

                  $post.='<table class="table'.$post_id.'">';
                  while($row2 = mysqli_fetch_array($result2)) {
                    $post.='<tr>
                    <td>
                              <span class="comment-avatar float-left">
                                <a href=""><img class="rounded-circle" src="'.$avatar.'" alt="..."></a>                            
                              </span></tr>
                              </td>
                              <td>
                              <div class="search">
                                <label>'.$row2['contenu'].'</label>
                                <!--<button><i class="fa fa-camera"></i></button>-->
                              </div><!--/. Search -->
                              </td>
                            </tr>
                            ';
                  }

                  $post.='<tr class="commentspace'.$post_id.'">
                  <td>
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
                            </td>
                          </tr>
                          </table>';

                  $post.='</div><!--/ cardbox-like -->			  
					
			            </div><!--/ cardbox -->

                </div><!--/ col-lg-6 -->	
		   
			
              </div><!--/ row -->
            </div><!--/ container -->
         </section>';
                  
      echo $post;
    
    }

?>