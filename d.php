<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cole";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$pass = md5("123");
$sql = $conn->query("INSERT INTO adm (nombres, apellidos,nickname ,correo,contraseña)Values 
 ('Moshe', 'Mata', 'moshe-admin', 'moshemata360@gmail.com', '$pass')");

header('Location: index.php');

?>
