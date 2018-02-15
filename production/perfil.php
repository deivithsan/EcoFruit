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
    <title>Perfil</title>
    <link rel="shortcut icon" href="../img/icono.ico">
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
                            <a href="index.html" class="site_title"></i> <span>EcoFruit!</span></a>
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
                                        <h2>Perfil del Usuario</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                            <div class="profile_img">
                                                <div id="crop-avatar">
                                                    <!-- Current avatar -->
                                                    <?php  if ($existe == true) { ?>
                                                        <img src="images/<?php echo "$nom" ?>.jpg"  alt="Avatar" class="img-responsive avatar-view">
                                                    <?php  } else { ?>
                                                        <img src="images/user.jpg"  alt="Avatar" class="img-responsive avatar-view"><h3>
                                                    <?php  } ?>
                                                </div>
                                            </div>
                                            <h3><?php echo $nombreyapellido; ?></h3>

                                            <?php
                                            $nombre = $conex->get_Nombre();
                                            $apellido = $conex->get_Apellido();
                                            $correo = $conex->get_Correo();
                                            $telefono = $conex->get_Tel();
                                            $dir = $conex->get_Dir();
                                            $numCC = $conex->get_NumCC();
                                            ?>

                                            <ul class="list-unstyled user_data">
                                                <li>
                                                    Administrador de Ecofruit
                                                </li>
                                                <li>
                                                    <i class="fa fa-envelope user-profile-icon"></i> <?php echo $correo;?>
                                                </li>
                                                <li>
                                                    <i class="fa fa-phone user-profile-icon"></i> <?php echo $telefono;?>
                                                </li>
                                                <li>
                                                    <i class="fa fa-home user-profile-icon"></i> <?php echo $dir;?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-12">


                                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Modificar Información</a>
                                                    </li>
                                                </ul>
                                                <div id="myTabContent" class="tab-content">
                                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                                        <!-- start recent activity -->
                                                        <div class="x_content">
                                                            <br />
                                                            <?php
                                                            if ($_POST){
                                                                $admin->update_AdminInfo();
                                                            }
                                                            ?>
                                                            <form class="form-horizontal form-label-left" method="post">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nombre <span class="required"></span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="nombreusuario" name="nombreusuario" required="required" class="form-control col-md-7 col-xs-12" style="display:none"  value="<?php echo $nom; ?>">
                                                                        <input type="text" id="nombre" name="nombre" required class="form-control col-md-7 col-xs-12" value="<?php echo $nombre; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos<span class="required"></span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="apellidos" name="apellidos" required class="form-control col-md-7 col-xs-12" value="<?php echo $apellido; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo <span class="required"></span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="email" name="email" required class="form-control col-md-7 col-xs-12" value="<?php echo $correo;?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefono <span class="required"></span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="number" id="tel" name="tel" required class="form-control col-md-7 col-xs-12" value="<?php echo $telefono;?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección <span class="required"></span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="dir" name="dir" required class="form-control col-md-7 col-xs-12" value="<?php echo $dir;?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de Cedula <span class="required"></span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="number" id="numcc" name="numcc" required class="form-control col-md-7 col-xs-12" value="<?php echo $numCC;?>">
                                                                    </div>
                                                                </div>
                                                                <div class="ln_solid"></div>
                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                        <center>
                                                                            <input type="submit" class="btn btn-success" name="Enviar" id="Enviar" value="Guardar">
                                                                            <button onclick='limpiar()' class="btn btn-success">Limpiar</button>
                                                                    </div>
                                                                </div>
                                                                <script language=javascript>
                                                                    function limpiar(){
                                                                        document.getElementById('nombre').value = "";
                                                                        document.getElementById('apellidos').value = "";
                                                                        document.getElementById('email').value = "";
                                                                        document.getElementById('tel').value = "";
                                                                        document.getElementById('dir').value = "";
                                                                        document.getElementById('numcc').value = "";
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
                <!-- validator -->
                <script src="../vendors/validator/validator.js"></script>
                <!-- Custom Theme Scripts -->
                <script src="../build/js/custom.min.js"></script>
    </body>
</html>
