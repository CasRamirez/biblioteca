<?php
include "conexion.php";
$id = $_GET['id'];
$nombres = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$nickname = $_POST['nickname'];
$correo = $_POST['correo'];
$sql = $conn -> query("UPDATE cliente SET nombre ='".$nombres."', apellido='".$apellidos."',nickname='".$nickname."', correo='".$correo."' WHERE id ='".$id."'");
if($sql==1){
    header('Location:indexadmin.php');
}

?>