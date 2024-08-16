<?php
include "conexion.php";

$id = $_GET['id'];

$conn -> query("DELETE FROM libros WHERE id ='". $id."'");
header('Location:libros.php');
?>