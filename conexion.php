<?php
$sn = "localhost";//sn= server name
$db = "cole";//db = database
$user = "root";
$pass = "";
$conn = mysqli_connect($sn,$user,$pass,$db);
if(!$conn){
    die("Error: ".mysqli_connect_error());
}

?>