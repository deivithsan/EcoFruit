<?php
session_start();
include 'conex.php';
$cnx = pg_connect($strCnx) or die (print "Error de conexion. ");
global $on;
if (isset($_SESSION['user'])){
    global $priv, $nom;
    $priv = $_SESSION['privil'];
    $nom = $_SESSION['user'];
    if ($priv == 1) {
        session_unset();
        echo '<script> window.location="production/index.php"; </script>';
    }elseif ($priv == 3 or 4 ){
        $on = 1;
    }
}
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Productos</title>
		<!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Google Font -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

		<!-- CSS
		================================================== -->
		<!-- Fontawesome Icon font -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Twitter Bootstrap css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- jquery.fancybox  -->
        <link rel="stylesheet" href="css/jquery.fancybox.css">
		<!-- animate -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- Main Stylesheet -->
        <link rel="stylesheet" href="css/main.css">
		<!-- media-queries -->
        <link rel="stylesheet" href="css/media-queries.css">
        <!-- NProgress -->
        <link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="./vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="./vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="./vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="./vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="./vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="./vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

		<!-- Modernizer Script for old Browsers -->
        <script src="js/modernizr-2.6.2.min.js"></script>
    </head>

    <body id="body">
		<div id="preloader">
			<img src="img/Fruta.gif" alt="Preloader">
		</div>
        <header id="navigation" class="navbar-fixed-top navbar">
            <div class="container">
                <div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars fa-2x"></i>
                    </button>
                <nav class="collapse navbar-collapse navbar-right" role="navigation">
                    <ul id="nav" class="nav navbar-nav">
                        <li class="current"><a href="#body">Inicio</a></li>
                        <li><a href="#features">Productos</a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><?php if ($on == 1){
                            $sql = "select nombre, apellido from public.infousuarios where nombreuser = '$nom'";
                            $result = pg_query($sql);
                            $array = pg_fetch_array($result);
                            $nombre = $array["nombre"];
                            $apellido = $array["apellido"];
                            echo "<a>$nombre $apellido";
                            ?>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                    </ul>
                    <a href="logout.php">Cerrar Sesión</a>
                    <?php }else echo "</ul>" ?>
                </nav>
            </div>
        </header>

		<section id="slider">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<div class="item active" style="background-image: url(img/log3.png);">
						<div class="carousel-caption">
							<h2 data-wow-duration="700ms" data-wow-delay="500ms" class="wow bounceInDown animated"><a href="index.php">EcoFruit</span>!</a></h2>
							<h3 data-wow-duration="1000ms" class="wow slideInLeft animated"><span class="color">Venta eficaz, rapida y total de la fruta en su cosecha</span> </h3>
							<p data-wow-duration="1000ms" class="wow slideInRight animated">No se debe perder ni una fruta!</p>
							<ul class="social-links text-center">
								<li><a href=""><i class="fa fa-twitter fa-lg"></i></a></li>
								<li><a href=""><i class="fa fa-facebook fa-lg"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

        <section id="features" class="features">
			<div class="container">
				<div class="row">
					<div class="sec-title text-center mb50 wow bounceInDown animated" data-wow-duration="500ms">
						<h2>Productos Disponibles para la Compra</h2>
						<div class="devider"></div>
					</div>
                <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <?php
                                include_once 'conex.php';
                                $cnx = pg_connect($strCnx) or die ("Error de Conexion. ".pg_last_error());
                                $hccQuery3 = "SELECT * FROM public.productos ORDER BY idprod";
                                $result3 = pg_query($cnx, $hccQuery3);

                                if($result3){
                                if(pg_num_rows($result3)>0){
                                ?>
                                <table id="datatable-buttons2" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id Producto</th>
                                        <th>Nombre Producto</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th>Cantidad</th>
                                        <th>Costo Producto</th>
                                        <th>Valor Venta</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = pg_fetch_object($result3)) { ?>
                                    <tr>
                                         <td><?php echo $row->idprod ?></td>
                                         <td><?php echo $row->nombre ?></td>
                                         <td><?php echo $row->tipo ?></td>
                                         <td><?php echo $row->estado ?></td>
                                         <td><?php echo $row->cantidad ?></td>
                                         <td><?php echo $row->costo ?></td>
                                         <td><?php echo $row->venta ?></td>
                                    </tr>
                                    <?php }  }  }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($on == 1){ ?>
                <form class="form-horizontal form-label-left input_mask" method="post">
                    <center>
                    <h3> Busca El Producto Que Quieras Comprar! </h3>
                    </center>
                    <br></br>
                    <span class="section"></span>
                    <?php
                    $desp = "SELECT nombrestado FROM public.estado";
                    $lis = pg_query($desp);
                    $bus = "SELECT idprod FROM public.productos";
                    $bu = pg_query($bus);
                    if ($_POST){
                        $idproduc = $_POST["idprod"];
                        if ($_POST["buscar"]){
                            while($busq = pg_fetch_array($bu)){
                                if ($busq ["idprod"] == $idproduc){
                                    $llen = "SELECT * from public.productos where idprod ='$idproduc' ";
                                    $llenar = pg_query($llen);
                                    $row = pg_fetch_assoc($llenar);
                                }
                            }
                        }
                        if ($_POST["comprar"]){
                            $iddelproductocompra = $_POST["idproduc"];
                            $idpr = (int) $iddelproductocompra;
                            $nomprod = $_POST["nomprod"];
                            $est = $_POST["est"];
                            $cantidaddisp = $_POST["cant"];
                            $costounitario = $_POST["costo"];
                            $cantidadcomp = $_POST["cantbuy"];
                            $vendedor = $_POST["vendedor"];
                            $ced = "select cedula from public.infousuarios where nombreuser='$nom'";
                            $query = pg_query($ced);
                            $array = pg_fetch_array($query);
                            $numerocedula = $array["cedula"];
                            $tel = "select telefono from public.infousuarios where nombreuser='$nom'";
                            $query1 = pg_query($tel);
                            $array1 = pg_fetch_array($query1);
                            $numerocelular = $array1["telefono"];
                            $cantdis = (int) $cantidaddisp;
                            $costun = (int) $costounitario;
                            $cantbuy = (int) $cantidadcomp;
                            $numced = (int) $numerocedula;
                            $tel = (int) $numerocelular;
                            $agregar =pg_query($cnx, "INSERT INTO public.compra (idprod,nombreprod, estado, cantdisp, costuni, cantbuy, numced, numcel, vendedorprod, comprador) VALUES ($idpr,'$nomprod','$est',$cantdis,$costun,$cantbuy,$numced,$tel,'$vendedor','$nom');");
                            echo"<script>alert('Compra Realizada Correctamente')</script>";
                        }
                    }
                    ?>
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Id del Producto<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" id="idprod" name="idprod" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <center>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <input type="submit" class="btn btn-success" style="display:inline" name="buscar" id="buscar" value="Buscar">
                            </div>
                        </div>
                    </div>
                    </center>
                    <?php //ARREGLAR DESDE AQUI?>
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name" style="display:none">ID<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="idproduc" name="idproduc"  class="form-control col-md-7 col-xs-12" style="display:none" value="<?php echo $row['idprod'] ?>">
                            </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name" style="display:inline">Nombre<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  DISABLED class="form-control col-md-7 col-xs-12" style="display:inline" value="<?php echo $row['nombre'] ?>">
                            </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name" style="display:inline">Estado<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  DISABLED class="form-control col-md-7 col-xs-12" style="display:inline" value="<?php echo $row['estado'] ?>">
                            </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name" style="display:inline">Cantidad Disponible <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number"  DISABLED  class="form-control col-md-7 col-xs-12" style="display:inline" value="<?php echo $row['cantidad'] ?>">
                            </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name" style="display:inline">Costo por Unidad <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number"  DISABLED  class="form-control col-md-7 col-xs-12" style="display:inline" value="<?php echo $row['costo'] ?>">
                            </div>
                    </div>
                    <input type="text" id="nomprod" name="nomprod"  style="display:none" value="<?php echo $row['nombre'] ?>">
                    <input type="text" id="est" name="est" style="display:none" value="<?php echo $row['estado'] ?>">
                    <input type="number" id="cant" name="cant"  style="display:none" value="<?php echo $row['cantidad'] ?>">
                    <input type="number" id="costo" name="costo"  style="display:none" value="<?php echo $row['costo'] ?>">
                    <input type="text" id="vendedor" name="vendedor"  style="display:none" value="<?php echo $row['vendedor'] ?>">
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name" style="display:inline">Cantidad A Comprar <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="cantbuy" name="cantbuy"   class="form-control col-md-7 col-xs-12">
                            </div>
                    </div>
                    <center>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <input type="submit" class="btn btn-success" style="display:inline" name="comprar" id="comprar" value="Comprar">
                   </center>
                   <?php pg_close($cnx) ?>
                </form>
                <?php
                }else{
                    echo "
                        <br><br>
                        <div class=\"sec-title text-center mb50 wow fadeInDown animated\" data-wow-duration=\"500ms\">
						    <h2>Si deseas comprar ingresa a tu cuenta o registrate!</h2>
						    <div class=\"devider\"><i class=\"fa fa-heart-o fa-lg\"></i></div>
					    </div>";
                    }
                ?>
		</section>

        <!-- Main jQuery -->
        <script src="js/jquery-1.11.1.min.js"></script>
        <!-- Bootstrap -->
        <script src="./vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- Single Page Nav -->
        <script src="js/jquery.singlePageNav.min.js"></script>
		<!-- Twitter Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
		<!-- jquery.fancybox.pack -->
        <script src="js/jquery.fancybox.pack.js"></script>
		<!-- jquery.mixitup.min -->
        <script src="js/jquery.mixitup.min.js"></script>
		<!-- jquery.parallax -->
        <script src="js/jquery.parallax-1.1.3.js"></script>
		<!-- jquery.countTo -->
        <script src="js/jquery-countTo.js"></script>
		<!-- jquery.appear -->
        <script src="js/jquery.appear.js"></script>
		<!-- Contact form validation -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
		<!-- jquery easing -->
        <script src="js/jquery.easing.min.js"></script>
		<!-- jquery easing -->
        <script src="js/wow.min.js"></script>
		<script>
			var wow = new WOW ({
				boxClass:     'wow',
				animateClass: 'animated',
				offset:       120,
				mobile:       false,
				live:         true
			  }
			);
			wow.init();
		</script>

        <!-- Datatables -->
        <script src="./vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="./vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="./vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="./vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="./vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="./vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="./vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="./vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="./vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="./vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="./vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="./vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
        <script src="./vendors/jszip/dist/jszip.min.js"></script>
        <script src="./vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="./vendors/pdfmake/build/vfs_fonts.js"></script>
        <!-- Datatables -->
        <script>
            $(document).ready(function() {
                var handleDataTableButtons = function() {
                    if ($("#datatable-buttons").length) {

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
            $(document).ready(function() {
                var handleDataTableButtons = function() {
                    if ($("#datatable-buttons2").length) {
                        $("#datatable-buttons2").DataTable({
                            dom: "Bfrtip",
                            buttons: [

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
        <script src="js/custom.js"></script>
		<script type="text/javascript">
		</script>
    </body>
</html>
