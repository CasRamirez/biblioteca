<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Double Slider Login / Registration Form</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="stylesss.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <style>
        .error-message {
            display: none;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .user-not-found {
            display: none;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .right-panel-active .user-not-found {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container register-container">
            <form id="formAlumno" action="recuperar.php" method="post">
                <h1>Ingresa nueva contraseña</h1>
                <div id="update-message" class="error-message">Mensaje de actualización</div>
                <div class="input-group mb-3">
                    <input type="password" name="contraseña" id="new-password" class="form-control" placeholder="Ingrese la contraseña" required>
                </div>
                <input type="hidden" id="hidden-nickname" name="nickname">
                <input type="hidden" id="hidden-tipoUsuario" name="tipoUsuario">
                <div class="row">
                    <center>
                        <div class="col-6">
                            <button type="button" id="updateButton" class="btn btn-block btn-outline-primary btn-sm">Registrar contraseña</button><br>
                        </div>
                       
                    </center>
                </div>
            </form>
        </div>
        <div class="form-container login-container">
            <form id="formDocente" action="recuperar.php" method="post">
                <h1>Ingrese el usuario</h1>
                <div id="error-message" class="error-message">Por favor, ingrese un usuario válido.</div>
                <div id="user-not-found" class="user-not-found">Este usuario no existe.</div>
                <input type="hidden" name="tipo" value="docente">
                <div class="input-group mb-3">
                    <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Ingrese su usuario" required>
                </div>
                <div class="row">
                    <center>
                        <div class="col-6">
                            <button type="button" id="solicitudButton" class="btn btn-block btn-outline-primary btn-sm">Enviar solicitud</button>
                        </div>
                        
                    </center>
                </div>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Hola de nuevo</h1>
                    <p>Ingresa tu nueva contraseña</p>
                    <div class="col-6">
                            <button type="button" onclick="window.location.href='cerrar.php'" class="ghost">Regresar al inicio</button>
                        </div>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="title">¿Olvidó su contraseña?</h1>
                    <p>Lo entendemos, a veces ocurren estas cosas. <br> ¡Simplemente ingrese el usuario al que desea cambiar la contraseña!</p>
                    <div class="col-6">
                            <button type="button" onclick="window.location.href='cerrar.php'" class="ghost">Regresar al inicio</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.getElementById('solicitudButton').addEventListener('click', function() {
            var nickname = document.getElementById('nickname').value;
            var errorMessage = document.getElementById('error-message');
            var userNotFoundMessage = document.getElementById('user-not-found');

            if (nickname.trim() === "") {
                errorMessage.textContent = "Por favor, ingrese un usuario.";
                errorMessage.style.display = "block";
                userNotFoundMessage.style.display = "none";
            } else {
                errorMessage.style.display = "none";

                // Hacer la solicitud AJAX para verificar el usuario
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'recuperar.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Usuario encontrado, mostrar la interfaz correspondiente
                            document.getElementById('container').classList.add('right-panel-active');
                            userNotFoundMessage.style.display = "none";
                            document.getElementById('hidden-nickname').value = nickname;
                            document.getElementById('hidden-tipoUsuario').value = response.user.usuario_tipo;
                        } else {
                            // Usuario no encontrado, mostrar mensaje de error
                            userNotFoundMessage.style.display = "block";
                        }
                    } else {
                        // Error de conexión u otro tipo de error
                        console.error('Error al realizar la solicitud.');
                    }
                };

                xhr.onerror = function() {
                    console.error('Error de red.');
                };

                xhr.send('nickname=' + encodeURIComponent(nickname));
            }
        });

        document.getElementById('updateButton').addEventListener('click', function() {
            var contraseña = document.getElementById('new-password').value;
            var nickname = document.getElementById('hidden-nickname').value;
            var tipoUsuario = document.getElementById('hidden-tipoUsuario').value;
            var updateMessage = document.getElementById('update-message');

            if (contraseña.trim() === "") {
                updateMessage.textContent = "Por favor, ingrese una contraseña.";
                updateMessage.style.display = "block";
            } else {
                updateMessage.style.display = "none";

                // Hacer la solicitud AJAX para actualizar la contraseña
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'actualizar_contrasena.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                            xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            updateMessage.textContent = response.message;
                            updateMessage.style.display = "block";
                            updateMessage.style.color = "green";

                            // Redirigir al usuario a index.php después de 2 segundos
                            setTimeout(function() {
                                window.location.href = 'index.php';
                            }, 2000);
                        } else {
                            updateMessage.textContent = response.message;
                            updateMessage.style.display = "block";
                            updateMessage.style.color = "red";
                        }
                    } else {
                        console.error('Error al realizar la solicitud.');
                    }
                };

                xhr.onerror = function() {
                    console.error('Error de red.');
                };

                xhr.send('contraseña=' + encodeURIComponent(contraseña) +
                         '&nickname=' + encodeURIComponent(nickname) +
                         '&tipoUsuario=' + encodeURIComponent(tipoUsuario));
            }
        });
    </script>
    <script src="script.js"></script>
</body>

</html>
