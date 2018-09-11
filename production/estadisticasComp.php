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
    <title>Estadisticas Compradores</title>
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
                            <li><a><i class="fa fa-edit"></i> Modificar Datos<span class="fa fa-chevron-down"></span></a>
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
                            <h2>Estadisticas de Usuarios Tipo Comprador</h2>
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
                                    <label class="col-md-6 col-sm-6 col-xs-12"> Seleccione el Usuario: </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="vendedoreslist">
                                            <?php
                                            $compradores = $admin->get_compradores();
                                            $rows = count($compradores);
                                            for ($i = 0; $i < $rows; $i++) {
                                                ?>
                                                <option value="<?php echo $compradores[$i][0] ?>"><?php echo $compradores[$i][2].' '.$compradores[$i][3]; ?></option>
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

                            $datos = $admin->get_datosuser($user);
                            $rows2 = count($datos);
                            for ($i = 0; $i < $rows2; $i++) {
                                $nombres= $datos[0][2].' '.$datos[0][3];
                            }
                            $comprasEn= $admin->get_comprasEne($user);
                            $comprasFeb= $admin->get_comprasFeb($user);
                            $comprasMar= $admin->get_comprasMar($user);
                            $comprasAbr= $admin->get_comprasAbr($user);
                            $comprasMay= $admin->get_comprasMay($user);
                            $comprasJun= $admin->get_comprasJun($user);
                            $comprasJul= $admin->get_comprasJul($user);
                            $comprasAgo= $admin->get_comprasAgo($user);
                            $comprasSep= $admin->get_comprasSep($user);
                            $comprasOct= $admin->get_comprasOct($user);
                            $comprasNov= $admin->get_comprasNov($user);
                            $comprasDic= $admin->get_comprasDic($user);

                            $compras = $admin->get_comprasUser($user);
                            $rows = count($compras);
                            if ($rows == 0){
                                echo '<script>alert("El usuario '.$user.' no ha realizado ninguna compra, intente con otro usuario")</script>';
                                echo "<script type=\"text/javascript\">window.location='estadisticasComp'</script>";
                            }
                            echo "<center><h2>Usuario: $nombres</h2></center>";
                            ?>
                            <div class="x_content">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id Compra</th>
                                        <th>Id Producto</th>
                                        <th>Nombre del Producto</th>
                                        <th>Ubicación del Producto</th>
                                        <th>Cantidad Comprada (Kilos)</th>
                                        <th>Vendedor del Producto</th>
                                        <th>Valoración de Compra</th>
                                        <th>Detalle de la Valoración</th>
                                        <th>Fecha de Compra</th>
                                        <th>Hora de Compra</th>
                                        <th>Observación de Compra:</th>
                                        <th>Valor a Pagar:</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    for ($g = 0; $g < $rows; $g++) { ?>
                                        <tr>
                                            <td align="center"><?php echo $compras[$g][0]; ?></td>
                                            <td align="center"><?php echo $compras[$g][6]; ?></td>
                                            <td align="center"><?php echo $compras[$g][7]; ?></td>
                                            <td align="center"><?php echo $compras[$g][8]; ?></td>
                                            <td align="center"><?php echo number_format($compras[$g][10],0); ?></td>
                                            <td align="center"><?php echo $compras[$g][5]; ?></td>
                                            <td align="center"><?php echo $compras[$g][1]; ?></td>
                                            <td align="center"><?php echo $compras[$g][2]; ?></td>
                                            <td align="center"><?php echo $compras[$g][3]; ?></td>
                                            <td align="center"><?php echo $compras[$g][4]; ?></td>
                                            <td align="center"><?php echo $compras[$g][11]; ?></td>
                                            <td align="center">$<?php echo number_format($compras[$g][9],0); ?>.00</td>
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
                        <center><h2>Estadisticas Detalladas Para Cada Mes.</h2></center>
                        &nbsp;
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Enero</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdEnero = $admin->get_comprasProdEne($user);
                                if ($comprasProdEnero == 0) {
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizó ninguna compra en el mes de enero.</h2></div></div></div>";
                                } else {
                                $rowsEne = count($comprasProdEnero);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafEne" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                <?php
                }
                ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Febrero</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdFebrero = $admin->get_comprasProdFeb($user);
                                if($comprasProdFebrero == 0){
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizó ninguna compra en el mes de febrero.</h2></div></div></div>";
                                } else {
                                $rowsFeb = count($comprasProdFebrero);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafFeb" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Marzo</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdMarzo = $admin->get_comprasProdMar($user);
                                if($comprasProdMarzo == 0){
                                    echo "<h2 align='center'> El usuario no realizó ninguna compra en el mes de marzo.</h2></div></div>";
                                } else {
                                $rowsMar = count($comprasProdMarzo);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafMar" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Abril</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdAbril = $admin->get_comprasProdAbr($user);
                                if($comprasProdAbril == 0){
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizzó ninguna compra en el mes de abril.</h2></div></div></div>";
                                } else {
                                $rowsAbr = count($comprasProdAbril);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafAbr" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Mayo</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdMayo = $admin->get_comprasProdMay($user);
                                if($comprasProdMayo == 0){
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizó ninguna compra en el mes de mayo.</h2></div></div></div>";
                                } else {
                                $rowsMay = count($comprasProdMayo);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafMay" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Junio</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdJunio = $admin->get_comprasProdJun($user);
                                if($comprasProdJunio == 0){
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizó ninguna compra en el mes de junio.</h2></div></div></div>";
                                } else {
                                $rowsJun = count($comprasProdJunio);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafJun" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Julio</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdJulio = $admin->get_comprasProdJul($user);
                                if($comprasProdJulio == 0){
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizó ninguna compra en el mes de julio.</h2></div></div></div>";
                                } else {
                                $rowsJul = count($comprasProdJulio);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafJul" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Agosto</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdAgosto = $admin->get_comprasProdAgo($user);
                                if($comprasProdAgosto == 0){
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizó ninguna compra en el mes de agosto.</h2></div></div></div>";
                                } else {
                                $rowsAgo = count($comprasProdAgosto);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafAgo" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Septiembre</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdSeptiembre = $admin->get_comprasProdSep($user);
                                if($comprasProdSeptiembre == 0){
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizó ninguna compra en el mes de septiembre.</h2></div></div></div>";
                                } else {
                                $rowsSep = count($comprasProdSeptiembre);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafSep" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Octubre</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdOctubre = $admin->get_comprasProdOct($user);
                                if($comprasProdOctubre == 0){
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizó ninguna compra en el mes de octubre.</h2></div></div></div>";
                                } else {
                                $rowsOct = count($comprasProdOctubre);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafOct" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Noviembre</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdNoviembre = $admin->get_comprasProdNov($user);
                                if($comprasProdNoviembre == 0){
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizó ninguna compra en el mes de noviembre.</h2></div></div></div>";
                                } else {
                                $rowsNov = count($comprasProdNoviembre);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafNov" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Compras de Diciembre</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                $comprasProdDiciembre = $admin->get_comprasProdDic($user);
                                if($comprasProdDiciembre == 0){
                                    echo "<div class='x_content'><h2 align='center'> El usuario no realizó ninguna compra en el mes de diciembre.</h2></div></div></div>";
                                } else {
                                $rowsDic = count($comprasProdDiciembre);
                                ?>
                                <div class="x_content">
                                    <div id="containerGrafDic" style="height: 400px"></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                            </div>
                        </div>
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
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.js"></script>
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
                text: 'Compras mensuales de <?php echo $nombres; ?>'
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
                name: 'Compras',
                data: [<?php echo $comprasEn; ?>, <?php echo $comprasFeb; ?>, <?php echo $comprasMar; ?>,
                    <?php echo $comprasAbr; ?>, <?php echo $comprasMay; ?>,<?php echo $comprasJun; ?>,
                    <?php echo $comprasJul; ?>, <?php echo $comprasAgo; ?>, <?php echo $comprasSep; ?>,
                    <?php echo $comprasOct; ?>, <?php echo $comprasNov; ?>, <?php echo $comprasDic; ?>]
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafEne').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de enero'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsEne; $i++) {
                    ?>
                    ['<?php echo $comprasProdEnero[$i][0] ?>', <?php echo $comprasProdEnero[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafFeb').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de febrero'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsFeb; $i++) {
                    ?>
                    ['<?php echo $comprasProdFebrero[$i][0] ?>', <?php echo $comprasProdFebrero[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafMar').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de marzo'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsMar; $i++) {
                    ?>
                    ['<?php echo $comprasProdMarzo[$i][0] ?>', <?php echo $comprasProdMarzo[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafAbr').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de abril'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsAbr; $i++) {
                    ?>
                    ['<?php echo $comprasProdAbril[$i][0] ?>', <?php echo $comprasProdAbril[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafMay').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de mayo'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsMay; $i++) {
                    ?>
                    ['<?php echo $comprasProdMayo[$i][0] ?>', <?php echo $comprasProdMayo[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafJun').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de junio'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsJun; $i++) {
                    ?>
                    ['<?php echo $comprasProdJunio[$i][0] ?>', <?php echo $comprasProdJunio[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafJul').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de julio'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsJul; $i++) {
                    ?>
                    ['<?php echo $comprasProdJulio[$i][0] ?>', <?php echo $comprasProdJulio[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafAgo').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de agosto'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsAgo; $i++) {
                    ?>
                    ['<?php echo $comprasProdAgosto[$i][0] ?>', <?php echo $comprasProdAgosto[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafSep').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de septiembre'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsSep; $i++) {
                    ?>
                    ['<?php echo $comprasProdSeptiembre[$i][0] ?>', <?php echo $comprasProdSeptiembre[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafOct').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de octubre'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsOct; $i++) {
                    ?>
                    ['<?php echo $comprasProdOctubre[$i][0] ?>', <?php echo $comprasProdOctubre[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafNov').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de noviembre'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsNov; $i++) {
                    ?>
                    ['<?php echo $comprasProdNoviembre[$i][0] ?>', <?php echo $comprasProdNoviembre[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#containerGrafDic').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Compras mes de diciembre'
            },
            <?php
            $año = date("Y");
            ?>
            subtitle: {
                text: '<?php echo $año; ?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de compras de ese producto'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Compras',
                data: [<?php
                    for ($i = 0; $i < $rowsDic; $i++) {
                    ?>
                    ['<?php echo $comprasProdDiciembre[$i][0] ?>', <?php echo $comprasProdDiciembre[$i][1]; ?>],
                    <?php
                    }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
</body>
</html>