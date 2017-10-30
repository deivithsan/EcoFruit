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

    <title>Ingresar Productos</title>

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
                                <li><a><i class="fa fa-table"></i> Visualizar Tablas <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="tableBuy.php"> Compras </a></li>
                                        <li><a href="tableInfoUsr.php"> Información de Usuarios </a></li>
                                        <li><a href="tableProDisp.php"> Productos </a></li>
                                        <li><a href="tableEstateProd.php"> Estado de los Productos </a></li>
                                        <li><a href="tableMen.php"> Mensajes </a></li>
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
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Ingresa Nuevos Productos Para Vender</h2>
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
                                    $desp = "SELECT nombrestado FROM public.estado";
                                    $lis = pg_query($desp);
                                    $usrVend = "SELECT nombreuser from public.usuarios where tipousuario = 2 or tipousuario=4 order by nombreuser ASC ";
                                    $vend = pg_query($usrVend);
                                    $tipoprod = "SELECT idtipo, nombretipo from public.tipoprod";
                                    $listip = pg_query($tipoprod);
                                    if ($_POST){
                                        $nomprod = $_POST["nomprod"];
                                        $tipoprod = $_POST["tiposlist"];
                                        $tp = "select idtipo from public.tipoprod WHERE nombretipo = '$tipoprod'";
                                        $qtp = pg_query($tp);
                                        $tipofetch = pg_fetch_array($qtp);
                                        $tipoproducto = $tipofetch['idtipo'];
                                        $cantidad = $_POST["cant"];
                                        $costoprod = $_POST["costo"];
                                        $ventaprod = $_POST["venta"];
                                        $estado = $_POST["estadolist"];
                                        $cant = (int) $cantidad;
                                        $cost = (int) $costoprod;
                                        $venta = (int) $ventaprod;
                                        $ubicacion = $_POST["ubicacion"];
                                        $vendedor = $_POST["vendedoreslist"];
                                        $result =pg_query($cnx, "INSERT INTO public.productos (nombre, tipo, estado, cantidad, costo, venta, ubicacion, vendedor) VALUES('$nomprod',$tipoproducto, '$estado', '$cant','$cost','$venta', '$ubicacion','$vendedor');");
                                        echo"<script>alert('Registrio Agregado Correctamente');
                                        window.location.href='form_validation.php';</script>";
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
                                            <select name="tiposlist">
                                                <?php while ( $tipos = pg_fetch_array($listip)){?>
                                                    <option value="<?php echo $tipos['nombretipo'] ?>"><?php echo $tipos['nombretipo']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
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
                                            <input type="number" id="cant" name="cant" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Costo Por unidad <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="number" id="costo" name="costo" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Venta Total <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="number" id="venta" name="venta" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Ubicación <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="ubicacion" name="ubicacion" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Vendedor<span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="vendedoreslist">
                                                <?php
                                                while ( $vendlis = pg_fetch_array($vend)){
                                                    ?>
                                                    <option value="<?php echo $vendlis['nombreuser'] ?>"><?php echo $vendlis['nombreuser']; ?></option>
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
