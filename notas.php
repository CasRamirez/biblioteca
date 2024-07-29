<?php
session_start();
include "conexion.php"; 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$iduser=$_SESSION['id']
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
    <style>
    .image .img-circle {
        width: 80px;
        height: 80px;
    }

    .nickname {
        color: purple;
        font-weight: bold;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">

    <!-- Site wrapper -->
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="image/p.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8; width: 70px; height: 100px;">
                <span class="brand-text font-weight-light">REULAND</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="image/vege.jpg" class="img-circle elevation-3" alt="User Image">
                        <span class="nickname">
                            <?php echo htmlspecialchars($_SESSION['nickname']); ?>
                        </span>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar"><i class="fas fa-search fa-fw"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
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
                                    <a href="indexalum.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cursos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="notas.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Notas</p>
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
                                        <p>Cerrar Sesión</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
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
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            
            <?php
            
$sqlsearch = $conn->query("SELECT am.carrera,
ca.nombre
 FROM  alum am
INNER JOIN carrera ca ON am.id = ca.id
 WHERE am.id = $iduser ");

if ($sqlsearch->num_rows > 0) {
    $resultado = $sqlsearch->fetch_assoc();
    $carreraalum = $resultado['nombre'];
    echo "<h1> Alumno de " . htmlspecialchars($carreraalum) . "</h1>";
} else {
    echo "No se encontraron resultados.";
}

             ?>
            <section class="content">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th scope="col">id</th>
                                


                                    <th scope="col">Curso</th>
                                    <th scope="col">Notas</th>
                                    <th scope="col">Imprimir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    include "conexion.php";
                 
                    $sql = $conn->query("SELECT ns.id_alum, ns.nota,cs.nombre,cs.id
FROM notas ns
INNER JOIN cursos cs ON ns.id_curso = cs.id
 WHERE ns.id_alum =  $iduser");

                    while ($dat = $sql->fetch_object()) {
                    ?>
                                <tr>
                                    <td><?php echo isset($dat->id) ? $dat->id : 'N/A'; ?></td>

                                    <td><?php echo isset($dat->nombre) ? $dat->nombre    : 'N/A'; ?></td>
                                    <td><?php echo isset($dat->nota) ? $dat->nota : 'N/A'; ?></td>
                                    <td><a href="imprimir.php?id=<?php echo $dat->id; ?>" target="_blank" class="btn btn-small btn-info"><i class="fas fa-print"></i></a></td>
                                </tr>
                                <?php
                    }
                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section><!-- /.content -->


            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Versión</b> 1.0.0
                </div>
                <strong>6to Computación &copy; 2024 <a href="https://adminlte.io">Oscar y Samuel</a>.</strong>Preuland.
            </footer>
        </div><!-- ./wrapper -->

        <!-- Scripts -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="plugins/jszip/jszip.min.js"></script>
        <script src="plugins/pdfmake/pdfmake.min.js"></script>
        <script src="plugins/pdfmake/vfs_fonts.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="dist/js/adminlte.min.js?v=3.2.0"></script>
        <script src="dist/js/demo.js"></script>

        <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        </script>
</body>

</html>