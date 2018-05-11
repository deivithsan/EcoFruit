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
    }elseif ($priv == 3 or 4 ){
        $on = 1;
    }
}

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Precios Corabastos</title>
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
                    <h2>Precios Actuales en Corabastos</h2>
                    <div class="devider"><i class="fa fa-line-chart fa-lg"></i></div>
                </div>
                <div class="col-md-12 col-sm-3 col-xs-3">
                    <center>
                        <h4>Por favor espere un momento mientras carga el archivo, gracias.</h4>
                        <object data="http://www.corabastos.com.co/sitio/historicoApp2/reportes/BoletinDescarga.php" type="application/pdf">
                        <embed src="http://www.corabastos.com.co/sitio/historicoApp2/reportes/BoletinDescarga.php" type="application/pdf" width="100%" height="100%"/>
                        </object>
                    </center>
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
<script type="text/javascript">
</script>
</body>
</html>