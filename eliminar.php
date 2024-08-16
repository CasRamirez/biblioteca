<?php
include "conexion.php";

if (isset($_GET['id']) && isset($_GET['reason']) && isset($_GET['nickname'])) {
    $id = $_GET['id'];
    $reason = $_GET['reason'];
    $nickname = $_GET['nickname'];

    // Actualiza el registro con la razón de eliminación y el usuario que realizó la eliminación
    $sql = $conn->prepare("UPDATE empleado SET estado = 0, razon = ?, user_delete = ? WHERE id = ?");
    $sql->bind_param("ssi", $reason, $nickname, $id);

    if ($sql->execute()) {
        // Redirigir a la página de administración después de la eliminación exitosa
        header("Location: indexadminP.php");
        exit();
    } else {
        echo "Error actualizando el registro: " . $conn->error;
    }

    $sql->close();
    $conn->close();
} else {
    echo "Datos incompletos.";
}
?>
