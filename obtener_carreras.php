<?php
include "conexion.php";

$sql = $conn->query("SELECT * FROM carrera");
$carreras = [];

while ($row = $sql->fetch_object()) {
    $carreras[] = $row;
}

echo json_encode($carreras);
?>
