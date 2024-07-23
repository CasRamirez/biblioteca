<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cole";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nickname = $_POST['nickname'] ?? '';

if (!empty($nickname)) {
    $sql = "SELECT id, nombres, apellidos, nickname, correo, contra as contraseña, usuario_tipo FROM alum WHERE nickname = ?
            UNION
            SELECT id, nombres, apellidos, nickname, correo, contraseña, usuario_tipo FROM prof WHERE nickname = ?
            UNION
            SELECT id, nombres, apellidos, nickname, correo, contraseña, usuario_tipo FROM adm WHERE nickname = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nickname, $nickname, $nickname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Este usuario no existe.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Por favor, ingrese un usuario.']);
}

$conn->close();

?>
