<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
    	<!-- meta charec set -->
        <meta charset="utf-8">
		<!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- Page Title -->
        <title>InfoFruit</title>
		<!-- Meta Description -->

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

		<!-- Modernizer Script for old Browsers -->
        <script src="js/modernizr-2.6.2.min.js"></script>

    </head>

    <body id="body">

		<!-- preloader -->
		<div id="preloader">
			<img src="img/Fruta.gif" alt="Preloader">
		</div>
		<!-- end preloader -->

        <!--
        Fixed Navigation
        ==================================== -->
        <header id="navigation" class="navbar-fixed-top navbar">
            <div class="container">
                <div class="navbar-header">
                    <!-- responsive nav button -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars fa-2x"></i>
                    </button>

				<!-- main nav -->
                <nav class="collapse navbar-collapse navbar-right" role="navigation">
                    <ul id="nav" class="nav navbar-nav">
                    </ul>
                </nav>
				<!-- /main nav -->

            </div>
        </header>
        <!--
        End Fixed Navigation
        ==================================== --><!--
        Home Slider
        ==================================== -->

		<section id="slider">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

				<!-- Indicators bullet -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				</ol>
				<!-- End Indicators bullet -->

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">

					<!-- single slide -->
					<div class="item active" style="background-image: url(img/log3.png);">
						<div class="carousel-caption">
							<h2 data-wow-duration="700ms" data-wow-delay="500ms" class="wow bounceInDown animated" ><a href="index.php">InfoFruit</span>!</a></h2>
							<h3 data-wow-duration="1000ms" class="wow slideInLeft animated"><span class="color">Venta eficaz, rapida y total de la fruta en su cosecha</span> </h3>
							<p data-wow-duration="1000ms" class="wow slideInRight animated">No se debe perder ni una fruta!</p>

							<ul class="social-links text-center">
								<li><a href=""><i class="fa fa-twitter fa-lg"></i></a></li>
								<li><a href=""><i class="fa fa-facebook fa-lg"></i></a></li>
							</ul>
						</div>
					</div>
					<!-- end single slide --></div>
				<!-- End Wrapper for slides --></div>
		</section><!--
        Features
        ==================================== -->
        <section id="features" class="features">
			<div class="container">
				<div class="row">

					<div class="sec-title text-center mb50 wow bounceInDown a  nimated" data-wow-duration="500ms">
						<h2>Registrate!!</h2>
						<div class="devider"></div>
					</div>

					<!-- service item -->

        <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
          </div>

					<div class="col-md-4 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">


<!-- Formulario -->

          <form class="form-horizontal  " method="post">
          <?php
          include_once 'conex.php';
          $cnx = pg_connect($strCnx) or die ("Error de Conexion. ".pg_last_error());

          $desp = "SELECT privil FROM public.privilegio";
          $lis = pg_query($desp);
          if ($_POST) {
          if ($_POST["Enviar1"]) {
          $nomus2 = $_POST["nombreusuario2"];
          $pass = $_POST["contraseña"];
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
              $resublt2 =pg_query($cnx, "INSERT INTO public.usuarios (nombreuser, contraseña, privilegio) VALUES('$nomus2', '$encripass', 2);");
              echo"<script>alert('Registro Agregado Correctamente')</script>";
            }
        }
         }
           ?>
            <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
              <label class="ontrol-label col-md-4 col-sm-3 col-xs-12" for="last-name">Nombre de Usuario <span class="required"></span>
              </label>
              <div class="col-md-12 col-sm-6 col-xs-12">
                <input type="text" id="nombreusuario2" name="nombreusuario2" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Contraseña <span class="required"></span>
              </label>
              <div class="col-md-12 col-sm-6 col-xs-12">
                <input type="password" id="contraseña" name="contraseña" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
              </label>
              <div class="col-md-12 col-sm-9 col-xs-12">
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <input type="submit" class="btn btn-success" name="Enviar1" id="Enviar1">
                <button onclick='limpiar2()' class="btn btn-success">Limpiar</button>
                </div>
              </div>
              <?php
              pg_close($cnx)
              ?>
              <script language=javascript>
              function limpiar2(){
                document.getElementById('nombreusuario2').value = "";
                document.getElementById('contraseña').value = "";
                document.getElementById('privilegio').value = "";
              }
            </script>
            </form>
        </div>
      </div>
    </div>
		</section>



        <!--
        End Features
        ==================================== -->	<!-- Essential jQuery Plugins
		================================================== -->
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
		<!-- Contact form validation -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
		<!-- jquery easing -->
        <script src="js/jquery.easing.min.js"></script>
		<!-- jquery easing -->
        <script src="js/wow.min.js"></script>
		<script>
			var wow = new WOW ({
				boxClass:     'wow',      // animated element css class (default is wow)
				animateClass: 'animated', // animation css class (default is animated)
				offset:       120,          // distance to the element when triggering the animation (default is 0)
				mobile:       false,       // trigger animations on mobile devices (default is true)
				live:         true        // act on asynchronously loaded content (default is true)
			  }
			);
			wow.init();
		</script>
		<!-- Custom Functions -->
        <script src="js/custom.js"></script>

		<script type="text/javascript">

		</script>
    </body>
</html>
