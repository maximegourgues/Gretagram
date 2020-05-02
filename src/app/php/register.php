<?php
include 'db.inc.php';

$sql = "INSERT INTO user (id,name,password) VALUE
('".$_POST["id"]."','".$_POST["name"]."','".$_POST["password"]."')";

$conn -> close();
?>
