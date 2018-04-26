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
        USO Inteligente - Proyectos
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
                    <li class="nav-item active">
                        <a class="nav-link" href="proyectos.php">
                            <i class="material-icons">book</i>
                            <p>Proyectos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nuevo.php">
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
                        <a class="navbar-brand" href="#">Proyectos</a>
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
                    <div class="row">

<?php
$queryProyectosAll = $connection->query('SELECT * FROM ResumenProyectos');
if($queryProyectosAll->num_rows!=0)
{
?>
                        <div class="col-md-12">
                          <form method="post" action="proyecto.php">
                            <div class="card">
                                <div class="card-header card-header-warning">
                                    <h4 class="card-title">Listado de proyectos</h4>
                                    <p class="card-category">Proyectos</p>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-warning">
                                            <th>Clave</th>
                                            <th>Nombre</th>
                                            <th>Categorías</th>
                                            <th>Presupuesto</th>
                                            <th>Estado</th>
                                        </thead>
                                        <tbody>
                                          <?php
                                          while($filaProyectosAll = $queryProyectosAll->fetch_assoc())
                                          {
                                          ?>
                                            <tr>
                                                <td><?php echo $filaProyectosAll['ID']; ?></td>
                                                <td><?php echo $filaProyectosAll['PROYECTO']; ?></td>
                                                <td><?php
                                                  $categoriaProyectoQuery = $connection->query('SELECT CATEGORIAS.NOMBRE FROM CATEGORIA_PROYECTO INNER JOIN CATEGORIAS ON CATEGORIA_PROYECTO.CATEGORIA = CATEGORIAS.ID WHERE CATEGORIA_PROYECTO.PROYECTO = '.$filaProyectosAll['ID']);
                                                  if($categoriaProyectoQuery->num_rows!=0)
                                                  {
                                                    while($filaCategoriaProyecto = $categoriaProyectoQuery->fetch_assoc())
                                                    {
                                                      echo $filaCategoriaProyecto['NOMBRE'];
                                                      echo "<br/>";
                                                    }
                                                  }
                                                  else
                                                  {
                                                    echo "SIN CATEGORIA";
                                                  }
                                                 ?></td>
                                                <td><?php echo $filaProyectosAll['FONDOS']; ?></td>
                                                <td><?php switch($filaProyectosAll['ESTADO'])
                                                {
                                                  case 'EPC':
                                                  echo "En proceso";
                                                  break;
                                                  case 'COM':
                                                  echo "Completado";
                                                  break;
                                                  case 'CAN':
                                                  echo "Cancelado";
                                                  break;


                                                } ?></td>
                                                <td>
                                                  <button type="submit" name = "submit" value="<?php echo $filaProyectosAll['ID']; ?>" rel="tooltip" title="Ver proyecto" class="btn btn-warning btn-link btn-sm">
                                                      <i class="material-icons">visibility</i>
                                                  </button>
                                                </td>
                                            </tr>


                        <?php
                        }
                        ?>
                      </tbody>
                  </table>
              </div>
          </div>
        </form>
      </div>
                        <?php
                      }
                        ?>
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
