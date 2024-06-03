<?php
include "conexion.php";
$nombre =$_POST['nombre'];
$dpi =$_POST['dpi'];
$telefono =$_POST['telefono'];
$fecha =$_POST['fecha'];
$carrera =$_POST['carrera'];
$año =$_POST['año'];
$sql= $conn -> query("INSERT INTO registros(nombre,dpi,telefono,fecha_nacimiento,carrera,año) VALUES('$nombre', '$dpi', '$telefono', '$fecha','$carrera','$año')");
header('Location:Listar.php');
?>