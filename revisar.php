<?php
session_start();
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
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_type = '';
    $redirect_page = '';

    // Determinar el tipo de usuario basado en el nombre de usuario
    if (strpos($username, '-cliente') !== false) {
        $user_type = 'cliente';
        $redirect_page = 'indexcliente.php';
    } elseif (strpos($username, '-empleado') !== false) {
        $user_type = 'empleado';
        $redirect_page = 'indexempleado.php';
    } elseif (strpos($username, '-admin') !== false) {
        $user_type = 'adm';
        $redirect_page = 'registros.php';
    }

    if ($user_type !== '') {
        $table = $user_type;
        // Preparar y ejecutar la consulta para buscar el usuario
        $stmt = $conn->prepare("SELECT * FROM $table WHERE nickname=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_hashed_password = $row['contra'];

            // Verificar la contraseña encriptada
            if (password_verify($password, $stored_hashed_password)) {
                // Configurar variables de sesión
                $_SESSION['username'] = $username;
                $_SESSION['nickname'] = $row['nickname'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['apellido'] = $row['apellido'];
                $_SESSION['correo'] = $row['correo'];
                $_SESSION['id'] = $row['id'];
                header("Location: $redirect_page");
                exit();
            } else {
                header("Location: index.php?error=Usuario o contraseña incorrectos");
                exit();
            }
        } else {
            header("Location: index.php?error=Usuario o contraseña incorrectos");
            exit();
        }

        $stmt->close();
    } else {
        header("Location: index.php?error=Usuario no existente");
        exit();
    }
}

$conn->close();
?>
