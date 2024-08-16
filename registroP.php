<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibli";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function check_connection($conn) {
    if (!$conn->ping()) {
        global $servername, $username, $password, $dbname;
        $conn->close();
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = isset($_POST['tipo']) ? trim($_POST['tipo']) : '';

    // Mensaje de depuración para verificar el valor de tipo
    echo "Tipo recibido: $tipo"; 
    exit(); // Salir después de mostrar el valor para verificar

    if ($tipo == 'cliente') {
        check_connection($conn);

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nickname = $_POST['nickname'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "INSERT INTO cliente (nombre, apellido, nickname, correo, contra) 
                VALUES ('$nombre', '$apellido', '$nickname', '$correo', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            header('Location: index.php?success=Registro exitoso');
            exit();
        } else {
            header('Location: index.php?error=Error al registrar');
            exit();
        }

    } elseif ($tipo == 'empleado') {
        check_connection($conn);

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nickname = $_POST['nickname'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "INSERT INTO empleado (nombre, apellido, nickname, correo, contra) 
                VALUES ('$nombre', '$apellido', '$nickname', '$correo', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            header('Location: index.php?success=Registro exitoso');
            exit();
        } else {
            header('Location: index.php?error=Error al registrar');
            exit();
        }

    } elseif ($tipo == 'admin') {
        check_connection($conn);

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nickname = $_POST['nickname'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "INSERT INTO adm (nombre, apellido, nickname, correo, contra) 
                VALUES ('$nombre', '$apellido', '$nickname', '$correo', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            header('Location: index.php?success=Registro exitoso');
            exit();
        } else {
            header('Location: index.php?error=Error al registrar');
            exit();
        }
    } else {
        echo "Error: Tipo de usuario no válido.";
        exit();
    }
}

$conn->close();
?>
