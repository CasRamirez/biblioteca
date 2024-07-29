<?php
include "conexion.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Preparar la actualización para la tabla `alum`
    $sql1 = $conn->prepare("UPDATE alum SET estado = 1, razon = '' WHERE id = ?");
    $sql1->bind_param("i", $id);
    $result1 = $sql1->execute();

    // Preparar la actualización para la tabla `prof`
    $sql2 = $conn->prepare("UPDATE prof SET estado = 1, razon = '' WHERE id = ?");
    $sql2->bind_param("i", $id);
    $result2 = $sql2->execute();

    // Verificar si al menos una de las actualizaciones fue exitosa
    if ($result1 || $result2) {
        header("Location: delete_reg.php"); // Redirige a la página de registros eliminados
    } else {
        echo "Error al activar el registro.";
    }
} else {
    echo "ID no proporcionado.";
}
?>
