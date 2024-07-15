<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Double Slider Login / Registration Form</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
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
        <div class="form-container login-container">
            <form class="user" action="revisar.php" method="post">
                <h1>Iniciar sesión</h1>
                <?php
                if(isset($_GET['error'])){
                    $error = $_GET['error'];
                    if($error === 'usuario_no_existente') {
                        echo "<div class='alert alert-danger' role='alert'>Usuario no existente</div>";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>$error</div>";
                    }
                }
                ?>
                <input type="text" name="username" placeholder="Ingrese su usuario" required>
                <input type="password" name="password" placeholder="Ingrese su contraseña" required>
                <div class="content">
                    <div class="checkbox">
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <label>Recuérdame</label>
                    </div>
                </div>
                <button type="submit">Iniciar sesión</button>
                <div class="pass-link">
                    <a href="interfazcontra.php">¿Olvidaste tu contraseña? </a>
                </div>
                <span>O utiliza tu cuenta</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
                    <a href="#" class="social"><i class="lni lni-google"></i></a>
                    <a href="#" class="social"><i class="lni lni-linkedin-original"></i></a>
                </div>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1 class="title">BIENVENIDOS</h1>
                    <p>Oscar Rolando Casasola Ramirez <br> Carlos Samuel Andres Coy Flores</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addAlumToNickname(input) {
            const value = input.value.trim();
            const cursorPosition = input.selectionStart;
            const lastIndexOfAlum = value.lastIndexOf('-alum');

            if (lastIndexOfAlum === -1 || cursorPosition <= lastIndexOfAlum) {
                input.value = value + '-alum';
            } else if (cursorPosition > lastIndexOfAlum + 5) {
                input.setSelectionRange(lastIndexOfAlum + 5, lastIndexOfAlum + 5);
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>
</html>
