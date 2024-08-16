<?php
include "conexion.php";

// Consulta para obtener los nombres y apellidos de los clientes
$sqlClientes = "SELECT id, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM cliente";
$resultClientes = $conn->query($sqlClientes);

// Consulta para obtener los nombres de los libros
$sqlLibros = "SELECT id, nombre FROM libros";
$resultLibros = $conn->query($sqlLibros);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = intval($_POST['cliente']);
    $libro_id = intval($_POST['libro']);
    $cantidad = intval($_POST['cantidad']);
    $fecha_prestamo = date('Y-m-d');

    $sqlInsert = $conn->prepare("INSERT INTO prestamos (cliente_id, libro_id, cantidad, fecha_prestamo) VALUES (?, ?, ?, ?)");
    $sqlInsert->bind_param("iiis", $cliente_id, $libro_id, $cantidad, $fecha_prestamo);
    
    if ($sqlInsert->execute()) {
        echo "<div class='alert alert-success'>Préstamo registrado exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al registrar el préstamo.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Préstamo</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="desert.css">
    <style>
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .form-group select, .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Préstamo</h1>
        <form action="registrar_prestamo.php" method="post">
            <div class="form-group">
                <label for="cliente">Cliente:</label>
                <select name="cliente" id="cliente" required>
                    <?php
                    if ($resultClientes->num_rows > 0) {
                        while ($row = $resultClientes->fetch_assoc()) {
                            $id = htmlspecialchars($row['id']);
                            $nombre_completo = htmlspecialchars($row['nombre_completo']);
                            echo "<option value=\"$id\">$nombre_completo</option>";
                        }
                    } else {
                        echo '<option value="">No hay clientes disponibles</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="libro">Libro:</label>
                <select name="libro" id="libro" required>
                    <?php
                    if ($resultLibros->num_rows > 0) {
                        while 
