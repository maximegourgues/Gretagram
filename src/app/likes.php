<?php 
	// connect to the database
	$server ="localhost";
    $login = "root";
    $mdp = "";
    $db = "gretabase";

    ///Connexion au serveur MySQL

    $con = new mysqli($server, $login, $mdp, $db);

    if($con->connect_error){
    die("Failed to connect".$con->connect_error);
    }else{
    // header("Location: index.html?connectionsucces");
    //echo "Connection succes";
    }
    $userid = $_POST['userid'];
    $postid = $_POST['postid'];
    $result = mysqli_query($con, "SELECT likes AS nb FROM posts WHERE (post_id=$postid)");
    $row = mysqli_fetch_array($result);  
    $n = $row['nb']; 

	if (isset($_POST['liked'])) { 
        //if($n=1){$n=0;}

		mysqli_query($con, "INSERT INTO likes (user_id, post_id) VALUES ($userid, $postid)");
		mysqli_query($con, "UPDATE posts SET likes=$n+1 WHERE post_id=$postid");
        
		echo $n+1;
		exit();
	}
	if (isset($_POST['unliked'])) {
        //if($n=1){$n=-1;}   

		mysqli_query($con, "DELETE FROM likes WHERE post_id=$postid AND user_id=$userid");
		mysqli_query($con, "UPDATE posts SET likes=$n-1 WHERE post_id=$postid");
		
		echo $n-1;
		exit();
	}

	// Retrieve posts from the database
	//$posts = mysqli_query($con, "SELECT * FROM posts");
?>