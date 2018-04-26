<?php
require('connect.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
    <title>
        USO Inteligente - Agregar proyecto
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/material-dashboard.css?v=2.0.0">

</head>

<body class="">
    <div class="wrapper">
        <div class="sidebar" data-color="orange" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">

          <center>
                  <img src="images/SC logo chico.png" border="0" width="50%">
          </center>


            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                  <li clas"">
                        <center>
                            Manejo de cuenta
                        </center>

                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="proyectos.php">
                            <i class="material-icons">book</i>
                            <p>Proyectos</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <i class="material-icons">note_add</i>
                            <p>Añadido de Proyectos</p>
                        </a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="borrado.php">
                            <i class="material-icons">delete</i>
                            <p>Borrado de proyectos</p>
                        </a>
                    </li>-->

                </ul>
            </div>
        </div>
        <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand">Crear Proyectos</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form class="navbar-form">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Buscar...">
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </form>
                    <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">notifications</i>
                                <span class="notification">5</span>
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Verificar proyecto iStudy</a>
                                <a class="dropdown-item" href="#">3 proyectos cambiaron su estado a completado</a>
                                <a class="dropdown-item" href="#">Se canceló HackMx</a>
                                <a class="dropdown-item" href="#">El proyecto está a punto de agotar su presupuesto</a>

                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
              <?php
              if(isset($_POST['submit']))
              {
                $nombre=$_POST['nombreInput'];
                $diagnostico=$_POST['diagnosticoInput'];
                $presupuesto=$_POST['presupuestoInput'];
                $categoria=$_POST['categoriaInput'];
                $objetivo=$_POST['objetivoInput'];
                $introduccion=$_POST['introduccionInput'];
                $estado = $_POST['estadoProyectoInput'];
                $maxID = $connection->query("SELECT MAX(ID) AS ID FROM PROYECTOS")->fetch_assoc();
                $IDProyecto=$maxID['ID']+1;
                $proyectoQuery = $connection->prepare('INSERT INTO PROYECTOS(ID, NOMBRE, DIAGNOSTICO, PRESUPUESTO, OBJETIVO, INTRODUCCION) VALUES(?,?,?,?,?,?)');
                $proyectoQuery->bind_param('isssss',$IDProyecto,$nombre,$diagnostico,$presupuesto,$objetivo,$introduccion);
                if($proyectoQuery->execute())
                {
                  if($connection->query("SELECT * FROM CATEGORIAS WHERE ID = ".$categoria)->num_rows != 0)
                  {
                    $categoriaProyectoQuery = $connection->prepare('INSERT INTO CATEGORIA_PROYECTO(PROYECTO, CATEGORIA) VALUES (?,?)');
                    $categoriaProyectoQuery->bind_param('ii',$IDProyecto,$categoria);
                    $categoriaProyectoQuery->execute();

                  }
                  $estadoQuery = $connection->prepare("INSERT INTO ESTADO_PROYECTOS(PROYECTO,ESTADO) VALUES(?,?)");
                  $estadoQuery->bind_param('is',$IDProyecto,$estado);
                  $estadoQuery->execute();
                  $nota ="Proyecto creado";
                  $queryAddNota = $connection->prepare('INSERT INTO NOTAS_PROYECTOS(USUARIO,PROYECTO, NOTA) VALUES(1,?,?)');
                  $queryAddNota->bind_param('is',$IDProyecto,$nota);
                  $queryAddNota->execute();
                  ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                      </button>
                      <span>
                          <b> ÉXITO - </b> Proyecto agregado</span>
                  </div>
                  <?php

                }
                else
                {
                  ?>
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                      </button>
                      <span>
                          <b> ERROR - </b> Algo salió mal al intentar iniciar el proyecto</span>
                  </div>
                  <?php
                }


              }
              ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-warning">
                                <h4 class="card-title">Añadir un proyecto</h4>
                                <p class="card-category">En la siguiente sección podrás añadir un nuevo proyecto a la base de datos</p>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Nombre</label>
                                                <input type="text" name="nombreInput" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Presupuesto</label>
                                                <input type="number" name="presupuestoInput" required step="0.01" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">

                                            <select class="form-control" name="categoriaInput" required>
                                              <option disabled selected value="0">Seleccionar categoría</option>
                                            <?php
                                            $queryCategorias = $connection->query('SELECT * FROM CATEGORIAS');
                                            $array =array();
                                            if($queryCategorias->num_rows!=0)
                                            {
                                              while($filaCategorias= $queryCategorias->fetch_assoc())
                                              {
                                                ?>
                                                <option value="<?php echo $filaCategorias['ID']; ?>">
                                                <?php echo $filaCategorias['NOMBRE']; ?></option>
                                                <?php
                                              }
                                            }
                                            ?>
                                            </select>
                                            </div>
                                        </div></div>
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Objetivo del proyecto</label>
                                                <input type="text" required name="objetivoInput" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Introducción</label>
                                                <input type="text" name="introduccionInput" required class="form-control">
                                            </div>
                                        </div></div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Diagnóstico</label>
                                                <input type="text" name="diagnosticoInput" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Estado</label>
                                            <select class="form-control" name="estadoProyectoInput" id="estadoProyectoInput">
                                              <option selected value="EPC">En Proceso</option>
                                              <option value="COM">Completado</option>
                                              <option value="CAN">Cancelado</option>
                                            </select></div></div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-warning pull-right">Crear proyecto</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


      </div>
  </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/bootstrap-material-design.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!-- Library for adding dinamically elements -->
<script src="assets/js/plugins/arrive.min.js" type="text/javascript"></script>
<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Material Dashboard Core initialisations of plugins and Bootstrap Material Design Library -->
<script src="assets/js/material-dashboard.js?v=2.0.0"></script>

</html>
