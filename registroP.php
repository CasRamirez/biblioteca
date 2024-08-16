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

    // Depuración: Imprimir el valor recibido
    if ($tipo != 'cliente' && $tipo != 'empleado') {
        echo "Error: Tipo de usuario no válido.";
        exit();
    }

    check_connection($conn);

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nickname = $_POST['nickname'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    if ($tipo == 'cliente') {
        $sql = "INSERT INTO cliente (nombre, apellido, nickname, correo, contra, usuario_tipo) 
                VALUES (?, ?, ?, ?, ?, 'cliente')";

    } elseif ($tipo == 'empleado') {
        $sql = "INSERT INTO empleado (nombre, apellido, nickname, correo, contra, usuario_tipo) 
                VALUES (?, ?, ?, ?, ?, 'empleado')";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $nombre, $apellido, $nickname, $correo, $hashed_password);

    if ($stmt->execute()) {
        header('Location: index.php?success=Registro exitoso');
        exit();
    } else {
        echo "Error SQL: " . $stmt->error; // Mensaje de error SQL
        exit();
    }
}

$conn->close();
?>
