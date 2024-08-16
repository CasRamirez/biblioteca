<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
require 'conexion.php';

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PreuLand</title>

    <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <style>
        .nickname {
            color: orange;
            font-weight: bold;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="image/p.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8; width: 70px; height: 100px;">
                <span class="brand-text font-weight-light">REULAND</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <style>
                    .image .img-circle {
                        width: 80px;
                        height: 80px;
                    }
                    </style>
                    <div class="image">
                        <img src="image/auron.jpg" class="img-circle elevation-3" alt="User Image">
                        <span class="nickname"><?php echo htmlspecialchars($_SESSION['nickname']); ?></span>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Panel de Control
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="indexadmin.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tabla de Alumnos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="indexadminP.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tabla de Profesores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="registros.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Registrar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="delete_reg.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ver Eliminados</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="interfazcontra.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cambiar Contraseña</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="cerrar.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cerrar Sesion</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>PreuLand</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Estudiantes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <?php
                $id = $_GET['id'];

                $sql = $conn->query("SELECT * FROM libros WHERE id='$id'");

                if (!$sql) {
                    die("Error en la consulta SQL: " . $conn->error);
                }

                while($dat = $sql->fetch_object()){
                ?>
                <form action="edit.php?id=<?php echo $dat->id; ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">No. de Usuario</label>
                        <input type="text" class="form-control" name="id" value="<?php echo $dat->id; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre del cliente</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $dat->descripcion;?>" placeholder="Ingrese el nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellido del cliente</label>
                        <input type="text" class="form-control" name="apellido" value="<?php echo $dat->cantidad;?>" placeholder="Ingrese el apellido" required>
                    </div>
                  
            
        
                    <div class="mb-3">
                        <label class="form-label">Nickname del cliente</label>
                        <input type="text" class="form-control" name="nickname" value="<?php echo $dat->nickname;?>" placeholder="Ingrese el nickname" required>
                    </div>
                   
                    <div class="mb-3">
                    <label class="form-label">Correo del cliente</label>
                      <input type="email" class="form-control" name="correo"value="<?php echo $dat -> correo;?>" placeholder="Ingrese el correo" required>
      
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
                <?php } ?>
            </section>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="dist/js/adminlte.min.js?v=3.2.0"></script>
    <script src="dist/js/demo.js"></script>

    <script>
        $(function () {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        function updateGradoOptions() {
            var carreraSelect = document.getElementById('carrera');
            var gradoSelect = document.getElementById('grado');
            var selectedCarrera = carreraSelect.value;

            // Limpiar las opciones actuales del select de grado
            gradoSelect.innerHTML = '<option value="" disabled selected>Seleccione su grado</option>';

            // Definir las opciones de grado
            var gradosPrimaria = ['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto'];
            var gradosOtros = ['Primero', 'Segundo', 'Tercero'];

            var grados = selectedCarrera.toLowerCase() === 'primaria' ? gradosPrimaria : gradosOtros;

            // Agregar las nuevas opciones de grado
            for (var i = 0; i < grados.length; i++) {
                var option = document.createElement('option');
                option.value = grados[i];
                option.text = grados[i];
                gradoSelect.add(option);
            }
        }
    </script>
   
</body>

</html>
