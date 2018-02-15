<?php
    session_start();
    require_once "../conexion.php";
    $admin = new Admin();
    $conex = new Conexion();
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
    $nombreyapellido = $admin->get_NombreApellido();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EcoFruit!</title>
    <link rel="shortcut icon" href="../img/icono.ico">
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
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
                        <h2><?php echo $nombreyapellido; ?></h2>
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
                            <li><a><i class="fa fa-table"></i>Visualizar<span class="fa fa-chevron-down"></span></a>
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
                    <a data-toggle="tooltip" a href="logout.php" data-placement="top" title="Salir" ">
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
                                    <li><a href="../registro.php"><i class="fa fa-lock pull-right"></i> Nuevo Admin</a></li>
                                <?php } ?>
                                <li><a href="perfil.php"><i class="fa fa-street-view pull-right"></i> Perfil</a></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="right_col" role="main">
            <div class="row tile_count">
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <?php
                    $compradores = $conex->get_Compradores();
                    ?>
                    <span class="count_top"><i class="fa fa-users"></i>  Compradores</span>
                    <div class="count green"><?php echo $compradores;?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <?php
                    $vendedores = $conex->get_Vendedores();
                    ?>
                    <span class="count_top"><i class="fa fa-users"></i> Vendedores</span>
                    <div class="count"><?php echo $vendedores;?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <?php
                    $compras = $conex->get_Compras();
                    ?>
                    <span class="count_top"><i class="fa fa-trophy"></i> Compras Concretadas</span>
                    <div class="count green"><?php echo $compras;?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <?php
                    $frutas = $conex->get_Frutas();
                    ?>
                    <span class="count_top"><i class="fa fa-shopping-cart"></i> Frutas disponibles</span>
                    <div class="count"><?php echo $frutas;?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="dashboard_graph">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <h2>Clima</h2>
                                    <div id="cont_e688f203390b5ceff3d284c0c6d0032e"><script type="text/javascript" async src="https://www.tiempo.com/wid_loader/e688f203390b5ceff3d284c0c6d0032e"></script></div>
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

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="js/moment/moment.min.js"></script>
    <script src="js/datepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    </body>
</html>
