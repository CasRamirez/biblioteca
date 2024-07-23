<?php
include "conexion.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $carrera = $_POST['carrera'];
    $materia = $_POST['materia'];
    $nickname = $_POST['nickname'];
    $correo = $_POST['correo'];

    $sql = $conn->query("UPDATE prof SET 
        nombres = '$nombres', 
        apellidos = '$apellidos', 
        carrera = '$carrera', 
        materia = '$materia', 
        nickname = '$nickname', 
        correo = '$correo'
        WHERE id = $id");

    if ($sql) {
        echo json_encode(['success' => 'Profesor actualizado correctamente']);
    } else {
        echo json_encode(['error' => 'Error al actualizar el profesor']);
    }
} else {
    echo json_encode(['error' => 'Datos no proporcionados']);
}
?>
    