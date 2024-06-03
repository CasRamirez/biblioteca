<?php
include "conexion.php";

$id = $_GET['id'];

$conn -> query("DELETE FROM registros WHERE id ='". $id."'");
header('Location:Listar.php');
?>