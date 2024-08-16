<?php
include "conexion.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Verificar en qué tabla se encuentra el usuario
    $checkCliente = $conn->prepare("SELECT id FROM cliente WHERE id = ?");
    $checkCliente->bind_param("i", $id);
    $checkCliente->execute();
    $checkCliente->store_result();

    $checkEmpleado = $conn->prepare("SELECT id FROM empleado WHERE id = ?");
    $checkEmpleado->bind_param("i", $id);
    $checkEmpleado->execute();
    $checkEmpleado->store_result();

    // Preparar la actualización según la tabla donde se encuentre el usuario
    if ($checkCliente->num_rows > 0) {
        // Usuario encontrado en la tabla `cliente`
        $sql = $conn->prepare("UPDATE cliente SET estado = 1, razon = '' WHERE id = ?");
        $sql->bind_param("i", $id);
        $result = $sql->execute();
    } elseif ($checkEmpleado->num_rows > 0) {
        // Usuario encontrado en la tabla `empleado`
        $sql = $conn->prepare("UPDATE empleado SET estado = 1, razon = '' WHERE id = ?");
        $sql->bind_param("i", $id);
        $result = $sql->execute();
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado.";
        exit();
    }

    // Verificar si la actualización fue exitosa
    if ($result) {
        echo "Usuario activado exitosamente.";
    } else {
        echo "Error al activar el usuario.";
    }
} else {
    echo "ID no proporcionado.";
}
?>
