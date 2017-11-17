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
                        <div class="clearfix">
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
                                                <li><a href="formPriv.php">Ingresar Privilegio</a></li>
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
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" a href="logout.php" data-placement="top" title="Salir">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
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
                </div>
                <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Ingresa Nuevos Usuarios</h2>
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
                                        include_once 'conex.php';
                                        $cnx = pg_connect($strCnx) or die ("Error de Conexion. ".pg_last_error());
                                        $tipoprod = "select nombretipousuario, privilegio from public.tipousuarios where privilegio != 1";
                                        $listip = pg_query($tipoprod);
                                        if ($_POST){
                                            $nomus2 = $_POST["nombreusuario2"];
                                            $pass = $_POST["contraseña"];
                                            $tipoprod = $_POST["tiposlist"];
                                            $tp = "select idtipousuario from public.tipousuarios where nombretipousuario = '$tipoprod'";
                                            $qtp = pg_query($tp);
                                            $atp = pg_fetch_array($qtp);
                                            $idtipouser = $atp["idtipousuario"];
                                            $encripass = md5($pass);
                                            $val = 0;
                                            $validar2 = "SELECT nombreuser from public.usuarios";
                                            $busqueda2 =pg_query($validar2);
                                            while ($comparar2 = pg_fetch_array($busqueda2)){
                                                if ($comparar2 ["nombreuser"] == $nomus2){
                                                    echo "<script>alert('El nombre de usuario ya existe')</script>";
                                                    $val = 1;
                                                    break;
                                                }else {
                                                    $val = 0;
                                                }
                                            }
                                            if ($val == 0) {
                                                $resublt2 =pg_query($cnx, "INSERT INTO public.usuarios (nombreuser, contraseña, privilegio, tipousuario) VALUES('$nomus2', '$encripass', 2,$idtipouser);");
                                                echo"<script>alert('Usuario Agregado Correctamente')</script>";
                                            }
                                        }
                                        ?>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Nombre de usuario<span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="nombreusuario2" name="nombreusuario2" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Contraseña<span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="password" id="contraseña" name="contraseña" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Tipo de Usuario<span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="tiposlist">
                                                    <?php
                                                    while ( $tipos = pg_fetch_array($listip)){
                                                        ?>
                                                        <option value="<?php echo $tipos['nombretipousuario'] ?>"><?php echo $tipos['nombretipousuario']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"></div>
                                            <div class="form-group">
                                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                    <input type="submit" class="btn btn-success">
                                                    <button onclick='limpiar3()' class="btn btn-success">Limpiar</button>
                                                </div>
                                            </div>
                                            <?php pg_close($cnx) ?>
                                        <script language=javascript>
                                            function limpiar3(){
                                                document.getElementById('nomprod').value = "";
                                                document.getElementById('tip').value = "";
                                                document.getElementById('cant').value = "";
                                                document.getElementById('costo').value = "";
                                                document.getElementById('venta').value = "";
                                                document.getElementById('ubicacion').value = "";
                                            }
                                        </script>
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
        </div>
    </body>
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
</html>
