<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cole";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Contraseña a almacenar
$contraseña = "123"; // Cambia esto por la contraseña que desees
// Usar password_hash para hashear la contraseña
$hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

// Insertar el nuevo administrador en la tabla 'adm'
$sql = $conn->query("INSERT INTO adm (nombres, apellidos, nickname, correo, contraseña) 
                      VALUES ('Moshe', 'Mata', 'moshe-admin', 'moshe360@gmail.com', '$hashed_password')");

if ($sql === false) {
    die("Error en la consulta: " . $conn->error);
}

header('Location: index.php');
?>
