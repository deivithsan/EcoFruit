<?php
    session_start();
    require_once "conexion.php";
    global $on;
    $conex = new Conexion();
    $admin = new Admin();

    if (isset($_SESSION['user'])){
        global $priv, $nom;
        $priv = $_SESSION['privil'];
        $nom = $_SESSION['user'];
        if ($priv == 1) {
            session_unset();
            echo '<script> window.location="production/index"; </script>';
        }elseif ($priv == 2 ){
            $on = 1;
        }elseif ($priv == 3 ){
            $on = 2;
        }elseif ($priv == 4){
            $on = 3;
        }
    }
    if (isset($_POST["Enviar"])){
        $conex->enviarComentario();
        exit;
    }
    if (isset($_POST["Login"])){
        $conex->login();
        exit;
    }

?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>EcoFruit!</title>
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
                        <li><a href="#features">Accede</a></li>
                        <li><a href="#facts"> Actualidad</a></li>
                        <li><a href="#contact">Contacto</a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><?php if ($on == 1 or $on == 2 or $on == 3){  echo "<a>Bienvenid@: ",$nom;?>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                    </ul>
                        <form class="nav navbar-form navbar-left" role="search" action="registro">
                            <button onclick='registro' class="btn btn-success">Modificar Información</button>
                        </form>
                        <form class="nav navbar-form navbar-left" role="search" action="logout">
                            <button onclick='logout' class="btn btn-success">Cerrar Sesión</button>
                        </form>
                        <?php }else echo "</ul>"?>
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
						<h2>Accede</h2>
						<div class="devider"></div>
					</div>
                    <?php if($on == 2){
                    ?>
					<div class="col-md-3 wow fadeInLeft" data-wow-duration="500ms">
						<div class="service-item">
							<div class="service-desc">
                                <center>
								<h3><a href="bd">Frutas Disponibles</h3></a>
								<p>Mira que frutas estan disponibles para la compra, se actualiza cuando haya algun producto nuevo!</p>
                                </center>
							</div>
						</div>
					</div>
					<div class="col-md-3 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                        <div class="service-item">
                            <div class="service-desc">
                                <center>
                                <h3><a href="http://ecofruit.herokuapp.com/precioCor">Precios Corabastos</h3></a>
                                <p>Observa el boletin diario de precios que actualmente se encuentra en Corabastos!</p>
                                </center>
                            </div>
                        </div>
					</div>
                    <div class="col-md-3 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                        <div class="service-item">
                            <div class="service-desc">
                                <center>
                                    <h3><a href="compras">Mis Compras</h3></a>
                                    <p>Revisa las compras que has realizado!</p>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInRight" data-wow-duration="500ms"  data-wow-delay="900ms">
                        <div class="service-item">
                            <div class="service-desc">
                                <center>
                                    <h3><a href="usuarios">Perfiles</h3></a>
                                    <p>Mira los perfiles de nuestros vendedores!</p>
                                </center>
                            </div>
                        </div>
                    </div>
                    <?php
                    }elseif ($on == 1){ ?>
                    <div class="col-md-3 wow fadeInLeft" data-wow-duration="500ms">
                        <div class="service-item">
                            <div class="service-desc">
                                <center>
                                    <h3><a href="bd">Frutas Disponibles</h3></a>
                                    <p>Mira que frutas estan disponibles para la compra, se actualiza cuando haya algun producto nuevo!</p>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                        <div class="service-item">
                            <div class="service-desc">
                                <center>
                                    <h3><a href="http://ecofruit.herokuapp.com/precioCor">Precios Corabastos</h3></a>
                                    <p>Observa el boletin diario de precios que actualmente se encuentra en Corabastos!</p>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInRight" data-wow-duration="500ms"  data-wow-delay="500ms">
                        <div class="service-item">
                            <div class="service-desc">
                                <center>
                                <h3><a href="usuarios">Perfiles</h3></a>
                                <p>Mira los perfiles de nuestros vendedores!</p>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="900ms">
                        <div class="service-item">
                            <div class="service-desc">
                                <center>
                                    <h3><a href="misProductos">Mis Productos</h3></a>
                                    <p>Revisa los productos con los que cuentas actualemte en la pagina!</p>
                                </center>
                            </div>
                        </div>
                    </div>
                    <?php }elseif ($on == 3){?>
                        <div class="col-md-3 wow fadeInLeft" data-wow-duration="500ms">
                            <div class="service-item">
                                <div class="service-desc">
                                    <center>
                                        <h3><a href="bd">Frutas Disponibles</h3></a>
                                        <p>Mira que frutas estan disponibles para la compra, se actualiza cuando haya algun producto nuevo!</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                            <div class="service-item">
                                <div class="service-desc">
                                    <center>
                                        <h3><a href="http://ecofruit.herokuapp.com/precioCor">Precios Corabastos</h3></a>
                                        <p>Observa el boletin diario de precios que actualmente se encuentra en Corabastos!</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 wow fadeInRight" data-wow-duration="500ms"  data-wow-delay="500ms">
                            <div class="service-item">
                                <div class="service-desc">
                                    <center>
                                        <h3><a href="usuarios">Perfiles</h3></a>
                                        <p>Mira los perfiles de nuestros vendedores!</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                            <div class="service-item">
                                <div class="service-desc">
                                    <center>
                                        <h3><a href="misProductos">Mis Productos</h3></a>
                                        <p>Revisa los productos con los que cuentas actualemte en la pagina!</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                            <div class="service-item">
                                <div class="service-desc">
                                    <center>
                                        <h3><a href="compras">Mis Compras</h3></a>
                                        <p>Revisa las compras que has realizado!</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                    <?php }else { ?>
                        <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
                            <div class="service-item">
                                <div class="service-desc">
                                    <center>
                                        <h3><a href="bd">Frutas Disponibles</h3></a>
                                        <p>Mira que frutas estan disponibles para la compra, se actualiza cuando haya algun producto nuevo!</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                            <div class="service-item">
                                <div class="service-desc">
                                    <center>
                                        <h3><a href="http://ecofruit.herokuapp.com/precioCor">Precios Corabastos</h3></a>
                                        <p>Observa el boletin diario de precios que actualmente se encuentra en Corabastos!</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 wow fadeInRight" data-wow-duration="500ms"  data-wow-delay="900ms">
                            <div class="service-item">
                                <div class="service-desc">
                                    <h3 align="center">Login</h3>
                                    <form method="post" action="">
                                        <center>
                                            <p>Nombre de Usuario:</p>
                                            <p><input type=text name=nomusuario id='nomusuario' required class="form-control"></p>
                                            <p>Contraseña:</p>
                                            <p><input type=password name=pass id='pass' required class="form-control"></p>
                                            <br/>
                                            <input type="hidden" name="Login" class="btn btn-success">
                                            <input type="submit" name="Entrar" value="Entrar" class="btn btn-success">
                                    </form>
                                    <form name="a" action="registro">
                                        <button onclick='registro' class="btn btn-success">Registrate!</button>
                                    </form>
                                    </center>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
				</div>
			</div>
		</section>

		<section id="facts" class="facts">
			<div class="parallax-overlay">
				<div class="container">
					<div class="row number-counters">
						<div class="sec-title text-center mb50 wow rubberBand animated" data-wow-duration="1000ms">
							<h2>Actualidad</h2>
							<div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
						</div>
                        <?php
                        $compradores = $conex->get_Compradores();
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms">
						    <div class="counters-item">
							    <i class="fa fa-users fa-3x"></i>
							    <strong data-to="<?php echo $compradores; ?>">0</strong>
							    <p>Compradores</p>
						    </div>
					    </div>
                        <?php
                        $vendedores = $conex->get_Vendedores();
                        ?>
					    <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
    						<div class="counters-item">
	    						<i class="fa fa-users fa-3x"></i>
    							<strong data-to="<?php echo $vendedores;?>">0</strong>
    							<p>Vendedores</p>
	    					</div>
		    			</div>
                        <?php
                        $frutas = $conex->get_Frutas();
                        ?>
		    			<div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="600ms">
			    			<div class="counters-item">
				    			<i class="fa fa-shopping-cart fa-3x"></i>
					    		<strong data-to="<?php echo $frutas;?>">0</strong>
						    	<p> Frutas Disponibles</p>
    						</div>
	    				</div>
                        <?php
                        $compras = $conex->get_Compras();
                        ?>
	    				<div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="900ms">
		    				<div class="counters-item">
			    				<i class="fa fa-trophy fa-3x"></i>
				    			<strong data-to="<?php echo $compras;?>">0</strong>
					    		<p>Compras Concretadas</p>
    						</div>
    				    </div>
	    		    </div>
		        </div>
	        </div>
        </section>

		<section id="contact" class="contact">
			<div class="container">
				<div class="row mb50">
					<div class="sec-title text-center mb50 wow fadeInDown animated" data-wow-duration="500ms">
						<h2>Contactenos!</h2>
						<div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
					</div>
					<div class="sec-sub-title text-center wow rubberBand animated" data-wow-duration="1000ms">
						<p>Si desea ponerse en contacto con nosotros para la venta de sus productos o para la compra, llene el siguiente formulario y sera respondido en el menor tiempo posible. Gracias!</p>
					</div>

					<div class="col-lg-12 col-md-8 col-sm-7 col-xs-12 wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="300ms">
						<div class="contact-form">
                            <?php
                            require_once "conexion.php";
                            $email = new Conexion();
                            if (isset($_POST["Enviar"])){
                                $email->enviarComentario();
                                exit;
                            }
                            ?>
							<form action="" id="contact-form" method="post">
								<div class="input-group name-email">
									<div class="input-field">
										<input type="text" name="name" id="name" placeholder="Nombre" class="form-control" required>
									</div>
									<div class="input-field">
										<input type="number" name="tel" id="tel" placeholder="Telefono" class="form-control" required>
									</div>
								</div>
								<div class="input-group">
									<textarea name="message" id="message" placeholder="Mensaje" class="form-control" required></textarea>
								</div>
								<div class="input-group">
                                    <input type="hidden" name="Enviar" />
									<input type="submit" id="form-submit" class="pull-right" value="Enviar Mensaje" name="Enviar Mensaje">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
        <h5 align="center"><i>2018 - EcoFruit</i></h5>


        <!-- Main jQuery -->
        <script src="js/jquery-1.11.1.min.js"></script>
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
        <script src="js/custom.js"></script>
    </body>
</html>
