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

// Obtener el valor del nickname desde el formulario
$nickname = $_POST['nickname'];

// Consultar en las tablas 'alum', 'prof', 'adm'
$sql = "SELECT id, nombres, apellidos, NULL as grado, carrera, nickname, correo, contra, contraseña, 'alumno' as usuario_tipo FROM alum WHERE nickname = ? 
        UNION 
        SELECT id, nombres, apellidos, NULL as grado, carrera, nickname, correo, contra, contraseña, 'profesor' as usuario_tipo FROM prof WHERE nickname = ? 
        UNION 
        SELECT id, nombres, apellidos, NULL as grado, NULL as carrera, nickname, correo, contra, contraseña, 'administrador' as usuario_tipo FROM adm WHERE nickname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nickname, $nickname, $nickname);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Usuario encontrado, enviar respuesta JSON con los datos del usuario
    $user = $result->fetch_assoc();
    $errorMessage = array(
        'success' => true,
        'user' => $user
    );
    echo json_encode($errorMessage);
} else {
    // Usuario no encontrado, enviar respuesta JSON con error
    $errorMessage = array(
        'success' => false,
        'error' => 'Usuario no encontrado'
    );
    echo json_encode($errorMessage);
}

$stmt->close();
$conn->close();
?>
