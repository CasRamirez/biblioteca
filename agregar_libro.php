<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibli";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Preparar y ejecutar la consulta de inserción
    $stmt = $conn->prepare("INSERT INTO libros (nombre, descripcion) VALUES (?, ?)");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param('ss', $nombre, $descripcion);

    if ($stmt->execute()) {
        header('Location: index.php?success=Libro agregado exitosamente');
        exit();
    } else {
        header('Location: agregar_libro.php?error=' . urlencode($stmt->error));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
