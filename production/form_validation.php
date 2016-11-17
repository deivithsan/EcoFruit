<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>InfoFruit!</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"></i> <span>InfoFruit!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/dei.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>Deivith Becerra</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.html"><i class="fa fa-home"></i> Inicio </a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Agregar <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.php">Información Usuario</a></li>
                      <li><a href="form_validation.php">Productos</a></li>
                      <li><a href="formPriv.php">Privilegios</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Visualizar <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tableUsers.php"> Usuarios </a></li>
                      <li><a href="tableInfoUsr.php"> Información de Usuarios </a></li>
                      <li><a href="tableProDisp.php"> Productos </a></li>
                      <li><a href="tableEstateProd.php"> Estado de los Productos </a></li>
                      <li><a href="tableInfoPriv.php"> Privilegios </a></li>
                      <li><a href="tableBuy.php"> Compras </a></li>
                      <li><a href="tableMen.php"> Mensajes </a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Modificar <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="modInfo.php">Información Usuario</a></li>
                      <li><a href="modProd.php">Productos</a></li>
                      <li><a href="modBuy.php">Compra</a></li>
                    </ul>
                  </li>

              </div>
              <div class="menu_section">
                <h3>Extras</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Paginas Adicionales <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="invoice.html">Información</a></li>
                      <li><a href="profile.html">Perfil</a></li>
                      <li><a href="contacts.html">Contactos</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" a href="../index.php" data-placement="top" title="Salir">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/dei.jpg" alt="">Deivith Becerra
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="profile.html"> Perfil</a></li>
                    <li>
                      <a href="javascript:;">
                        <span>Configuración</span>
                      </a>
                    </li>
                    <li><a href="../index.php"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ingresa Nuevos Productos a la Venta</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate method="post">


                      <span class="section">Productos</span>
                      <?php
                      include_once 'conex.php';
                      $cnx = pg_connect($strCnx) or die ("Error de Conexion. ".pg_last_error());

                      $desp = "SELECT nombrestado FROM public.estado";
                      $lis = pg_query($desp);

                      if ($_POST){
                      $nomprod = $_POST["nomprod"];
                      $tipoprod = $_POST["tip"];
                      $cantidad = $_POST["cant"];
                      $costoprod = $_POST["costo"];
                      $ventaprod = $_POST["venta"];
                      $estado = $_POST["estadolist"];
                      $cant = (int) $cantidad;
                      $cost = (int) $costoprod;
                      $venta = (int) $ventaprod;

                        $result =pg_query($cnx, "INSERT INTO public.productos (nombre, tipo, estado, cantidad, costo, venta) VALUES('$nomprod','$tipoprod', '$estado', '$cant','$cost','$venta');");
                        echo"<script>alert('Registrio Agregado Correctamente')</script>";
                      }
                      ?>

                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Nombre<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nomprod" name="nomprod" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Tipo de Producto<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="tip" name="tip" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Estado<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="estadolist">

                          <?php
                          while ( $lisdesp = pg_fetch_array($lis)){
                           ?>
                              <option value="<?php echo $lisdesp['nombrestado'] ?>"><?php echo $lisdesp['nombrestado']; ?></option>

                          <?php
                        }
                           ?>
                           </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Cantidad <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="cant" name="cant" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Costo ($) <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="costo" name="costo" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                      </div>
                      <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Venta ($) <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="venta" name="venta" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <input type="submit" class="btn btn-success" value="Agregar">
                          <button onclick='limpiar()' class="btn btn-success">Limpiar</button>
                          <input type=button value="Ver Datos" class="btn btn-success" onclick = "location='tableProDisp.php'"/>
                          </div>
                        </div>
                        <?php
                        pg_close($cnx)
                        ?>
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
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <a href="../index.php">InfoFruit</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
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
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>


  </body>
</html>
