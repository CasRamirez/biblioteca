<?php
// Conexión a la base de datos
require 'conexion.php';

// Consulta para obtener el historial de préstamos con la información del cliente y del libro, incluyendo la fecha de devolución
$sql = "
    SELECT 
        p.fecha_prestamo,
        p.fecha_devolucion,
        c.nombre AS cliente_nombre,
        c.apellido AS cliente_apellido,
        c.nickname AS cliente_nickname,
        l.nombre AS libro_nombre,
        p.cantidad AS cantidad_libros
    FROM prestamos p
    INNER JOIN cliente c ON p.cliente_id = c.id
    INNER JOIN libros l ON p.libro_id = l.id
";

// Ejecutar la consulta
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Préstamos</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <h1>Historial de Préstamos</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre del Cliente</th>
                    <th>Apellido del Cliente</th>
                    <th>Nickname del Cliente</th>
                    <th>Nombre del Libro</th>
                    <th>Cantidad de Libros Prestados</th>
                    <th>Fecha del Préstamo</th>
                    <th>Fecha de Devolución</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['cliente_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['cliente_apellido']); ?></td>
                    <td><?php echo htmlspecialchars($row['cliente_nickname']); ?></td>
                    <td><?php echo htmlspecialchars($row['libro_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['cantidad_libros']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_prestamo']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_devolucion']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
