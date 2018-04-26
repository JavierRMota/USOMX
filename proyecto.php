<?php
if(isset($_POST['submit']))
{
  require('connect.php');
  $IDProyecto= $_POST['submit'];
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
        USO Inteligente - Proyecto
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
                        <a class="navbar-brand" href="#">Resumen de proyecto</a>
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
if(isset($_POST['editarSubmit']))
{
  $estado= $_POST['estadoProyectoInput'];
  $presupuesto = $_POST['presupuestoProyectoInput'];
  $diagnostico = $_POST['diagnosticoProyectoInput'];
  $queryProyecto = $connection->query('SELECT * FROM PROYECTOS WHERE ID = '.$IDProyecto);
  if($queryProyecto->num_rows!=0)
  {
    $filaProyecto = $queryProyecto->fetch_assoc();
    if($filaProyecto['DIAGNOSTICO']!=$diagnostico || $filaProyecto['PRESUPUESTO']!= $presupuesto)
    {
      $modificacionQuery = $connection->prepare('UPDATE PROYECTOS SET DIAGNOSTICO = ?, PRESUPUESTO = ? WHERE ID = '.$IDProyecto);
      $modificacionQuery->bind_param('ss',$diagnostico,$presupuesto);
      $modificacionQuery->execute();
    }
  }
  $estadoActualQuery = $connection->query("SELECT * FROM ESTADO_PROYECTOS WHERE PROYECTO = ".$IDProyecto." ORDER BY FECHA DESC LIMIT 1");
  if($estadoActualQuery->num_rows!=0)
  {
    $filaEstadoActual = $estadoActualQuery->fetch_assoc();
    if($estado != $filaEstadoActual['ESTADO'])
    {
      $estadoQuery = $connection->prepare("INSERT INTO ESTADO_PROYECTOS(PROYECTO,ESTADO) VALUES(?,?)");
      $estadoQuery->bind_param('is',$IDProyecto,$estado);
      $estadoQuery->execute();
    }
  }
  else
  {
    $estadoQuery = $connection->prepare("INSERT INTO ESTADO_PROYECTOS(PROYECTO,ESTADO) VALUES(?,?)");
    $estadoQuery->bind_param('is',$IDProyecto,$estado);
    $estadoQuery->execute();
  }

}
$queryProyecto = $connection->query('SELECT * FROM PROYECTOS WHERE ID = '.$IDProyecto);
if($queryProyecto->num_rows!=0)
{
  $filaProyecto = $queryProyecto->fetch_assoc();
?>
<div class="row">
<div class="col-md-8">
    <div class="card">
        <div class="card-header card-header-warning">
            <h4 class="card-title">Vista del proyecto</h4>
            <p class="card-category">Editar o cambiar los datos</p>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="row">
                  <input hidden name="submit" value="<?php echo $IDProyecto;?>">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Estado</label>
                            <select class="form-control" name="estadoProyectoInput" id="estadoProyectoInput">
                              <option selected disabled value="">SELECCIONAR ESTADO</option>
                              <option value="EPC">En Proceso</option>
                              <option value="COM">Completado</option>
                              <option value="CAN">Cancelado</option>
                            </select>
                            <?php
                            $estadoActualQuery = $connection->query("SELECT * FROM ESTADO_PROYECTOS WHERE PROYECTO = ".$IDProyecto." ORDER BY FECHA DESC LIMIT 1");
                            if($estadoActualQuery->num_rows!=0)
                            {
                              $filaEstadoActual = $estadoActualQuery->fetch_assoc();
                              ?>
                              <script>
                              document.getElementById('estadoProyectoInput').value='<?php echo $filaEstadoActual['ESTADO']; ?>';
                              </script>
                              <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Presupuesto</label>
                            <input name="presupuestoProyectoInput" type="number" step="0.01" value="<?php echo $filaProyecto['PRESUPUESTO']; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Diagnóstico</label>
                            <div class="form-group">
                                <textarea name="diagnosticoProyectoInput" class="form-control" rows="5"><?php echo $filaProyecto['DIAGNOSTICO']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="editarSubmit" class="btn btn-warning pull-right">Editar proyecto</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card card-profile">
        <div class="card-body">
            <h6 class="card-category text-gray"><?php echo $filaProyecto['OBJETIVO']; ?></h6>
            <h2 class="card-title"><?php echo $filaProyecto['NOMBRE']; ?></h2>
            <p class="card-description">
                <?php echo $filaProyecto['INTRODUCCION']; ?>
            </p>
        </div>
    </div>
</div>
</div>
<div class="row">
  <?php
  if(isset($_POST['addNoteSubmit']) && isset($_POST['notaInput']))
  {
    $nota = $_POST['notaInput'];
    $queryAddNota = $connection->prepare('INSERT INTO NOTAS_PROYECTOS(USUARIO,PROYECTO, NOTA) VALUES(1,?,?)');
    $queryAddNota->bind_param('is',$IDProyecto,$nota);
    if(!$queryAddNota->execute())
    {
      ?>
      <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="material-icons">close</i>
          </button>
          <span>
              <b> ERROR - </b> Algo salió mal al intentar ingresar la nota</span>
      </div>

      <?php
    }

  }
  $queryNotasProyecto = $connection->query('SELECT * FROM NOTAS_PROYECTOS WHERE PROYECTO = '.$IDProyecto.' ORDER BY FECHA DESC');
  if($queryNotasProyecto->num_rows!=0)
  {
  ?>
                          <div class="col-lg-6 col-md-12">
                              <div class="card">
                                  <div class="card-header card-header-primary">
                                      <h4 class="card-title">Notas</h4>
                                      <p class="card-category">Histórico de notas</p>
                                  </div>
                                  <div class="card-body table-responsive">
                                      <table class="table table-hover">
                                          <thead class="text-primary">
                                              <th>Fecha</th>
                                              <th>Nota</th>

                                          </thead>
                                          <tbody>
                                            <?php
                                            while($filaNotasProyecto = $queryNotasProyecto->fetch_assoc())
                                            {
                                            ?>
                                              <tr>
                                                  <td><?php echo $filaNotasProyecto['FECHA']; ?></td>
                                                  <td><?php echo $filaNotasProyecto['NOTA']; ?></td>

                                              </tr>


                          <?php
                          }
                          ?>
                        </tbody>
                    </table>
                    <form method="post">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label>Nueva nota</label>
                                  <div class="form-group">
                                      <textarea class="form-control" name="notaInput" required rows="2"></textarea>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <input hidden name="submit" value="<?php echo $IDProyecto;?>">
                      <button type="submit" name="addNoteSubmit" class="btn btn-primary pull-right">Añadir nota</button>
                    </form>

                </div>
            </div>
        </div>
                          <?php
                        }
                          ?>
                          <?php
                          $estadoProyectoQuery = $connection->query("SELECT * FROM ESTADO_PROYECTOS WHERE PROYECTO = ".$IDProyecto.' ORDER BY FECHA DESC');
                          if($estadoProyectoQuery->num_rows!=0)
                          {
                            ?>
                            <div class="col-lg-6 col-md-12">
                              <div class="card">
                                  <div class="card-header card-header-success">
                                      <h4 class="card-title">Estado del proyecto</h4>
                                      <p class="card-category">Información histórica</p>
                                  </div>
                                  <div class="card-body table-responsive">
                                      <table class="table table-hover">
                                          <thead class="text-success">
                                              <th>Fecha</th>
                                              <th>Estado</th>
                                          </thead>
                                          <tbody>
                                          <?php

                                                      while($filaEstados = $estadoProyectoQuery->fetch_assoc()){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $filaEstados['FECHA']; ?></td>
                                                            <td><?php switch($filaEstados['ESTADO'])
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
                                                          </tr>
                                                        <?php

                                                      }
                                          ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                            </div>
                            <?php

                          }
                          ?>
</div>
                        <?php
                      }
                      else
                      {


                        ?>
                        <div class="col-lg-6 col-md-12"><h1> Algo salió mal y no pudimos encontrar el proyecto</h1></div>
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
<?php
}
else
{
  ?>
  <script>
  window.location.href = "proyectos.php";
  </script>
  <?php
}
?>
