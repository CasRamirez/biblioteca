<?php
include "conexion.php";
$id = $_GET['id'];
$nombres = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$carrera = $_POST['cantidad'];
$sql = $conn -> query("UPDATE libros SET nombre ='".$nombres."', descripcion='".$apellidos."', cantidad='".$carrera."'WHERE id ='".$id."'");
if($sql==1){
    header('Location:libros.php');
}

?>