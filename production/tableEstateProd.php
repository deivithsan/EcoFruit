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
        <meta charset="UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js">
        </script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Estado de los Productos</title>
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
                                <h2>Estado de los Productos</h2>
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
                                $hccQuery5 = "SELECT * FROM public.estado ORDER BY codest";
                                $result5 = pg_query($cnx, $hccQuery5);
                                if($result5){
                                    if(pg_num_rows($result5)>0){
                                ?>
                                <table id="datatable-users" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Codigo Estado</th>
                                        <th>Nombre</th>
                                    </tr>
                                    </thead>
                                    <?php while ($row = pg_fetch_object($result5)) { ?>
                                    <tr>
                                        <td><?php echo $row->codest ?></td>
                                        <td><?php echo $row->nombrestado ?></td>
                                    </tr>
                                        <?php
                                    }
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
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
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>
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
        <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
        <script src="../vendors/jszip/dist/jszip.min.js"></script>
        <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>

        <!-- Datatables -->
        <script>
        $(document).ready(function() {
          var handleDataTableButtons = function() {
            if ($("#datatable-users").length) {
              $("#datatable-users").DataTable({
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
