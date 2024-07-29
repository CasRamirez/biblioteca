<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cole";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_POST['tipo'] == 'alumno') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $carrera = $_POST['carrera'];
    $grado = $_POST['grado'];
    $nickname = $_POST['nickname'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $secret_key = "clave89111";
    $hashed_password = hash('sha256', $secret_key . $contraseña);

    // Insertar el nuevo alumno en la tabla 'alum'
    $sql = "INSERT INTO alum (nombres, apellidos, carrera, grado, nickname, correo, contraseña, estado, FKGrado, FkCarrera) 
            VALUES ('$nombre', '$apellido', '$carrera', '$grado', '$nickname', '$correo', '$hashed_password', 1, '$grado', '$carrera')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el ID del nuevo alumno
        $id_alum = $conn->insert_id;

        // Obtener todos los IDs de los cursos
        $sql_cursos = "SELECT id FROM cursos";
        $result_cursos = $conn->query($sql_cursos);

        if ($result_cursos->num_rows > 0) {
            while ($row_curso = $result_cursos->fetch_assoc()) {
                $id_curso = $row_curso['id'];

                // Insertar un registro en la tabla 'notas' para cada curso
                $sql_notas = "INSERT INTO notas (id_alum, carrera, id_curso, nota) 
                              VALUES ('$id_alum', '$carrera', '$id_curso', 0)";
                $conn->query($sql_notas);
            }
        }

        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} elseif ($_POST['tipo'] == 'docente') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $carrera = $_POST['carrera'];
    $materia = $_POST['materia'];
    $grado = $_POST['grado'];
    $nickname = $_POST['nickname'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $secret_key = "clave89111";
    $hashed_password = hash('sha256', $secret_key . $contraseña);

    // Incluir el campo 'estado' con el valor por defecto 1
    $sql = "INSERT INTO prof (nombres, apellidos, carrera, materia, grado, nickname, correo, contraseña, estado) 
            VALUES ('$nombre', '$apellido', '$carrera', '$materia', '$grado', '$nickname', '$correo', '$hashed_password', 1)";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php?success=Registro exitoso');
        exit();
    } else {
        header('Location: index.php?error=Error al registrar');
        exit();
    }
}

$conn->close();
?>
