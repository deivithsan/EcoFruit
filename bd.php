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
                        <li class="current"><a href="#body">Inicio</a></li>
                        <li><a href="#features">Frutas</a></li>
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
							<h2 data-wow-duration="700ms" data-wow-delay="500ms" class="wow bounceInDown animated">InfoFruit</span>!</h2>
							<h3 data-wow-duration="1000ms" class="wow slideInLeft animated"><span class="color">Venta eficaz, rapida y total de la fruta sobrante en su cosecha</span> </h3>
							<p data-wow-duration="1000ms" class="wow slideInRight animated">No se deben perder las frutas que sobran!</p>

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
        <section id="features" class="features"
			<div class="container">
				<div class="row">

					<div class="sec-title text-center mb50 wow bounceInDown animated" data-wow-duration="500ms">
						<h2>Frutas Disponibles para la Compra</h2>
						<div class="devider"></div>
					</div>

					<!-- service item -->
          <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
          </div>

					<div class="col-md-4 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
						<div class="service-item">
							<div class="service-desc">
                <?php
  $host = 'localhost';
  $user = 'postgres';
  $passwd = 'liz6625382';
  $db = 'postgres';
  $port = '5432';
  $strCnx = "host=$host port=$port dbname=$db user=$user password=$passwd sslmode='allow'" ;
  $cnx = pg_connect($strCnx) or die (print "Error de conexion.");
  $sql = "SELECT * from public.frutas ORDER BY idfrut";
  $rs = pg_query($cnx, $sql );
  $ok = true;
if ($rs) {
  if (pg_num_rows($rs)>0) {
    ?>
    <?php
    while ($obj = pg_fetch_object($rs)) {
      ?>
      <table border="2px" class= "table" >
           <tr>
              <td>Id Fruta</td>
              <td>Nombre</td>
              <td>Cantidad</td>
              <td>Lugar</td>
              <td>Vendedor</td>
              <td>Fecha y hora finalizacion</td>
          </tr>
          <tr>
              <td><?php echo $obj->idfrut ?></td>
              <td><?php echo $obj->nombre ?></td>
              <td><?php echo $obj->cantidad ?></td>
              <td><?php echo $obj->lugar ?></td>
              <td><?php echo $obj->vendedor ?></td>
              <td><?php echo $obj->fechahora ?></td>
          </tr>
        </table>
      <?php
      }
  }
    else {
      echo "<p>No hay frutas disponibles para la compra</p>";
    }

}
  else {
    $ok = false;
    return $ok;
  }

?>
							</div>
						</div>
					</div>
					<!-- end service item -->
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
			$(function(){
      }
		</script>
    </body>
</html>
