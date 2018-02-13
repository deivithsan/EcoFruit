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
            echo '<script> window.location="production/index.php"; </script>';
        }elseif ($priv == 2 or 3 or 4 ){
            $on = 1;
        }
    }
?>
<!DOCTYPE html>
<head>
    <!-- meta charec set -->
    <meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- Page Title -->
    <title>Registro</title>
    <link rel="shortcut icon" href="img/icono.ico">

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
                    <li><a href="#features">Registro</a></li>
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
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><?php if ($on == 1){
                        echo "<a>$nom";?>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                </ul>
                <form class="nav navbar-form navbar-left" role="search" action="index.php">
                    <button onclick='index.php' class="btn btn-success"><i class="fa fa-home fa-lg"></i></button>
                </form>
                <form class="nav navbar-form navbar-left" role="search" action="logout.php">
                    <button onclick='logout.php' class="btn btn-success">Cerrar Sesión</button>
                </form>
                <?php }else echo "</ul>"?>
            </nav>
        </div>
</header>
<!--
End Fixed Navigation
==================================== --><!--
        Home Slider
        ==================================== -->

<section id="slider">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

            <!-- single slide -->
            <div class="item active" style="background-image: url(img/log3.png);">
                <div class="carousel-caption">
                    <h2 data-wow-duration="700ms" data-wow-delay="500ms" class="wow bounceInDown animated" style="color: white;"><span>EcoFruit!</span></h2>
                    <h3 data-wow-duration="1000ms" class="wow slideInLeft animated"><span class="color">Venta eficaz, rapida y total de la fruta en su cosecha</span> </h3>
                    <ul class="social-links text-center">
                        <li><i class="fa fa-twitter fa-lg"></i></li>
                        <li><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                        <li><i class="fa fa-facebook fa-lg"></i></li>
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

            <?php
            if ($on == 0){
                ?>
            <div class="sec-title text-center mb50 wow bounceInDown a  nimated" data-wow-duration="500ms">
                <h2>Registrate!</h2>
                <div class="devider"></div>
            </div>

            <!-- service item -->

            <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
            </div>

            <div class="col-md-4 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                <!-- Formulario -->

                <form class="form-horizontal" method="post">
                    <?php
                    $tiposUser = $conex->get_TiposUsers();
                    if ($_POST) {
                        if ($_POST["Enviar1"]) {
                            $conex->make_Registro();
                            $conex->login();
                        }
                    }
                    ?>
                    <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                        <center><label for="last-name">  Nombre de Usuario <span class="required"></span></center>
                        </label>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <input type="text" name=nomusuario id='nomusuario' required class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                        <center><label for="last-name">  Contraseña <span class="required"></span></center>
                        </label>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <input type="password" name=pass id='pass' required class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                        <center><label for="last-name"> ¿Qué eres? <span class="required"></span></center>
                        </label>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <center>
                            <select name="tiposlist">
                                <?php
                                for ($i=0; $i<sizeof($tiposUser); $i++){
                                    ?>
                                    <option value="<?php  echo $tiposUser[$i]["nombretipousuario"] ?>"><?php  echo $tiposUser[$i]["nombretipousuario"]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            </center>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-12 col-sm-9 col-xs-12">
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <input type="submit" class="btn btn-success" name="Enviar1" id="Enviar1" value="Registrar">
                                <button onclick='limpiar2()' class="btn btn-success">Limpiar</button>
                            </div>
                        </div>
                        <script language=javascript>
                            function limpiar2(){
                                document.getElementById('nomusuario').value = "";
                                document.getElementById('pass').value = "";
                                document.getElementById('privilegio').value = "";
                            }
                        </script>
                </form>
            </div>
        </div>

                <?php
            } else {

                ?>
                    <div class="row">

                        <div class="sec-title text-center mb50 wow bounceInDown a  nimated" data-wow-duration="500ms">
                            <h2>Modifique su información personal</h2>
                            <div class="devider"></div>
                        </div>

                        <!-- service item -->

                        <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
                        </div>

                        <div class="col-md-4 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                            <!-- Formulario -->

                            <form class="form-horizontal" method="post">
                                <?php
                                if ($_POST) {
                                    if ($_POST["Enviar1"]) {
                                        $conex->update_InfoUsers();
                                    }
                                }

                                $nombre = $conex->get_Nombre();
                                $apellido = $conex->get_Apellido();
                                $correo = $conex->get_Correo();
                                $telefono = $conex->get_Tel();
                                $dir = $conex->get_Dir();
                                $numCC = $conex->get_NumCC();
                                ?>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name">  Nombre de Usuario <span class="required"></span></center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" id="nombreusuario" name="nombreusuario" required="required" class="form-control col-md-7 col-xs-12" style="display:none"  value="<?php echo $nom; ?>">
                                        <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $nom; ?>" DISABLED>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name">Nombre</center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" id="nombre" name="nombre" required class="form-control col-md-7 col-xs-12" value="<?php echo $nombre; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name">  Apellidos </center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" id="apellidos" name="apellidos" required class="form-control col-md-7 col-xs-12" value="<?php echo $apellido; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name">  Correo Electronico </center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" id="email" name="email" required class="form-control col-md-7 col-xs-12" value="<?php echo $correo;?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name">  Telefono </center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="number" id="tel" name="tel" required class="form-control col-md-7 col-xs-12" value="<?php echo $telefono;?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name">  Dirección </center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" id="dir" name="dir" required class="form-control col-md-7 col-xs-12" value="<?php echo $dir;?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name">  Número de Cedula </center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="number" id="numcc" name="numcc" required class="form-control col-md-7 col-xs-12" value="<?php echo $numCC;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-12 col-sm-9 col-xs-12">
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <input type="submit" class="btn btn-success" name="Enviar1" id="Enviar1" value="Guardar">
                                            <button onclick='limpiar2()' class="btn btn-success">Limpiar</button>
                                        </div>
                                    </div>
                                    <script language=javascript>
                                        function limpiar2(){
                                            document.getElementById('nombre').value = "";
                                            document.getElementById('apellidos').value = "";
                                            document.getElementById('email').value = "";
                                            document.getElementById('tel').value = "";
                                            document.getElementById('dir').value = "";
                                            document.getElementById('numcc').value = "";
                                        }
                                    </script>
                            </form>

                        </div>

                    </div>

                    <?php
                }
            ?>
    </div>

</section>
<h5 align="center"><i>2018 - EcoFruit</i></h5>


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