<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $carrera = $_POST['carrera'];
    $materia = $_POST['materia'];
    $nickname = $_POST['nickname'];
    $correo = $_POST['correo'];

    $sql = "UPDATE alum SET nombres = ?, apellidos = ?, carrera = ?, materia = ?, nickname = ?, correo = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombres, $apellidos, $carrera, $materia, $nickname, $correo, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Estudiante actualizado correctamente']);
    } else {
        echo json_encode(['error' => 'Error al actualizar el estudiante']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>
