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
    <title>Compras</title>
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
                                    <li><a href="form.php">Ingresar Información Usuario</a></li>
                                    <li><a href="form_validation.php">Ingresar Productos</a></li>
                                    <li><a href="formPriv.php">Ingresar Privilegios</a></li>
                                    <li><a href="adduser.php">Ingresar Usuarios</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-table"></i> Visualizar <span class="fa fa-chevron-down"></span></a>
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
                            <li><a><i class="fa fa-edit"></i> Modificar Datos<span class="fa fa-chevron-down"></span></a>
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
                            <h2>Modificar Una Compra Realizada</h2>
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
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Id de la compra <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="number" id="idbuy" name="idbuy" required="required" class="form-control col-md-7 col-xs-12">
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
                    $bus = "SELECT idcompra FROM public.compra";
                    $bu = pg_query($bus);
                    if ($_POST){
                    if ($_POST["buscar"]){
                    $idbuy = $_POST["idbuy"];
                    while($busq = pg_fetch_array($bu)){
                    if ($busq ["idcompra"] == $idbuy){
                    $llen = "SELECT * from public.compra where idcompra ='$idbuy' ";
                    $llenar = pg_query($llen);
                    if($llenar){
                    if(pg_num_rows($llenar)>0){
                    ?>
                    </center>
                </div>
            </div>
        </div>
        <thead>
        <tr>
            <th>Id Compra</th>
            <th>Id Producto</th>
            <th>Nombre Producto</th>
            <th>Estado</th>
            <th>Cantidad Disponible</th>
            <th>Costo Unidad</th>
            <th>Cantidad Comprada</th>
            <th>Número de Cedula</th>
            <th>Número de Telefono</th>
            <th>Vendedor del Producto</th>
            <th>Comprador del Producto</th>
            <th>Valoración de la Compra</th>
            <th>Detalle de la Valoración</th>
        </tr>
        </thead>
        <?php
        while ($row = pg_fetch_object($llenar)) {
            ?>
            <tr>
                <td><?php echo $row->idcompra ?></td>
                <td><?php echo $row->idprod ?></td>
                <td><?php echo $row->nombreprod ?></td>
                <td><?php echo $row->estado ?></td>
                <td><?php echo $row->cantdisp ?></td>
                <td><?php echo $row->costuni ?></td>
                <td><?php echo $row->cantbuy ?></td>
                <td><?php echo $row->numced ?></td>
                <td><?php echo $row->numcel ?></td>
                <td><?php echo $row->vendedorprod ?></td>
                <td><?php echo $row->comprador ?></td>
                <td><?php echo $row->valoracion ?></td>
                <td><?php echo $row->infoval ?></td>
            </tr>
            <?php
        }
        }
        }
        $llenarcas = "SELECT * from public.compra where idcompra ='$idbuy' ";
        $llen = pg_query($llenarcas);
        $z = pg_fetch_assoc($llen);
        }
        }
        }
        }else {
        $hccQuery = "SELECT * FROM public.compra ORDER BY idcompra";
        $result = pg_query($cnx, $hccQuery);
        if($result){
        if(pg_num_rows($result)>0){
        ?>
        </center>
    </div>
</div> </div>
<thead>
<tr>
    <th>Id Compra</th>
    <th>Id Producto</th>
    <th>Nombre Producto</th>
    <th>Estado</th>
    <th>Cantidad Disponible</th>
    <th>Costo Unidad</th>
    <th>Cantidad Comprada</th>
    <th>Número de Cedula</th>
    <th>Número de Telefono</th>
    <th>Vendedor del Producto</th>
    <th>Comprador del Producto</th>
    <th>Valoración de la Compra</th>
    <th>Detalle de la Valoración</th>
</tr>
</thead>
<tbody>
<?php while ($row = pg_fetch_object($result)) {
    ?>
    <tr>
        <td><?php echo $row->idcompra ?></td>
        <td><?php echo $row->idprod ?></td>
        <td><?php echo $row->nombreprod ?></td>
        <td><?php echo $row->estado ?></td>
        <td><?php echo $row->cantdisp ?></td>
        <td><?php echo $row->costuni ?></td>
        <td><?php echo $row->cantbuy ?></td>
        <td><?php echo $row->numced ?></td>
        <td><?php echo $row->numcel ?>
        <td><?php echo $row->vendedorprod ?></td>
        <td><?php echo $row->comprador ?></td>
        <td><?php echo $row->valoracion ?></td>
        <td><?php echo $row->infoval ?></td>
    </tr>
    <?php
}
}
}
}
?>
<form class="form-horizontal form-label-left input_mask" method="post">
    <center>
        <input type=button value="Nuevo" class="btn btn-success" onclick = "location='../bd.php'"/>
</form>
</tbody>
</table>
</div>
</div>
</div>
<?php
$valoraciones = "SELECT nombreval from public.valoraciones";
$listval = pg_query($valoraciones);
if ($_POST){
    if ($_POST["Enviar"]){
        $idcompraproducto =$_POST["idcompra"];
        $idproducto = $_POST["idprod"];
        $nomprod = $_POST["nomprod"];
        $cantidadisponible = $_POST["cantdisp"];
        $cantidadcomprada = $_POST["cantcomprada"];
        $numerocedula = $_POST["numcedula"];
        $numerotelefono = $_POST["numtelefono"];
        $infoval = $_POST["detval"];
        $val = $_POST["tiposlist"];
        $idv = "select idvaloracion from public.valoraciones WHERE nombreval = '$val'";
        $qidv = pg_query($idv);
        $valfetch = pg_fetch_array($qidv);
        $idvaloracion = $valfetch['idvaloracion'];
        $idval = (int) $idvaloracion;
        $idc = (int) $idcompraproducto;
        $idp = (int) $idproducto;
        $cantd = (int) $cantidadisponible;
        $cantc = (int) $cantidadcomprada;
        $numc = (int) $numerocedula;
        $numt = (int) $numerotelefono;
        $dat = 0;
        $result =pg_query($cnx, "UPDATE public.compra SET cantbuy=$cantc, valoracion=$idval, infoval='$infoval' where idcompra = $idc");
        echo"<script>alert('Registrio Actualizado Correctamente');
        window.location.href='modBuy.php';
        </script>";
    }
    if ($_POST["Eliminar"]){
        $idcompraproducto =$_POST["idcompra"];
        $idc = (int) $idcompraproducto;
        if ($idc == 0){
            echo"<script>alert('Busque primero la id de la compra a eliminar');                      
            window.location.href='modBuy.php';
            </script>";
        } else
            $borrar = pg_query($cnx, "delete from public.compra where idcompra=$idc");
        echo"<script>alert('Compra Eliminada Correctamente');
        window.location.href='modBuy.php';
        </script>";
    }
}
?>
<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
    <div class="form-group">
        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name" style="display:none">Id de Compra</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="number" id="idcompra" name="idcompra"  class="form-control col-md-7 col-xs-12" style="display:none" value="<?php echo $z['idcompra'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Id Producto <span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="number" id="idprod" DISABLED name="idprod"  class="form-control col-md-7 col-xs-12" value="<?php echo $z['idprod'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre Producto<span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="nomprod" name="nomprod" DISABLED class="form-control col-md-7 col-xs-12"  type="text" value="<?php echo $z['nombreprod'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad Disponible <span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="cantdisp" DISABLED class="date-picker form-control col-md-7 col-xs-12"  type="number" name="cantdisp" value="<?php echo $z['cantdisp'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad Comprada <span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="cantcomprada" class="date-picker form-control col-md-7 col-xs-12" required="required" type="number" name="cantcomprada" value="<?php echo $z['cantbuy'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Valoración de la Compra<span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="tiposlist">
                <?php
                while ( $tipos = pg_fetch_array($listval)){ ?>
                    <option value="<?php echo $tipos['nombreval'] ?>"><?php echo $tipos['nombreval']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Detalle de la Valoración<span class="required"></span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="detval" class="form-control" required="required" name="detval"><?php echo $z['infoval'] ?></textarea>
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <center>
                <input type="submit" class="btn btn-success" name="Enviar" id="Enviar" value="Guardar">
                <input type=button value="Ver Cambios" class="btn btn-success" onclick = "location='tableBuy.php'"/>
        </div>
    </div>
    <?php pg_close($cnx) ?>
</form>
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
<!-- bootstrap-wysiwyg -->
<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="../vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<!-- bootstrap-wysiwyg -->
<!-- Datatables -->
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
</body>
</html>
