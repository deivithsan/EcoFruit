<?php
require_once "../conexion.php";
$admin = new Admin();
$conex = new Conexion();
session_start();

if (isset($_SESSION['user'])){
    $priv = $_SESSION['privil'];
    $nom = $_SESSION['user'];
    if ($priv != 1) {
        session_unset();
        echo '<script> window.location="../index"; </script>';
    }
} else {
    echo '<script> window.location="../index"; </script>';
}
$nombreyapellido = $admin->get_NombreApellido();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ventas Por Vendedor</title>
    <link rel="shortcut icon" href="../img/icono.ico">
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <style type="text/css">
        #containerGraf {
            height: 400px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index" class="site_title"></i> <span>EcoFruit!</span></a>
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
                        <h2><?php echo $nombreyapellido; ?></h2>
                    </div>
                </div>
                <br />
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a href="index"><i class="fa fa-home"></i> Inicio </a>
                            </li>
                            <li><a><i class="fa fa-edit"></i> Formularios <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="form">Ingresar Información Usuario</a></li>
                                    <li><a href="form_validation">Ingresar Productos</a></li>
                                    <li><a href="formPriv">Ingresar Privilegios</a></li>
                                    <li><a href="adduser">Ingresar Usuarios</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-table"></i> Visualizar Tablas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="tableBuy"> Compras </a></li>
                                    <li><a href="tableInfoUsr"> Información de Usuarios </a></li>
                                    <li><a href="tableProDisp"> Productos </a></li>
                                    <li><a href="tableEstateProd"> Estado de los Productos </a></li>
                                    <li><a href="tableInfoPriv"> Privilegios </a></li>
                                    <li><a href="tableUsers"> Usuarios </a></li>
                                    <li><a href="tableTipeUsers"> Tipos de Usuarios </a></li>
                                    <li><a href="tableTiposProd"> Tipos de Productos </a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> Modificar Datos<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="modInfo">Información de Usuarios</a></li>
                                    <li><a href="modProd">Productos</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-money"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="tableMen"> Mensajes </a></li>
                                    <li><a href="modBuy">Compras</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-area-chart"></i> Estadisticas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="ventasGlobal"> Ventas </a></li>
                                    <li><a href="ventasVendedor"> Ventas Por Vendedor </a></li>
                                    <li><a href="estadisticasProd"> Productos </a></li>
                                </ul>
                            </li>
                    </div>
                </div>
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" a href="logout" data-placement="top" title="Salir">
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
                                    <img src="images/<?php echo "$nom" ?>.jpg"  alt=""><?php echo $nombreyapellido; ?>
                                <?php  } else { ?>
                                    <img src="images/user.jpg"  alt=""><?php echo $nombreyapellido; ?>
                                <?php  } ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <?php if($nom == 'dei'){?>
                                    <li><a href="../registro"><i class="fa fa-lock pull-right"></i> Nuevo Admin</a></li>
                                <?php } ?>
                                <li><a href="perfil"><i class="fa fa-street-view pull-right"></i> Perfil</a></li>
                                <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="right_col" role="main">
            <div class="">
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Ventas por Vendedor</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <form class="form-horizontal form-label-left input_mask" method="post">
                                <center>
                                    <label class="col-md-6 col-sm-6 col-xs-12"> Seleccione el Vendedor: </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="vendedoreslist">
                                            <?php
                                            $vendedores = $admin->get_Vendedores();
                                            $rows = count($vendedores);
                                            for ($i = 0; $i < $rows; $i++) {
                                                ?>
                                                <option value="<?php echo $vendedores[$i][0] ?>"><?php echo $vendedores[$i][0]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-sm-4 col-xs-12">
                                        <input type="submit" class="btn btn-success" style="display:inline" name="buscar" id="buscar" value="Buscar">
                                    </div>
                                </center>
                            </form>
                        </div>
                        <?php
                        if ($_POST) {
                            $user = $_POST["vendedoreslist"];
                            $año = date("Y");

                            $ventasEn= $admin->get_ventasEne($user);
                            $ventasFeb= $admin->get_ventasFeb($user);
                            $ventasMar= $admin->get_ventasMar($user);
                            $ventasAbr= $admin->get_ventasAbr($user);
                            $ventasMay= $admin->get_ventasMay($user);
                            $ventasJun= $admin->get_ventasJun($user);
                            $ventasJul= $admin->get_ventasJul($user);
                            $ventasAgo= $admin->get_ventasAgo($user);
                            $ventasSep= $admin->get_ventasSep($user);
                            $ventasOct= $admin->get_ventasOct($user);
                            $ventasNov= $admin->get_ventasNov($user);
                            $ventasDic= $admin->get_ventasDic($user);

                            $compras = $admin->get_ventasVendedor($user);
                            $rows = count($compras);
                            if ($rows == 0){
                                echo '<script>alert("El usuario '.$user.' no ha recibido ninguna compra, intente con otro usuario")</script>';
                                echo "<script type=\"text/javascript\">window.location='ventasVendedor'</script>";
                            }
                            echo "<center><h2>Vendedor: $user</h2></center>";
                            ?>
                            <div class="x_content">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id Compra</th>
                                        <th>Id del Producto Comprado</th>
                                        <th>Nombre Producto</th>
                                        <th>Estado del Producto</th>
                                        <th>Cantidad Disponible del Producto</th>
                                        <th>Costo Por Unidad ($)</th>
                                        <th>Cantidad Comprada (Kilos)</th>
                                        <th>Número de Celular Comprador</th>
                                        <th>Número de Cedula Comprador</th>
                                        <th>Comprador del Producto</th>
                                        <th>Valoración de la Compra</th>
                                        <th>Detalle de la Valoración</th>
                                        <th>Fecha de la Compra</th>
                                        <th>Hora de la Compra</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    for ($i = 0; $i < $rows; $i++) { ?>
                                        <tr>
                                            <td><?php echo $compras[$i][0] ?></td>
                                            <td><?php echo $compras[$i][1] ?></td>
                                            <td><?php echo $compras[$i][2] ?></td>
                                            <td><?php echo $compras[$i][3] ?></td>
                                            <td><?php echo number_format($compras[$i][4],0) ?></td>
                                            <td><?php echo number_format($compras[$i][5],0) ?></td>
                                            <td><?php echo number_format($compras[$i][6],0) ?></td>
                                            <td><?php echo $compras[$i][7] ?></td>
                                            <td><?php echo $compras[$i][8] ?></td>
                                            <td><?php echo $compras[$i][10] ?></td>
                                            <td><?php echo $compras[$i][11] ?></td>
                                            <td><?php echo $compras[$i][12] ?></td>
                                            <td><?php echo $compras[$i][13] ?></td>
                                            <td><?php echo $compras[$i][14] ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php  }  ?>
                    </div>
                    <?php
                    if ($_POST){
                    ?>
                    <div id="containerGraf" style="height: 400px"></div>
                        &nbsp;
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <footer>
            <div class="pull-right">
                <a href="../index">EcoFruit</a>
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
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
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
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- Graficos -->
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>
<script type="text/javascript">
    $(function () {
        $('#containerGraf').highcharts({
            chart: {
                type: 'column',
                margin: 75,
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 25,
                    depth: 70
                }
            },
            title: {
                text: 'Ventas Anuales de <?php echo $user; ?>'
            },
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            xAxis: {
                categories: Highcharts.getOptions().lang.shortMonths
            },
            yAxis: {
                title: {
                    text: null
                }
            },
            series: [{
                name: 'Ventas',
                data: [<?php echo $ventasEn; ?>, <?php echo $ventasFeb; ?>, <?php echo $ventasMar; ?>,
                    <?php echo $ventasAbr; ?>, <?php echo $ventasMay; ?>,<?php echo $ventasJun; ?>,
                    <?php echo $ventasJul; ?>, <?php echo $ventasAgo; ?>, <?php echo $ventasSep; ?>,
                    <?php echo $ventasOct; ?>, <?php echo $ventasNov; ?>, <?php echo $ventasDic; ?>]
            }]
        });
    });
</script>
<script>
    $(document).ready(function() {
        var handleDataTableButtons = function() {
            if ($("#datatable-buttons").length) {
                $("#datatable-buttons").DataTable({
                    dom: "Bfrtip",
                    buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm"
                        },
                        {
                            extend: "excel",
                            className: "btn-sm"
                        },
                        {
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },
                        {
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
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

        $('#datatable-keytable').DataTable({
            keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });

        $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
            'order': [[ 1, 'asc' ]],
            'columnDefs': [
                { orderable: false, targets: [0] }
            ]
        });
        $datatable.on('draw.dt', function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });
        });

        TableManageButtons.init();
    });

</script>
</body>
</html>