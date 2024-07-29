<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include "conexion.php";

$curso_id = isset($_POST['curso']) ? (int)$_POST['curso'] : 0;
$alumno_id = isset($_POST['alumno']) ? (int)$_POST['alumno'] : 0;
$nota = isset($_POST['nota']) ? (float)$_POST['nota'] : 0;

if ($curso_id > 0 && $alumno_id > 0 && $nota >= 0 && $nota <= 10) {
    // Insertar o actualizar la nota en la base de datos
    $stmt = $conn->prepare("REPLACE INTO notas (id_curso, id_alum, nota) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $curso_id, $alumno_id, $nota);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Nota guardada exitosamente.";
    } else {
        $_SESSION['message'] = "Error al guardar la nota.";
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "Datos inválidos.";
}

header("Location: notasP.php");
exit();
?>
