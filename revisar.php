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
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['contra'];

            // Verificar la contraseña
            $password_valid = false;
            if ($user_type === 'adm') {
                // Para el usuario admin, comparar la contraseña usando MD5
                if ($password === $stored_password) {
                    $password_valid = true;
                }
            } else {
                // Para clientes y empleados, verificar la contraseña usando MD5
                if (md5($password) === $stored_password) {
                    $password_valid = true;
                } else {
                    echo "Contraseña incorrecta o encriptación no coincide.";
                }
            }

            if ($password_valid) {
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
