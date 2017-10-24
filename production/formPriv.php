<?php
session_start();
include 'conex.php';
$cnx = pg_connect($strCnx) or die (print "Error de conexion. ");
if (isset($_SESSION['user'])){
    $priv = $_SESSION['privil'];
    $nom = $_SESSION['user'];
    if ($priv != 1) {
        session_unset();
        echo '<script> window.location="../index.php"; </script>';
    }
} else {
    echo '<script> window.location="../index.php"; </script>';
}
$sql = "SELECT nombre,apellido FROM public.infousuarios WHERE nombreuser='$nom'";
$busqueda=pg_query($sql);
$row = pg_fetch_array($busqueda);
$nombre = $row["nombre"];
$apellido = $row["apellido"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Ingresar Privilegios</title>

      <!-- Bootstrap -->
      <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <!-- NProgress -->
      <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
      <!-- iCheck -->
      <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
      <!-- bootstrap-wysiwyg -->
      <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
      <!-- Select2 -->
      <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
      <!-- Switchery -->
      <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
      <!-- starrr -->
      <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
      <!-- Custom Theme Style -->
      <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
      <div class="container body">
          <div class="main_container">
              <div class="col-md-3 left_col">
                  <div class="left_col scroll-view">
                      <div class="navbar nav_title" style="border: 0;">
                          <a href="index.php" class="site_title"></i> <span>EcoFruit!</span></a>
                      </div>
                      <div class="clearfix"></div>
                      <div class="profile">
                          <div class="profile_pic">
                              <img src="images/<?php echo "$nom" ?>.jpg" alt="..." class="img-circle profile_img">
                          </div>
                          <div class="profile_info">
                              <span>Bienvenido,</span>
                              <h2><?php echo "$nombre $apellido" ?></h2>
                          </div>
                      </div>
                      <br />
                      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                          <div class="menu_section">
                              <h3>General</h3>
                              <ul class="nav side-menu">
                                  <li><a href="index.php"><i class="fa fa-home"></i> Inicio </a>
                                  </li>
                                  <li><a><i class="fa fa-edit"></i> Formularios <span class="fa fa-chevron-down"></span></a>
                                      <ul class="nav child_menu">
                                          <li><a href="form.php">Ingresar Información Usuario</a></li>
                                          <li><a href="form_validation.php">Ingresar Productos</a></li>
                                          <li><a href="formPriv.php">Ingresar Privilegios</a></li>
                                          <li><a href="adduser.php">Ingresar Usuarios</a></li>
                                      </ul>
                                  </li>
                                  <li><a><i class="fa fa-table"></i> Visualizar Tablas <span class="fa fa-chevron-down"></span></a>
                                      <ul class="nav child_menu">
                                          <li><a href="tableBuy.php"> Compras </a></li>
                                          <li><a href="tableInfoUsr.php"> Información de Usuarios </a></li>
                                          <li><a href="tableProDisp.php"> Productos </a></li>
                                          <li><a href="tableEstateProd.php"> Estado de los Productos </a></li>
                                          <li><a href="tableMen.php"> Mensajes </a></li>
                                          <li><a href="tableInfoPriv.php"> Privilegios </a></li>
                                          <li><a href="tableUsers.php"> Usuarios </a></li>
                                          <li><a href="tableTipeUsers.php"> Tipos de Usuarios </a></li>
                                          <li><a href="tableTiposProd.php"> Tipos de Productos </a></li>
                                      </ul>
                                  </li>
                                  <li><a><i class="fa fa-edit"></i> Modificar Datos <span class="fa fa-chevron-down"></span></a>
                                      <ul class="nav child_menu">
                                          <li><a href="modInfo.php">Información de Usuarios</a></li>
                                          <li><a href="modProd.php">Productos</a></li>
                                      </ul>
                                  </li>
                                  <li><a><i class="fa fa-money"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                                      <ul class="nav child_menu">
                                          <li><a href="tableMen.php"> Mensajes </a></li>
                                          <li><a href="modBuy.php">Compras</a></li>
                                      </ul>
                                  </li>
                          </div>
                      </div>
                      <div class="sidebar-footer hidden-small">
                          <a data-toggle="tooltip" a href="logout.php" data-placement="top" title="Salir">
                              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                          </a>
                      </div>
                  </div>
              </div>
              <div class="top_nav">
                  <div class="nav_menu">
                      <nav>
                          <div class="nav toggle">
                              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                          </div>
                          <ul class="nav navbar-nav navbar-right">
                              <li class="">
                                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      <img src="images/<?php echo "$nom" ?>.jpg" alt=""><?php echo "$nombre $apellido" ?>
                                      <span class=" fa fa-angle-down"></span>
                                  </a>
                                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                                      <li><a href="profile.html"> Perfil</a></li>
                                      <li>
                                          <a href="javascript:;">
                                              <span>Configuración</span>
                                          </a>
                                      </li>
                                      <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                                  </ul>
                              </li>
                          </ul>
                      </nav>
                  </div>
              </div>

              <div class="right_col" role="main">
                  <div class="">
                      <div class="page-title">
                          <div class="title_left">
                          </div>
                          <div class="title_right">
                              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                  <div class="input-group">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="x_panel">
                                  <div class="x_title">
                                      <h2>Creación del Privilegio</h2>
                                      <ul class="nav navbar-right panel_toolbox">
                                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                          </li>
                                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                                          </li>
                                      </ul>
                                      <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                      <?php
                                      include_once 'conex.php';
                                      $cnx = pg_connect($strCnx) or die ("Error de Conexion. ".pg_last_error());
                                      if ($_POST){
                                          if ($_POST["Enviar2"]){
                                              $nompriv = $_POST["nombrepriv"];
                                              $numeroprivilegio = $_POST["numpriv"];
                                              $numpriv = (int) $numeroprivilegio;
                                              $num = 0;
                                              $validar3 = "SELECT privil from public.privilegio";
                                              $busqueda3 =pg_query($validar3);
                                              while($comparar3 = pg_fetch_array($busqueda3)){
                                                  if ($comparar3 ["privil"] == $numpriv){
                                                      echo"<script>alert('Ese Numero de Privilegio ya esta Asignado. ')</script>";
                                                      $num = 1;
                                                      break;
                                                  }else{
                                                      $num = 0;
                                                  }
                                              }
                                              if ($num == 0){
                                                  $result3 =pg_query($cnx, "INSERT INTO public.Privilegio (nombre, privil) VALUES('$nompriv', '$numpriv');");
                                                  echo"<script>alert('Registrio Agregado Correctamente')</script>";
                                              }
                                          }
                                      }
                                      ?>
                                      <form class="form-horizontal form-label-left input_mask" method="post">
                                          <div class="form-group">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nombre del Privilegio <span class="required"></span>
                                              </label>
                                              <div class="col-md-6 col-sm-6 col-xs-12">
                                                  <input type="text" id="nombrepriv" name="nombrepriv" required="required" class="form-control col-md-7 col-xs-12">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Numero de Privilegio <span class="required"></span>
                                              </label>
                                              <div class="col-md-6 col-sm-6 col-xs-12">
                                                  <input type="number" id="numpriv" name="numpriv" required="required" class="form-control col-md-7 col-xs-12">
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"></div>
                                          <div class="form-group">
                                              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                  <input type="submit" class="btn btn-success" name="Enviar2" id="Enviar2" value="Agregar">
                                                  <button onclick='limpiar3()' class="btn btn-success">Limpiar</button>
                                                  <input type=button value="Ver Datos" class="btn btn-success" onclick = "location='tableInfoPriv.php'"/>
                                              </div>
                                          </div>
                                          <?php pg_close($cnx) ?>
                                          <script language=javascript>
                                              function limpiar3(){
                                                  document.getElementById('nombrepriv').value = "";
                                                  document.getElementById('numpriv').value = "";
                                              }
                                          </script>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <footer>
              <div class="pull-right">
                  <a href="../index.php">EcoFruit</a>
              </div>
              <div class="clearfix"></div>
          </footer>
      </div>
  </div>
      <!-- jQuery -->
      <script src="../vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="../vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="../vendors/nprogress/nprogress.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- iCheck -->
      <script src="../vendors/iCheck/icheck.min.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="js/moment/moment.min.js"></script>
      <script src="js/datepicker/daterangepicker.js"></script>
      <!-- bootstrap-wysiwyg -->
      <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
      <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
      <script src="../vendors/google-code-prettify/src/prettify.js"></script>
      <!-- jQuery Tags Input -->
      <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
      <!-- Switchery -->
      <script src="../vendors/switchery/dist/switchery.min.js"></script>
      <!-- Select2 -->
      <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
      <!-- Parsley -->
      <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
      <!-- Autosize -->
      <script src="../vendors/autosize/dist/autosize.min.js"></script>
      <!-- jQuery autocomplete -->
      <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
      <!-- starrr -->
      <script src="../vendors/starrr/dist/starrr.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="../build/js/custom.min.js"></script>
  </body>
</html>