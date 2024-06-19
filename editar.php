<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>6to Compu</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PREU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Bambi</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
  

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Opciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Listar.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="registro.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registrar</p>
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
            <h1>Registro de Alumnos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Principal</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Registro</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <?php
    include "conexion.php";
    $id = $id=$_GET['id'];
    $sql = $conn ->query("SELECT * FROM alum WHERE id='$id'");
    while($dat=$sql->fetch_object()){
?>
   <form action="edit.php?id=<?php echo $dat->id; ?>" method="post">
    <div class="mb-3">
        <label class="form-label">No. de Usuario</label>
        <input type="text" class="form-control" name="id" value="<?php echo $dat->id; ?>" disabled ></div>
      <div class="mb-3">
        <label class="form-label">Nombre del alumno</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $dat -> nombres;?>" placeholder="Ingrese el nombre" required >
      </div>

      <div class="mb-3">
        <label class="form-label">Apellido del Alumno</label>
        <input type="text" class="form-control" name="apellido"value="<?php echo $dat -> apellidos;?>" placeholder="Ingrese el apellido" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Grado del Alumno</label>
        <input type="text" class="form-control" name="grado"value="<?php echo $dat -> grado;?>" placeholder="Ingrese el grado" required>
      
      </div>
      <div class="mb-3">
        <label class="form-label">Carrera del Alumno</label>
        <input type="text" class="form-control" name="carrera"value="<?php echo $dat -> carrera;?>" placeholder="Ingrese la carrera" required>
      
      </div>
      <div class="mb-3">
        <label class="form-label">Nickname del Alumno</label>
        <input type="text" class="form-control" name="nickname"value="<?php echo $dat -> nickname;?>" placeholder="Ingrese el nickname" required>
      
      </div>
      <div class="mb-3">
        <label class="form-label">Correo del Alumno</label>
        <input type="email" class="form-control" name="correo"value="<?php echo $dat -> correo;?>" placeholder="Ingrese el correo" required>
      
      </div>
      <div class="mb-3">
        <label class="form-label">Nota</label>
        <input type="number" class="form-control" name="nota"value="<?php echo $dat -> notas;?>" placeholder="Ingrese la nota" required>
      
      </div>
      <?php
    }
      ?>
      <button type="submit-" class="btn btn-outline-dark">Registrar</button>
   </form>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>6to Computación &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
