<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
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
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <!-- Estilo CSS para el color naranja -->
    <style>
        .nickname {
            color: orange;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- Navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="image/p.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 70px; height: 100px;">
            <span class="brand-text font-weight-light">REULAND</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
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
            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->

    <!-- alerta -->

    <!-- Modal -->
    <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reasonModalLabel">Razón de la eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reasonForm">
                        <div class="form-group">
                            <label for="reason">Razón:</label>
                            <input type="text" class="form-control" id="reason" required>
                        </div>
                        <input type="hidden" id="recordId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="submitReason">Enviar</button>
                </div>
            </div>
        </div>
    </div>

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
                            <li class="breadcrumb-item active">Estudiantes y Profesores</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Razón</th>
                                <th scope="col">Eliminado por</th>
                                <th scope="col" class="text-center">Activar</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
    include "conexion.php";
    $sql = $conn->query("
    
    SELECT id, nombre, apellido,nickname, razon, user_delete 
    FROM cliente 
    WHERE estado = 0
      UNION ALL                
    SELECT id, nombre, apellido, nickname, razon, user_delete 
    FROM empleado 
    WHERE estado = 0
");

    $contador = 1;
    while ($row = $sql->fetch_assoc()) {
        echo "<tr>";
        echo "<th scope='row'>" . $contador . "</th>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nickname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['razon']) . "</td>";
        echo "<td>" . htmlspecialchars($row['user_delete']) . "</td>";
        echo "<td class='text-center'><a href='activar.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-small btn-info'><i class='fas fa-plus'></i></a></td>";
        echo "</tr>";
        
        $contador++;
    }
    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2024 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js?v=3.2.0"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    // Script for handling the reason modal
    $('#example1').on('click', '.btn-delete', function () {
        var recordId = $(this).data('id');
        $('#recordId').val(recordId);
        $('#reasonModal').modal('show');
    });

    $('#submitReason').on('click', function () {
        var reason = $('#reason').val();
        var recordId = $('#recordId').val();
        if (reason.trim() === '') {
            alert('Por favor ingrese una razón.');
            return;
        }
        $.post('update_reason.php', { id: recordId, reason: reason }, function (response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Error al actualizar la razón.');
            }
        }, 'json');
    });
</script>
</body>

</html>
