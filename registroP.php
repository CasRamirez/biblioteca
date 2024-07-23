<?php
// Conexión a la base de datos
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

// Función para verificar si el nickname ya existe
function nicknameExists($conn, $nickname, $table) {
    $sql = "SELECT COUNT(*) as count FROM $table WHERE nickname = '$nickname'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}

// Verificar el tipo de usuario (alumno o profesor)
if ($_POST['tipo'] == 'alumno') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $carrera = $_POST['carrera'];
    $grado = $_POST['grado'];
    $nickname = $_POST['nickname'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Verificar si el nickname ya existe en la tabla de alumnos
    if (nicknameExists($conn, $nickname, 'alum')) {
        header('Location: registros.php?error=Este usuario ya existe&tipo=alumno');
        exit();
    }

    // Encriptar la contraseña con MD5 (no recomendado)
    $hashed_password = md5($contraseña);
    
    // Insertar datos en la tabla de alumnos
    $sql = "INSERT INTO alum (nombres, apellidos, carrera, grado, nickname, correo, contraseña, FKGrado, FkCarrera, estado) 
            VALUES ('$nombre', '$apellido', '$carrera', '$grado', '$nickname', '$correo', '$hashed_password', '$grado', '$carrera','1')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php?success=Registro exitoso&tipo=alumno');
        exit();
    } else {
        header('Location: registros.php?error=Error al registrar&tipo=alumno');
        exit();
    }

} elseif ($_POST['tipo'] == 'docente') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $carrera = $_POST['carrera'];
    $materia = $_POST['materia'];
    $nickname = $_POST['nickname'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Verificar si el nickname ya existe en la tabla de profesores
    if (nicknameExists($conn, $nickname, 'prof')) {
        header('Location: registros.php?error=Este usuario ya existe&tipo=docente');
        exit();
    }

    // Encriptar la contraseña con MD5 (no recomendado)
    $hashed_password = md5($contraseña);

    // Insertar datos en la tabla de profesores
    $sql = "INSERT INTO prof (nombres, apellidos, carrera, materia, nickname, correo, contraseña,estado) 
            VALUES ('$nombre', '$apellido', '$carrera', '$materia', '$nickname', '$correo', '$hashed_password','1')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php?success=Registro exitoso&tipo=docente');
        exit();
    } else {
        header('Location: registros.php?error=Error al registrar&tipo=docente');
        exit();
    }
}

$conn->close();
?>