<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cole";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el valor de la nueva contraseña, nickname y tipo de usuario desde el formulario
$contraseña = $_POST['contraseña'];
$nickname = $_POST['nickname'];
$tipoUsuario = $_POST['tipoUsuario'];

// Encriptar la contraseña usando SHA-256 con una clave secreta
$secret_key = "clave89111";
$hashed_password = hash('sha256', $secret_key . $contraseña);

if ($tipoUsuario === 'alumno') {
    $sql = "UPDATE alum SET contraseña = ? WHERE nickname = ?";
} elseif ($tipoUsuario === 'profesor') {
    $sql = "UPDATE prof SET contraseña = ? WHERE nickname = ?";
} elseif ($tipoUsuario === 'administrador') {
    $sql = "UPDATE adm SET contraseña = ? WHERE nickname = ?";
} else {
    $response = array(
        'success' => false,
        'message' => 'Tipo de usuario no válido.'
    );
    echo json_encode($response);
    exit;
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $hashed_password, $nickname);

if ($stmt->execute()) {
    $response = array(
        'success' => true,
        'message' => 'Contraseña actualizada correctamente.'
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'Error al actualizar la contraseña.'
    );
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
