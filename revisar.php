<?php
session_start();
$servername = "localhost";
$username = "root"; // Cambia esto por tu usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL
$dbname = "cole";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Revisar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = md5($password);

    $user_type = '';
    $redirect_page = '';

    if (strpos($username, '-alum') !== false) {
        $user_type = 'alum';
        $redirect_page = 'indexalum.php';
    } elseif (strpos($username, '-prof') !== false) {
        $user_type = 'prof';
        $redirect_page = 'indexprof.php';
    } elseif (strpos($username, '-admin') !== false) {
        $user_type = 'adm';
        $redirect_page = 'registros.php';
    }

    if ($user_type !== '') {
        $table = $user_type;
        $sql = "SELECT * FROM $table WHERE nickname='$username' AND contraseña='$hashed_password'";
        $result = $conn->query($sql);

        if ($result === false) {
            die("Error en la consulta: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $username;
            $_SESSION['nickname'] = $row['nickname'];
            $_SESSION['id'] = $row['id'];
            header("Location: $redirect_page");
            exit();
        } else {
            header("Location: index.php?error=Usuario o contraseña incorrectos");
            exit();
        }
    } else {
        header("Location: index.php?error=Usuario no existente");
        exit();
    }
}

$conn->close();
?>
