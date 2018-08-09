<?php
    require_once "../conexion.php";
    $admin = new Admin();
    $conex = new Conexion();
    session_start();

    if (isset($_SESSION['user'])){
        $priv = $_SESSION['privil'];
        $nom = $_SESSION['user'];
        $iduser = $_SESSION["iduser"];
        if ($priv != 1) {
            session_unset();
            echo '<script> window.location="../index"; </script>';
        }
    } else {
        echo '<script> window.location="../index"; </script>';
    }
    $nombreyapellido = $admin->get_NombreApellido();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ingresar Productos Principales</title>
    <link rel="shortcut icon" href="../img/icono.ico">

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
                                        <li><a href="createProdP">Ingresar Productos Principales</a></li>
                                        <li><a href="createProdV">Ingresar Productos a la Venta</a></li>
                                        <li><a href="adduser">Ingresar Usuarios</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-table"></i> Visualizar Tablas <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="tableBuy"> Compras </a></li>
                                        <li><a href="tableInfoUsr"> Información de Usuarios </a></li>
                                        <li><a href="tableProDisp"> Productos a la Venta </a></li>
                                        <li><a href="tableProPrin"> Productos Principales </a></li>
                                        <li><a href="tableEstateProd"> Estado de los Productos </a></li>
                                        <li><a href="tableTipeUsers"> Tipos de Usuarios </a></li>
                                        <li><a href="tableTiposProd"> Tipos de Productos </a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> Modificar Datos <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="modInfo">Información de Usuarios</a></li>
                                        <li><a href="modProd">Productos a la Venta</a></li>
                                        <li><a href="modProdPrin">Productos Principales</a></li>
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
                                        <li><a href="estadisticasComp"> Compradores </a></li>
                                    </ul>
                                </li>
                        </div>
                    </div>
                    <div class="sidebar-footer hidden-small">
                        &nbsp;
                        <img src="images/ECOFRUIT.png" height="35px" width="40px">
                        &nbsp;
                        <img src="images/DATMA.png" height="35px" width="40px">

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
                                <h2>Ingresa Nuevos Productos Principales</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" method="post">
                                    <?php
                                    $tipoProd = $admin->get_TipoProducto();
                                    if ($_POST){
                                        $admin->add_ProdPrin();
                                        $info = "Creación de Producto Principal";
                                        $admin->create_log($iduser,$info, $i = null);
                                    }
                                    ?>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Nombre<span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="nomProd" name="nomProd" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Tipo de Producto<span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="tipoProd">
                                                <?php for ($i=0; $i<sizeof($tipoProd); $i++){?>
                                                    <option value="<?php echo $tipoProd[$i]["idtipo"] ?>"><?php echo $tipoProd[$i]["nombretipo"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <center>
                                                <input type="submit" class="btn btn-success" value="Guardar">
                                                <input type=button value="Ver Productos Principales" class="btn btn-success" onclick = "location='tableProPrin'"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
