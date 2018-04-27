<?php
session_start();
require_once "conexion.php";
$conex = new Conexion();
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
        <title>Productos</title>
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
						<h2>Productos Disponibles para la Compra</h2>
						<div class="devider"></div>
					</div>
                <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <table id="datatable-buttons2" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id Producto</th>
                                        <th>Nombre Producto</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th>Cantidad (Kilos)</th>
                                        <th>Costo Producto ($)</th>
                                        <th>Costo Total ($)</th>
                                        <th>Ubicación</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $user = $_SESSION['user'];
                                    $prod = $conex->get_ProductosToBuy($user);
                                    for ($g=0; $g<sizeof($prod); $g++){
                                     ?>
                                    <tr>
                                         <td align="center"><?php echo $prod[$g][0]; ?></td>
                                         <td align="center"><?php echo $prod[$g][1]; ?></td>
                                         <td align="center"><?php echo $prod[$g][2]; ?></td>
                                         <td align="center"><?php echo $prod[$g][3]; ?></td>
                                         <td align="center"><?php echo number_format($prod[$g][4],0); ?></td>
                                         <td align="center"><?php echo number_format($prod[$g][5],0); ?></td>
                                         <td align="center"><?php echo number_format($prod[$g][6],0); ?></td>
                                         <td align="center"><?php echo $prod[$g][7]; ?></td>
                                    </tr>
                                    <?php   }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($on == 1){ ?>

                    <center>
                    <h3> Busca El Producto Que Quieras Comprar! </h3>
                    </center>
                    <br></br>
                    <span class="section"></span>
                    <?php
                    if ($_POST){
                        if ($_POST["buscar"]){
                            $idBuscado = $conex->get_Id();
                            $idProd = $idBuscado[0][0];
                            $nomProd = $idBuscado[0][1];
                            $estProd = $idBuscado[0][2];
                            $cantProd = $idBuscado[0][3];
                            $costProd = $idBuscado[0][4];
                            $vendProd = $idBuscado[0][7];
                            $ubiProd = $idBuscado[0][6];
                            $valTotalProd = $idBuscado[0][5];

                            if ($cantProd == 0){
                                echo "<script>alert('El producto actualmente no tiene unidades disponibles para la compra, por favor intente con otro producto.')</script>";
                                echo"<script type=\"text/javascript\">window.location='bd'</script>";
                            }
                        }
                    }
                    ?>
                <center>
                <form class="form-horizontal form-label-left input_mask" method="post">
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Id del Producto:<span class="required"></span></label>                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" id="idprod" name="idprod" class="form-control col-md-7 col-xs-12" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-9">
                                    <input type="submit" class="btn btn-success" style="display:inline" name="buscar" id="buscar" value="Buscar">
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if ($_POST["comprar"]){
                    $conex->make_Buy();
                    exit;
                }
                if ($_POST["buscar"]){
                $file = "production/images/Productos/$idProd.jpg";
                ?>
                <div class="container">
                    <div class="row">
                        <div class="form-horizontal">
                            <div class="item form-group"></div>
                        </div>
                        <div class="col-md-6 wow fadeInLeft" data-wow-duration="500ms">
                            <div class="service-item">
                                <div class="service-desc">
                                    <center>
                                        <form class="form-horizontal form-label-left input_mask" method="post">
                                            <div class="item form-group">
                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name"
                                                       style="display:none">ID<span class="required"></span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="idproduc" name="idproduc"
                                                           class="form-control col-md-7 col-xs-12" style="display:none"
                                                           value="<?php echo $idProd; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name"
                                                       style="display:inline">Nombre:<span class="required"></span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" DISABLED class="form-control col-md-7 col-xs-12"
                                                           style="display:inline" value="<?php echo $nomProd; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name"
                                                       style="display:inline">Estado:<span class="required"></span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" DISABLED class="form-control col-md-7 col-xs-12"
                                                           style="display:inline" value="<?php echo $estProd; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name"
                                                       style="display:inline">Ubicación:<span class="required"></span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" DISABLED class="form-control col-md-7 col-xs-12"
                                                           style="display:inline" value="<?php echo $ubiProd; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name"
                                                       style="display:inline">Cantidad Disponible (Kilos): <span
                                                            class="required"></span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" DISABLED class="form-control col-md-7 col-xs-12"
                                                           style="display:inline" value="<?php echo $cantProd; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name"
                                                       style="display:inline">Costo por Unidad: $<span class="required"></span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" DISABLED class="form-control col-md-7 col-xs-12"
                                                           style="display:inline" value="<?php echo $costProd; ?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name"
                                                       style="display:inline">Costo Total: $<span class="required"></span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" DISABLED class="form-control col-md-7 col-xs-12"
                                                           style="display:inline" value="<?php echo $valTotalProd; ?>">
                                                </div>
                                            </div>
                                            <input type="text" id="nomprod" name="nomprod" style="display:none"
                                                   value="<?php echo $nomProd; ?>">
                                            <input type="text" id="est" name="est" style="display:none" value="<?php echo $estProd; ?>">
                                            <input type="number" id="cant" name="cant" style="display:none"
                                                   value="<?php echo $cantProd; ?>">
                                            <input type="number" id="costo" name="costo" style="display:none"
                                                   value="<?php echo $costProd; ?>">
                                            <input type="text" id="vendedor" name="vendedor" style="display:none"
                                                   value="<?php echo $vendProd; ?>">
                                            <div class="item form-group">
                                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name"
                                                       style="display:inline">Cantidad A Comprar: <span class="required"></span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="cantbuy" name="cantbuy"
                                                           class="form-control col-md-7 col-xs-12" required>
                                                </div>
                                            </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"></div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <input type="submit" class="btn btn-success" style="display:inline" name="comprar" id="comprar" value="Comprar">
                                            </div>
                                        </div>
                                    </center>
                                        </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeInRight" data-wow-duration="500ms">
                            <div class="service-item">
                                <div class="service-desc">
                                    <center>
                                        <h4>Foto del Producto</h4>
                                        <h4>&nbsp;</h4>
                                        <?php
                                        if (file_exists($file)){
                                            ?>
                                            <img src="<?php echo $file; ?>" width="350" height="350"/>
                                            <?php
                                        } else{
                                            ?>
                                            <h6>El producto no dispone de una foto.</h6>
                                            <?php
                                        }
                                        ?>
                                    </center>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                        <?php
                        }
                }elseif ($on == 0) {
                    echo "
                        <br><br>
                        <div class=\"sec-title text-center mb50 wow fadeInDown animated\" data-wow-duration=\"500ms\">
						    <h2>Si deseas comprar ingresa a tu cuenta o registrate!</h2>
						    <div class=\"devider\"><i class=\"fa fa-heart-o fa-lg\"></i></div>
					    </div>";
                    } elseif ($on ==2){
                    echo "
                        <br><br>
                        <div class=\"sec-title text-center mb50 wow fadeInDown animated\" data-wow-duration=\"500ms\">
						    <h2>Hola $nom Si deseas comprar debes ser comprador, si deseas cambiar tu tipo de cuenta comunicate con nuestros administradores.</h2>
						    <br>
						    <h2>Gracias!</h2>
						    <div class=\"devider\"><i class=\"fa fa-heart-o fa-lg\"></i></div>
					    </div>";
                }
                ?>
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
        <script src="./vendors/datatables.net/js/jquery.dataTables.js"></script>
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