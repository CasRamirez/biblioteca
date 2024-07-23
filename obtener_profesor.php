<?php
include "conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = $conn->query("SELECT * FROM prof WHERE id = $id");
    if ($dat = $sql->fetch_object()) {
        echo json_encode($dat);
    } else {
        echo json_encode(['error' => 'No se encontró el profesor']);
    }
} else {
    echo json_encode(['error' => 'ID no proporcionado']);
}
?>
