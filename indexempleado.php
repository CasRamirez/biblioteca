<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
require 'conexion.php';

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
    $fecha_devolucion = $_POST['fecha_devolucion']; // Nueva fecha de devolución

    // Consulta para obtener la cantidad disponible del libro
    $sqlCheckStock = $conn->prepare("SELECT cantidad FROM libros WHERE id = ?");
    $sqlCheckStock->bind_param("i", $libro_id);
    $sqlCheckStock->execute();
    $resultStock = $sqlCheckStock->get_result();
    
    if ($resultStock->num_rows > 0) {
        $row = $resultStock->fetch_assoc();
        $cantidadDisponible = $row['cantidad'];

        if ($cantidad <= $cantidadDisponible) {
            // Registro del préstamo
            $sqlInsert = $conn->prepare("INSERT INTO prestamos (cliente_id, libro_id, cantidad, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?, ?)");
            $sqlInsert->bind_param("iiiss", $cliente_id, $libro_id, $cantidad, $fecha_prestamo, $fecha_devolucion);
            
            if ($sqlInsert->execute()) {
                // Actualizar la cantidad disponible del libro
                $nuevaCantidad = $cantidadDisponible - $cantidad;
                $sqlUpdateStock = $conn->prepare("UPDATE libros SET cantidad = ? WHERE id = ?");
                $sqlUpdateStock->bind_param("ii", $nuevaCantidad, $libro_id);
                $sqlUpdateStock->execute();
                
                echo "<div class='alert alert-success'>Préstamo registrado exitosamente.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error al registrar el préstamo.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Libros insuficientes.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>El libro seleccionado no existe.</div>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Préstamos</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="desert.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    /* Contenedor personalizado para el select */
    .custom-select-container {
        position: relative;
        display: flex;
        align-items: center;
        border: 1px solid #ced4da;
        border-radius: 5px;
        background-color: #fff;
        padding: 5px;
    }

    /* Estilo personalizado para el select */
    .custom-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        border: none;
        background: none;
        font-size: 16px;
        padding: 10px;
        width: 100%;
        outline: none;
        color: #495057;
    }

    /* Flecha personalizada */
    .custom-select-container::after {
        content: '\f078';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        right: 10px;
        pointer-events: none;
        color: #495057;
    }

    /* Efecto al enfocar */
    .custom-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Ajuste del padding del input cuando tiene contenido */
    .custom-select:not(:placeholder-shown) {
        padding-right: 30px;
    }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container register-container">
            <form id="formCliente" action="" method="post">
                <h1>Registro de Préstamos</h1>
                <?php
                if (isset($_GET['error']) && $_GET['tipo'] === 'cliente') {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo $_GET['error'];
                    echo "</div>";
                }
                ?>

                <div class="form-group">
                    <label for="cliente">Nombre del cliente:</label>
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
                    <label for="libro">Nombre del libro:</label>
                    <select name="libro" id="libro" required>
                        <?php
                        if ($resultLibros->num_rows > 0) {
                            while ($row = $resultLibros->fetch_assoc()) {
                                $id = htmlspecialchars($row['id']);
                                $nombre = htmlspecialchars($row['nombre']);
                                echo "<option value=\"$id\">$nombre</option>";
                            }
                        } else {
                            echo '<option value="">No hay libros disponibles</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" id="cantidad" min="1" required>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha de préstamo:</label>
                    <input type="date" name="fecha" id="fecha" required>
                </div>

                <div class="form-group">
                    <label for="fecha_devolucion">Fecha de devolución:</label>
                    <input type="date" name="fecha_devolucion" id="fecha_devolucion" required>
                </div>

                <div class="row">
                    <center>
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-outline-primary btn-sm">Registrar Préstamo</button><br>
                        </div>
                    </center>
                </div>
            </form>
        </div>

        <!-- REGISTROS DE LIBROS -->
        <div class="form-container login-container">
            <form id="formEmpleado" action="agregar_libro.php" method="post">
                <h1>Registro de Libros</h1>
                <?php
                if (isset($_GET['error']) && $_GET['tipo'] === 'empleado') {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo $_GET['error'];
                    echo "</div>";
                }
                ?>
                <input type="hidden" name="tipo" value="empleado">
                <div class="input-group mb-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre del libro" required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="descripcion" class="form-control" placeholder="Ingrese la trama" required>
                </div>
                <div class="input-group mb-3">
                    <input type="number" name="cantidad" class="form-control" placeholder="Ingrese cantidad" required>
                </div>

                <div class="row">
                    <center>
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-outline-primary btn-sm">Registrar Libro</button><br>
                        </div>
                    </center>
                </div>

            </form>
        </div>

        <!-- OVERLAY -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Préstamos</h1>
                    <p></p>
                    <button class="ghost" id="login">Registro de libros
                        <i class="lni lni-arrow-left login"></i>
                    </button>
                    <div class="row">
                        <center>
                            <div class="col-6">
                                <button type="button" class="ghost" id="login" onclick="window.location.href='indexprof.php'">Entrar</button><br>
                            </div>
                        </center>
                        <center>
                            <div class="col-6">
                                <button type="button" class="ghost" id="login" onclick="window.location.href='cerrar.php'">Regresar</button><br>
                            </div>
                        </center>
                    </div>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1 class="title">Registro de Libros</h1>
                    <p></p>
                    <button class="ghost" id="register">Préstamos
                        <i class="lni lni-arrow-right register"></i>
                    </button>
                    <div class="row">
                        <center>
                            <div class="col-6">
                                <button type="button" class="ghost" id="register" onclick="window.location.href='indexprof.php'">Entrar</button><br>
                            </div>
                        </center>
                        <center>
                            <div class="col-6">
                                <button type="button" class="ghost" id="register" onclick="window.location.href='cerrar.php'">Regresar</button><br>
                            </div>
                        </center>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>
