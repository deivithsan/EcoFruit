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
    <title>Modificar Información de Usuarios</title>
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
                        <?php
                        $dir = "images/$nom.jpg";
                        $existe = file_exists($dir);
                        if ($existe == true){  ?>
                            <img src="images/<?php echo "$nom" ?>.jpg" alt="..." class="img-circle profile_img">
                        <?php  } else {  ?>
                            <img src="images/user.jpg" alt="..." class="img-circle profile_img">
                        <?php  }  ?>
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
                                    <li><a href="form_validation.php">Ingresar Productos</a></li>
                                    <li><a href="formPriv.php">Ingresar Privilegios</a></li>
                                    <li><a href="adduser.php">Ingresar Usuarios</a></li>
                                    <li><a href="form.php">Ingresar Información Usuario</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-table"></i> Visualizar Tablas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="tableBuy.php"> Compras </a></li>
                                    <li><a href="tableInfoUsr.php"> Información de Usuarios </a></li>
                                    <li><a href="tableProDisp.php"> Productos </a></li>
                                    <li><a href="tableEstateProd.php"> Estado de los Productos </a></li>
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
                                <?php  if ($existe == true) { ?>
                                    <img src="images/<?php echo "$nom" ?>.jpg"  alt=""><?php echo "$nombre $apellido" ?>
                                <?php  } else { ?>
                                    <img src="images/user.jpg"  alt=""><?php echo "$nombre $apellido" ?>
                                <?php  } ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
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
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Modificar Información de los Usuarios</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <div class="form-group">
                                    <form class="form-horizontal form-label-left input_mask" method="post">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Usuario a Modificar <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-1">
                                            <input type="text" id="nombreusuario" name="nombreusuario" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre de Usuario">
                                            <center>
                                                <input type="submit" class="btn btn-success" style="display:inline" name="buscar" id="buscar" value="Buscar">
                                            </center>
                                        </div>
                                    </form>
                                </div>
                        </div>
                        <?php
                        include_once 'conex.php';
                        $cnx = pg_connect($strCnx) or die ("Error de Conexion. ".pg_last_error());
                        $bus = "SELECT nombreuser FROM public.infousuarios";
                        $bu = pg_query($bus);
                        if ($_POST){
                            if ($_POST["buscar"]){
                                $nomus = $_POST["nombreusuario"];
                                while($busq = pg_fetch_array($bu)){
                                    if ($busq ["nombreuser"] == $nomus){
                                    $llen = "SELECT * from public.infousuarios where nombreuser ='$nomus' ";
                                    $llenar = pg_query($llen);
                                        if($llenar){
                                            if(pg_num_rows($llenar)>0){
                                                ?>
                                    </div>
                </div>
            </div>
            <thead>
            <tr>
                <th>Id Usuario</th>
                <th>Nombre de Usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Dirección</th>
                <th>Número de Cedula</th>
            </tr>
            </thead>
            <?php
            while ($row = pg_fetch_object($llenar)) {
                ?>
                <tr>
                    <td><?php echo $row->iduser ?></td>
                    <td><?php echo $row->nombreuser ?></td>
                    <td><?php echo $row->nombre ?></td>
                    <td><?php echo $row->apellido ?></td>
                    <td><?php echo $row->correo ?></td>
                    <td><?php echo $row->telefono ?></td>
                    <td><?php echo $row->direccion ?></td>
                    <td><?php echo $row->cedula ?></td>
                </tr>
                <?php
            }
            }
            }
            $llenarcas = "SELECT * from public.infousuarios where nombreuser ='$nomus' ";
            $llen = pg_query($llenarcas);
            $z = pg_fetch_assoc($llen);
            }
            }
            }
            }else {
            $hccQuery = "SELECT * FROM public.infousuarios ORDER BY iduser";
            $result = pg_query($cnx, $hccQuery);
            if($result){
            if(pg_num_rows($result)>0){
            ?>
        </div>
    </div>
</div>
<thead>
<tr>
    <th>Id Usuario</th>
    <th>Nombre de Usuario</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Correo</th>
    <th>Telefono</th>
    <th>Dirección</th>
    <th>Número de Cedula</th>
</tr>
</thead>
<tbody>
<?php while ($row = pg_fetch_object($result)) {
    ?>
    <tr>
        <td><?php echo $row->iduser ?></td>
        <td><?php echo $row->nombreuser ?></td>
        <td><?php echo $row->nombre ?></td>
        <td><?php echo $row->apellido ?></td>
        <td><?php echo $row->correo ?></td>
        <td><?php echo $row->telefono ?></td>
        <td><?php echo $row->direccion ?></td>
        <td><?php echo $row->cedula ?></td>
    </tr>
    <?php
}
            }
}
                        }
?>
<form class="form-horizontal form-label-left input_mask" method="post">
    <center>
        <input type=button value="Nuevo" class="btn btn-success" onclick = "location='form.php'"/>
</form>
</tbody>
</table>
<?php
if ($_POST){
    if ($_POST["Enviar"]){
        $nameuser =$_POST["nomuser"];
        $name = $_POST["nombre"];
        $apell = $_POST["apellido"];
        $email = $_POST["correo"];
        $numerotel = $_POST["telefono"];
        $dir = $_POST["direccion"];
        $cedul = $_POST["cedula"];
        $tel = (int) $numerotel;
        $ced = (int) $cedul;
        $dat = 0;
        $result =pg_query($cnx, "UPDATE public.infousuarios SET nombre ='$name',apellido = '$apell', correo='$email', telefono=$tel, direccion='$dir', cedula=$ced where nombreuser = '$nameuser'");
        echo"<script>alert('Registrio Actualizado Correctamente')</script>";
    }
}
?>
<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
    <div class="form-group">
        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name" style="display:none">Nombre</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nomuser" name="nomuser"  class="form-control col-md-7 col-xs-12" style="display:none" value="<?php echo $z['nombreuser'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nombre <span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $z['nombre'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Apellido<span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="apellido" name="apellido" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $z['apellido'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo <span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="correo" class="form-control col-md-7 col-xs-12" required="required" type="text" name="correo" value="<?php echo $z['correo'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefono <span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="telefono" class="date-picker form-control col-md-7 col-xs-12" required="required" type="number" name="telefono" value="<?php echo $z['telefono'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección <span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="direccion" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" name="direccion" value="<?php echo $z['direccion'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Cedula <span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="cedula" class="date-picker form-control col-md-7 col-xs-12" required="required" type="number" name="cedula" value="<?php echo $z['cedula'] ?>">
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <center>
                <input type="submit" class="btn btn-success" name="Enviar" id="Enviar" value="Guardar">
                <input type=button value="Ver Cambios" class="btn btn-success" onclick = "location='tableInfoUsr.php'"/>
        </div>
    </div>
    <?php pg_close($cnx)?>
</form>
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
