<?php
include "conexion.php";
$id = $_GET['id'];
$nombres = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$grado = $_POST['grado'];
$carrera = $_POST['carrera'];
$nickname = $_POST['nickname'];
$correo = $_POST['correo'];
$notas = $_POST['nota'];
$sql = $conn -> query("UPDATE alum SET nombres ='".$nombres."', apellidos='".$apellidos."', grado='".$grado."', carrera='".$carrera."', nickname='".$nickname."', correo='".$correo."' WHERE id ='".$id."'");
if($sql==1){
    header('Location:indexadmin.php');
}

?>