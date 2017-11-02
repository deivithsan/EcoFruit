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
        <title>Vendedores</title>
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
                            <li><a href="#features">Vendedores</a></li>
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
						<h2>Nuestros vendedores!</h2>
						<div class="devider"></div>
					</div>
                    <div class="clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <?php
                                $selUser = "select infousuarios.nombre, infousuarios.apellido, infousuarios.direccion, usuarios.tipousuario, infousuarios.nombreuser from infousuarios, usuarios where usuarios.nombreuser = infousuarios.nombreuser and (usuarios.tipousuario = 2 or usuarios.tipousuario = 4) order by infousuarios.nombre";
                                $res = pg_query($cnx, $selUser);
                                if ($res){
                                    if (pg_num_rows($res)>0){
                                        while ($row = pg_fetch_object($res)){
                                            $nomuser = $row->nombreuser;
                                            $selVal = "select vendedorprod, valoracion from compra where vendedorprod = '$nomuser'";
                                            $res2 = pg_query($cnx, $selVal);
                                            $x = pg_num_rows($res2);
                                            if ($x == 0){
                                                $val = 0;
                                            } elseif ($x == 1){
                                                $val = 1;
                                            } elseif ($x >= 2){
                                                $selSum = "select sum(valoracion) as promedio from compra where vendedorprod = '$nomuser'";
                                                $res3 = pg_query($selSum);
                                                $row2 = pg_fetch_array($res3);
                                                $z = $row2["promedio"];
                                                $valoracion = $z/$x ;
                                                $val = round($valoracion);
                                            }
                                ?>
                                <figure class="team-member col-md-3 col-sm-6 col-xs-12 text-center fa-border">
                                    <div class="member-thumb">
                                            <h5>Nombre:</h5>
                                            <p><?php echo $row->nombre." ".$row->apellido?></p>
                                            <h5>Ubicación:</h5>
                                            <p><?php echo $row->direccion?></p>
                                            <br>
                                            <h5>Valoración Promedio:</h5>
                                            <p class="ratings">
                                                <a><?php echo $val; ?></a>
                                                <?php
                                                if ($val == 5){
                                                ?>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star"></span></a>
                                                <?php
                                                } elseif ($val == 4){ ?>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <?php
                                                } elseif ($val == 3){ ?>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <?php
                                                } elseif ($val == 2){ ?>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <?php
                                                } elseif ($val == 1){ ?>
                                                <span class="fa fa-star"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <?php
                                                } elseif ($val == 0){ ?>
                                                <span class="fa fa-star-o"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <span class="fa fa-star-o"></span></a>
                                                <?php } ?>
                                            </p>
                                        </figcaption>
                                    </div>
                                </figure>
                                <?php } } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="sec-title text-center mb50 wow fadeInDown animated" data-wow-duration="500ms">
                <h2>Los usuarios con valoracion 0 es porque aun no han realizado una venta o no ha sido valorada</h2>
                <div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
            </div>
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
        <script src="build/js/custom.min.js"></script>
        <script src="js/custom.js"></script>
		<script type="text/javascript">
		</script>
    </body>
</html>
