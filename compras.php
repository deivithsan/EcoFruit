<?php
session_start();
require_once "conexion.php";
$conex = new Conexion();
$admin = new Admin();
global $on;
if (isset($_SESSION['user'])){
    global $priv, $nom;
    $priv = $_SESSION['privil'];
    $nom = $_SESSION['user'];
    if ($priv == 1) {
        session_unset();
        echo '<script> window.location="production/index"; </script>';
    }elseif ($priv == 2 ){
        $on = 2;
    } elseif ($priv == 3 or 4){
        $on = 1;
    } else{
        $on = 0;
    }
}
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Mis Compras</title>
        <link rel="shortcut icon" href="img/icono.ico">
		<!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <nav class="collapse navbar-collapse navbar-right" role="navigation">
                    <ul id="nav" class="nav navbar-nav">
                        <li class="current"><a href="#body">Inicio</a></li>
                        <li><a href="#features">Compras</a></li>
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
                        <li><?php if ($on == 2 or $on == 1){
                            $nom = $conex->get_NombreApellido();
                            echo "<a>$nom";
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
                    <form class="nav navbar-form navbar-left" role="search" action="index">
                        <button onclick='index' class="btn btn-success"><i class="fa fa-home fa-lg"></i></button>
                    </form>
                    <form class="nav navbar-form navbar-left" role="search" action="logout">
                        <button onclick='logout' class="btn btn-success">Cerrar Sesión</button>
                    </form>
                    <?php }else echo "</ul>" ?>
                </nav>
            </div>
            </div>
        </header>

		<section id="slider">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner" role="listbox">
					<div class="item active" style="background-image: url(img/log3.png);">
                        <div class="carousel-caption">
                            <h2 data-wow-duration="700ms" data-wow-delay="500ms" class="wow bounceInDown animated" style="color: white;"><span>EcoFruit!</span></h2>
                            <h3 data-wow-duration="1000ms" class="wow slideInLeft animated"><span class="color">Venta eficaz, rapida y total de la fruta en su cosecha</span> </h3>
                            <ul class="social-links text-center">
                                <li><i class="fa fa-twitter fa-lg"></i></li>
                                <li><a href="index"><i class="fa fa-home fa-lg"></i></a></li>
                                <li><i class="fa fa-facebook fa-lg"></i></li>
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
						<h2>Mis compras</h2>
						<div class="devider"></div>
					</div>
                <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <table id="datatable-buttons2" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id Compra</th>
                                        <th>Id Producto</th>
                                        <th>Nombre del Producto</th>
                                        <th>Estado</th>
                                        <th>Cantidad Disponible (Kilos)</th>
                                        <th>Costo Por Unidad ($)</th>
                                        <th>Cantidad Comprada (Kilos)</th>
                                        <th>Vendedor del Producto</th>
                                        <th>Valoración de Compra</th>
                                        <th>Información de la Valoración</th>
                                        <th>Fecha de Compra</th>
                                        <th>Hora de Compra:</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $user = $_SESSION['user'];
                                    $compras = $admin->get_misCompras($user);
                                    for ($g=0; $g<sizeof($compras); $g++){
                                     ?>
                                    <tr>
                                         <td align="center"><?php echo $compras[$g][0]; ?></td>
                                         <td align="center"><?php echo $compras[$g][1]; ?></td>
                                         <td align="center"><?php echo $compras[$g][2]; ?></td>
                                         <td align="center"><?php echo $compras[$g][3]; ?></td>
                                         <td align="center"><?php echo number_format($compras[$g][4],0); ?></td>
                                         <td align="center"><?php echo number_format($compras[$g][5],0); ?></td>
                                         <td align="center"><?php echo number_format($compras[$g][6],0); ?></td>
                                         <td align="center"><?php echo $compras[$g][9]; ?></td>
                                         <td align="center"><?php echo $compras[$g][15]; ?></td>
                                         <td align="center"><?php echo $compras[$g][12]; ?></td>
                                         <td align="center"><?php echo $compras[$g][13]; ?></td>
                                         <td align="center"><?php echo $compras[$g][14]; ?></td>
                                    </tr>
                                    <?php   }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                        </div>
                    </div>
		</section>
        <h5 align="center"><i>2018 - EcoFruit</i></h5>


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
		<!-- jquery easing -->
        <script src="js/jquery.easing.min.js"></script>
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
        <script src="./vendors/jszip/dist/jszip.min.js"></script>
        <script src="./vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="./vendors/pdfmake/build/vfs_fonts.js"></script>
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
        <script>
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