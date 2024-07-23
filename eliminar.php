<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include "conexion.php";

$id = $_GET['id'];
$reason = isset($_GET['reason']) ? $_GET['reason'] : '';
$username = $_SESSION['username']; 

if (!empty($reason)) {
    $stmt = $conn->prepare("UPDATE prof SET estado = 0, razon = ?, user_delete = ? WHERE id = ?");
    $stmt->bind_param("ssi", $reason, $username, $id);
    $stmt->execute();
    $stmt->close();
    header('Location: indexadminP.php');
} else {
    echo 'No se proporcionó una razón. No se realizó ninguna actualización.';
}
?>
