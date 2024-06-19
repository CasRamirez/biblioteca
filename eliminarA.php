<?php
include "conexion.php";

$id = $_GET['id'];

$conn -> query("DELETE FROM alum WHERE id ='". $id."'");
header('Location:indexadmin.php');
?>