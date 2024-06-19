<?php
include 'conexion.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];
    $nombres = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $materia = $_POST['materia'];
    $carrera = $_POST['carrera'];
    $nickname = $_POST['nickname'];
    $correo = $_POST['correo'];
    $contra = ($_POST['contraseña']);
    $contraseña = md5($_POST['contraseña']);

    $sql = "SELECT * FROM alum WHERE nickname='$nickname'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header('Location:index.php?error=Cuenta ya existente');
    } else {
    if ($tipo == "alumno") {
        $sql = "INSERT INTO alum (nombres, apellidos, grado, carrera, nickname, correo, contra, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    } else if ($tipo == "docente") {
        $sql = "INSERT INTO prof (nombres, apellidos, carrera, materia, nickname, correo, contra, contraseña) VALUES (?, ?, ?, ?, ?, ?)";
    }}

    if ($stmt = $conn->prepare($sql)) {
        if ($tipo == "alumno") {
            $stmt->bind_param("ssssssss", $nombres, $apellidos, $grado, $carrera, $nickname, $correo, $contra, $contraseña);
        } else if ($tipo == "docente") {
            $stmt->bind_param("ssssss", $nombres, $apellidos, $carrera, $materia,$nickname, $correo, $contra, $contraseña);
        }
        if ($stmt->execute()) {
            echo "Registro exitoso!";
        } else {
            echo "Error al registrar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
    header('Location: index.php');
    exit();
}
?>
