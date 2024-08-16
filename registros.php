<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
require 'conexion.php';
?>

<?php 
                $carreras = [];
                $sql = "SELECT nombre FROM libros";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $carreras[] = $row['nombre'];
                    }
                } else {
                    echo "No se encontraron libros.";
                }
               
                ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Double Slider Login / Registration Form</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="styless.css">
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
        <form id="formCliente" action="registroP.php" method="post">
                <h1>Registro de Clientes</h1>
                <?php
                if (isset($_GET['error']) && $_GET['tipo'] === 'cliente') {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo $_GET['error'];
                    echo "</div>";
                }
                ?>
                <input type="hidden" name="tipo" value="cliente">
                <div class="input-group mb-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre" required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="apellido" class="form-control" placeholder="Ingrese apellidos" required>
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="nickname" id="nicknameCliente" class="form-control"
                        placeholder="Ingrese el Usuario" required onblur="addSuffixToNickname(this, 'cliente')">
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="correo" class="form-control" placeholder="Ingrese el correo" required>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="contraseña" class="form-control" placeholder="Ingrese la contraseña"
                        required>
                </div>
                <div class="row">
                    <center>
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-outline-primary btn-sm">Registrar
                                Cliente</button><br>
                        </div>
                    </center>
                </div>
            </form>
        </div>


        <!-- REGION PROFESORESS -->
        <!-- REGISTROS DE PROFEOSRES -->




        <div class="form-container login-container">
        <form id="formEmpleado" action="registroP.php" method="post">
                <h1>Registro de Empleados</h1>
                <?php
                if (isset($_GET['error']) && $_GET['tipo'] === 'empleado') {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo $_GET['error'];
                    echo "</div>";
                }
                ?>
                <input type="hidden" name="tipo" value="empleado">
                <div class="input-group mb-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Ingrese su nombre completo"
                        required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="apellido" class="form-control" placeholder="Ingrese sus Apellidos"
                        required>
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="nickname" id="nicknameEmpleado" class="form-control"
                        placeholder="Ingrese el Usuario" required onblur="addSuffixToNickname(this, 'empleado')">
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="correo" class="form-control" placeholder="Ingrese el correo" required>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="contraseña" class="form-control" placeholder="Ingrese la contraseña"
                        required>
                </div>
                <div class="row">
                    <center>
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-outline-primary btn-sm">Registrar
                                Empleado</button><br>
                        </div>
                    </center>
                </div>

            </form>        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Registro de Clientes</h1>
                    <p></p>
                    <button class="ghost" id="login">Registro de Empleados
                        <i class="lni lni-arrow-left login"></i>
                    </button>
                    <div class="row">
                        <center>
                            <div class="col-6">
                                <button type="button" class="ghost" id="login"
                                    onclick="window.location.href='indexadmin.php'">Entrar</button><br>
                            </div>
                        </center>
                        <center>
                            <div class="col-6">
                                <button type="button" class="ghost" id="login"
                                    onclick="window.location.href='cerrar.php'">Regresar</button><br>
                            </div>
                        </center>
                    </div>
                </div>




                <div class="overlay-panel overlay-right">
                    <h1 class="title">Registro de Empleados</h1>
                    <p></p>
                    <button class="ghost" id="register">Registro de Clientes
                        <i class="lni lni-arrow-right register"></i>
                    </button>
                    <div class="row">
                        <center>
                            <div class="col-6">
                                <button type="button" class="ghost" id="register"
                                    onclick="window.location.href='indexadmin.php'">Entrar</button><br>
                            </div>
                        </center>
                        <center>
                            <div class="col-6">
                                <button type="button" class="ghost" id="register"
                                    onclick="window.location.href='cerrar.php'">Regresar</button><br>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function addSuffixToNickname(input, suffix) {
        const value = input.value.trim();
        const cursorPosition = input.selectionStart;
        const lastIndexOfSuffix = value.lastIndexOf(suffix);

        if (lastIndexOfSuffix === -1 || cursorPosition <= lastIndexOfSuffix) {
            input.value = value + '-' + suffix;
        } else if (cursorPosition > lastIndexOfSuffix + suffix.length + 1) {
            input.setSelectionRange(lastIndexOfSuffix + suffix.length + 1, lastIndexOfSuffix + suffix.length + 1);
        }
    }
    </script>

    <script>
    function updateGradoOptions() {
        var carreraSelect = document.getElementById('carrera');
        var gradoSelect = document.getElementById('grado');
        var selectedCarrera = carreraSelect.value;

        // Limpiar las opciones actuales del select de grado
        gradoSelect.innerHTML = '<option value="" disabled selected>Seleccione su grado</option>';

        // Definir las opciones de grado
        var gradosPrimaria = ['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto'];
        var gradosOtros = ['Primero', 'Segundo', 'Tercero'];

        var grados = selectedCarrera.toLowerCase() === 'primaria' ? gradosPrimaria : gradosOtros;

        // Agregar las nuevas opciones de grado
        for (var i = 0; i < grados.length; i++) {
            var option = document.createElement('option');
            option.value = grados[i];
            option.text = grados[i];
            gradoSelect.add(option);
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>

</html>