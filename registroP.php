<?php
include 'conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];
    $nombres = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $carrera = $_POST['carrera'];
    $materia = isset($_POST['materia']) ? $_POST['materia'] : null; // Solo para profesores
    $nickname = $_POST['nickname'];
    $correo = $_POST['correo'];
    $contraseña = md5($_POST['contraseña']);

    // Verificar si el nickname ya existe en la base de datos
    if ($tipo == "docente") {
        $sql_check = "SELECT * FROM prof WHERE nickname=?";
    } else if ($tipo == "alumno") {
        $sql_check = "SELECT * FROM alum WHERE nickname=?";
    }

    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $nickname);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        header('Location: registros.php?error=Cuenta ya existente&tipo=' . $tipo);
        exit();
    } else {
        if ($tipo == "docente") {
            $sql = "INSERT INTO prof (nombres, apellidos, carrera, materia, nickname, correo, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $nombres, $apellidos, $carrera, $materia, $nickname, $correo, $contraseña);
        } else if ($tipo == "alumno") {
            $grado = $_POST['grado']; // Asegúrate de que este campo siempre esté presente
            $sql = "INSERT INTO alum (nombres, apellidos, grado, carrera, nickname, correo, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $nombres, $apellidos, $grado, $carrera, $nickname, $correo, $contraseña);
        }

        if ($stmt->execute()) {
            header('Location: index.php?success=Registro exitoso');
            exit();
        } else {
            header('Location: index.php?error=Error al registrar');
            exit();
        }
    }

    $stmt_check->close();
    $stmt->close();
    $conn->close();
}
?>
