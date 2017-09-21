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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EcoFruit!</title>

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
              <a href="index.php" class="site_title"></i> <span>EcoFruit!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/<?php echo "$nom" ?>.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php echo "$nombre $apellido" ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Inicio </a>
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
                  <li><a><i class="fa fa-edit"></i> Modificar Datos<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="modInfo.php">Información de Usuarios</a></li>
                      <li><a href="modProd.php">Productos</a></li>
                      <li><a href="modBuy.php">Compras</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-money"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="tableMen.php"> Mensajes </a></li>
                    <li><a href="modProd.php">Productos</a></li>
                    <li><a href="modBuy.php">Compras</a></li>
                    </ul>
                  </li>  
              </div>
              <div class="menu_section">
                <h3>Extras</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Paginas Adicionales <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="invoice.php">Información</a></li>
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
              <a data-toggle="tooltip" a href="logout.php" data-placement="top" title="Salir">
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
                    <h2>Modifica Los Productos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table id="datatable-buttons" class="table table-striped table-bordered"><div class="form-group">
                      <form class="form-horizontal form-label-left input_mask" method="post">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Id del Producto a Modificar <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="idprod" name="idprod" required="required" class="form-control col-md-7 col-xs-12">
                          <center>
                          <input type="submit" class="btn btn-success" style="display:inline" name="buscar" id="buscar" value="Buscar">
                      </form>

                      </center>
                      </div>
                      </div>
                    </div>
                    <?php
                      include_once 'conex.php';
                      $cnx = pg_connect($strCnx) or die ("Error de Conexion. ".pg_last_error());
                      $bus = "SELECT idprod FROM public.productos";
                      $bu = pg_query($bus);
                      $desp = "SELECT nombrestado FROM public.estado";
                      $lis = pg_query($desp);
                      if ($_POST){
                        $idproducto = $_POST["idprod"];
                        $idprod = (int) $idproducto;
                      if ($_POST["buscar"]){

                            while($busq = pg_fetch_array($bu)){
                                if ($busq ["idprod"] == $idprod){
                                  $llen = "SELECT * from public.productos where idprod =$idprod ";
                                  $result2 = pg_query($llen);
                                  if($result2){
                                    if(pg_num_rows($result2)>0){
                                      ?>
                                    </center>
                                  </div>
                                  </div>
                                </div>
                                <thead>
                                  <tr>
                                    <th>Id Producto</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Estado Actual</th>
                                    <th>Cantidad</th>
                                    <th>Costo Producto</th>
                                    <th>Costo Venta</th>
                                    <th>Ubicación</th>  
                                  </tr>
                                </thead>

                                  <?php while ($row = pg_fetch_object($result2)) {
                                  ?>
                                  <tr>
                                    <td><?php echo $row->idprod ?></td>
                                    <td><?php echo $row->nombre ?></td>
                                    <td><?php echo $row->tipo ?></td>
                                    <td><?php echo $row->estado ?></td>
                                    <td><?php echo $row->cantidad ?></td>
                                    <td><?php echo $row->costo ?></td>
                                    <td><?php echo $row->venta ?></td>
                                    <td><?php echo $row->ubicacion ?></td>
                                  </tr>

                                    <?php
                          }
                       }
                     }
                     $llenarcas = "SELECT * from public.productos where idprod = '$idprod' ";
                               $llen = pg_query($llenarcas);
                               $z = pg_fetch_assoc($llen);
                   }
                 }
               }
               }else {
                 $hccQuery2 = "SELECT * FROM public.productos ORDER BY idprod";
                 $result2 = pg_query($cnx, $hccQuery2);

                 if($result2){
                   if(pg_num_rows($result2)>0){
                     ?>
                   </center>
                    </div>
                    </div>
                  </div>
                   <thead>
                     <tr>
                       <th>Id Producto</th>
                       <th>Nombre</th>
                       <th>Tipo</th>
                       <th>Estado Actual</th>
                       <th>Cantidad</th>
                       <th>Costo Producto</th>
                       <th>Costo Venta</th>
                       <th>Ubicación</th>  
                     </tr>
                   </thead>
                   <tbody>
                     <?php while ($row = pg_fetch_object($result2)) {
                     ?>
                     <tr>
                       <td><?php echo $row->idprod ?></td>
                       <td><?php echo $row->nombre ?></td>
                       <td><?php echo $row->tipo ?></td>
                       <td><?php echo $row->estado ?></td>
                       <td><?php echo $row->cantidad ?></td>
                       <td><?php echo $row->costo ?></td>
                       <td><?php echo $row->venta ?></td>
                       <td><?php echo $row->ubicacion ?></td>  
                     </tr>
                     <?php
                   }
                 }
               }
             }

                     ?>
                     <form class="form-horizontal form-label-left input_mask" method="post">
                       <center>
                         <input type=button value="Nuevo" class="btn btn-success" onclick = "location='form_validation.php'"/>
                     </form>
                   </tbody>
                 </table>
               </div>
             </div>
           </div>
                <?php
                      if ($_POST){
                      if ($_POST["Enviar"]){
                      $idedelproducto = $_POST["idproduc"];
                      $idpro = (int) $idedelproducto;
                      $nomprod = $_POST["nomprod"];
                      $tipoprod = $_POST["tip"];
                      $cantidad = $_POST["cant"];
                      $costoprod = $_POST["costo"];
                      $ventaprod = $_POST["venta"];
                      $estado = $_POST["estadolist"];
                      $cant = (int) $cantidad;
                      $cost = (int) $costoprod;
                      $venta = (int) $ventaprod;
                      $ubicacion = $_POST["ubicacion"];

                        $result =pg_query($cnx, "UPDATE public.productos SET nombre = '$nomprod', tipo='$tipoprod', estado='$estado', cantidad=$cant, costo=$cost, venta=$venta, ubicacion=$ubicacion where idprod =$idpro");
                        echo"<script>alert('Registrio Actualizado Correctamente')</script>";
                      }
                    }
                      ?>
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name" style="display:none">Id del Producto<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="idproduc" name="idproduc" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $z['idprod'] ?>" style="display:none">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Nombre<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nomprod" name="nomprod" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $z['nombre'] ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Tipo de Producto<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="tip" name="tip" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $z['tipo'] ?>">
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
                          <input type="number" id="cant" name="cant" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $z['cantidad'] ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Costo <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="costo" name="costo" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $z['costo'] ?>">
                      </div>
                      </div>
                      <div class="item form-group">    
                      <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Venta <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="venta" name="venta" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $z['venta'] ?>">
                      </div>
                      </div>                      
                      <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name" style="display:none">Ubicacion<span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="number" id="ubicacion" name="ubicacion" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $z['idprod'] ?>" style="display:none">
                      </div>
                      </div> 
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <center>
                          <input type="submit" class="btn btn-success" name="Enviar" id="Enviar" value="Guardar">
                          <input type=button value="Ver Cambios" class="btn btn-success" onclick = "location='tableProDisp.php'"/>
                        </center>
                          </div>
                        </div>
                        <?php
                        pg_close($cnx)
                        ?>
                    </form>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <a href="index.php">EcoFruit</a>
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
    <script src="../vendors/datatables.net/js/jquery.dataTables.minNS.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>



    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });


        TableManageButtons.init();
      });



    </script>
    <!-- /Datatables -->

  </body>
</html>
