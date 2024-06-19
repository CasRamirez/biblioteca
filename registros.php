<!DOCTYPE html>
<html lang="en">

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
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container register-container">
            <form id="formAlumno" action="registroP.php" method="post">
                <h1>Registro de Alumnos</h1>
                <?php
                if (isset($_GET['error']) && $_GET['tipo'] === 'alumno') {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo $_GET['error'];
                    echo "</div>";
                }
                ?>
                <input type="hidden" name="tipo" value="alumno">
                <div class="input-group mb-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre" required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="apellido" class="form-control" placeholder="Ingrese apellidos" required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="carrera" class="form-control" placeholder="Ingrese carrera" required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="grado" class="form-control" placeholder="Ingrese grado" required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="nickname" id="nicknameAlumno" class="form-control"
                        placeholder="Ingrese el Usuario" required onblur="addSuffixToNickname(this, 'alum')">
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
                                Alumno</button><br>
                        </div>
                    </center>
                </div>
            </form>
        </div>
        <div class="form-container login-container">
            <form id="formDocente" action="registroP.php" method="post">
                <h1>Registro de Profesores</h1>
                <?php
                if (isset($_GET['error']) && $_GET['tipo'] === 'docente') {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo $_GET['error'];
                    echo "</div>";
                }
                ?>
                <input type="hidden" name="tipo" value="docente">
                <div class="input-group mb-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Ingrese su nombre completo"
                        required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="apellido" class="form-control" placeholder="Ingrese sus Apellidos"
                        required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="carrera" class="form-control" placeholder="Ingrese su carrera" required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="materia" class="form-control" placeholder="Ingrese materia a impartir"
                        required>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="nickname" id="nicknameProfesor" class="form-control"
                        placeholder="Ingrese el Usuario" required onblur="addSuffixToNickname(this, 'prof')">
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
                                Profesor</button><br>
                        </div>
                    </center>
                </div>
                
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Registro de Alumnos</h1>
                                 <p></p>
                    <button class="ghost" id="login">Registro de Profesores
                        <i class="lni lni-arrow-left login"></i>
                    </button>
                    <div class="row">
                    <center>
                        <div class="col-6">
                            <button type="button" class="ghost" id="login" onclick="window.location.href='indexadmin.php'">Entrar</button><br>
                        </div>
                    </center>
                    <center>
                        <div class="col-6">
                            <button type="button" class="ghost" id="login" onclick="window.location.href='index.php'">Regresar</button><br>
                        </div>
                    </center>
                </div>
                </div>
                
                <div class="overlay-panel overlay-right">
                    <h1 class="title">Registro de Profesores</h1>
                    <p></p>
                    <button class="ghost" id="register">Registro de Alumnos
                        <i class="lni lni-arrow-right register"></i>
                    </button>
                    <div class="row">
                        <center>
                            <div class="col-6">
                                <button type="button" class="ghost" id="register" onclick="window.location.href='indexadmin.php'">Entrar</button><br>
                            </div>
                         </center>
                         <center>
                            <div class="col-6">
                                <button type="button" class="ghost" id="register" onclick="window.location.href='index.php'">Regresar</button><br>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>

</html>

