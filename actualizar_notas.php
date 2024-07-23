<?php
include "conexion.php";

// Asegúrate de que los datos estén disponibles
if (isset($_POST['notas']) && isset($_POST['carrera'])) {
    $notas = $_POST['notas'];
    $carrera = $_POST['carrera'];

    // Preparar y ejecutar actualizaciones
    foreach ($notas as $id => $nota) {
        $nota = intval($nota);
        if ($nota >= 1 && $nota <= 100) {
            $sql = $conn->prepare("UPDATE alum SET notas = ? WHERE id = ? AND FIND_IN_SET(carrera, ?) > 0");
            $sql->bind_param("iis", $nota, $id, $carrera);
            $sql->execute();
        }
    }

    // Redirigir después de actualizar
    header('Location: notasP.php?carrera=' . urlencode($carrera) . '&success=Notas actualizadas');
    exit();
} else {
    echo "Datos no válidos.";
}

$conn->close();
?>
