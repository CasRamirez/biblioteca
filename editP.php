<?php
include "conexion.php";
$id = $_GET['id'];
$nombres = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$carrera = $_POST['carrera'];
$grado = $_POST['grado'];
$materia = $_POST['materia'];
$nickname = $_POST['nickname'];
$correo = $_POST['correo'];
$sql = $conn -> query("UPDATE prof SET nombres ='".$nombres."', apellidos='".$apellidos."', carrera='".$carrera."', grado='".$grado."', materia='".$materia."', nickname='".$nickname."', correo='".$correo."' WHERE id ='".$id."'");
if($sql==1){
    header('Location:indexadmin.php');
}

?>