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

//$user_id = $_POST['user_id'];

$sql = "SELECT posts.post_id, posts.latitude, posts.longitude FROM posts";
$result = mysqli_query($conn,$sql);

$myobj = '{"type": "FeatureCollection","generator":"overpass-turbo","timestamp": "2015-08-08T19:03:02Z","features": [';
    while($row =mysqli_fetch_assoc($result))
    {
      if(isset($row['longitude'])){
        $myobj.='{"type":"Feature","properties":{"post_id":"'.$row['post_id'].'"},"geometry":{"type": "Point","coordinates": ['.$row['longitude'].','.$row['latitude'].']}},';
      }
    }
    $myobj.='{"type":"Feature","properties":{"post_id":"0"},"geometry":{"type":"Point","coordinates":[0,0]}}]}';


$fp = fopen('postsLocation.json', 'w');
fwrite($fp, $myobj);
fclose($fp);

//echo json_encode($emparray);
echo $myobj;

?>