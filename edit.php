<?php
include "conexion.php";
$id = $_GET['id'];
$nombre =$_POST['nombre'];
$dpi =$_POST['dpi'];
$telefono =$_POST['telefono'];
$fecha =$_POST['fecha'];
$carrera =$_POST['carrera'];
$año =$_POST['año'];
$sql = $conn -> query("UPDATE registros SET nombre ='".$nombre."', dpi='".$dpi."', telefono='".$telefono."', fecha_nacimiento='".$fecha."', carrera='".$carrera."', año='".$año."' WHERE id ='".$id."'");
if($sql==1){
    header('Location:Listar.php');
}

?>