<?php
    session_start();
    require_once "conexion.php";
    $conex = new Conexion();
    $admin = new Admin();
    global $on;

    if (isset($_SESSION['user'])) {
        global $priv, $nom;
        $priv = $_SESSION['privil'];
        $nom = $_SESSION['user'];
        if ($nom == 'dei') {
            $on = 2;
        } elseif ($priv == 1) {
            echo '<script> window.location="production/index"; </script>';
        } elseif ($priv == 2 or 3 or 4) {
            $on = 1;
        }
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Modificar Producto</title>
    <link rel="shortcut icon" href="img/icono.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/media-queries.css">
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
                <form class="nav navbar-form navbar-left" role="search" action="index">
                    <button onclick='index' class="btn btn-success"><i class="fa fa-home fa-lg"></i></button>
                </form>
                <form class="nav navbar-form navbar-left" role="search" action="logout">
                    <button onclick='logout' class="btn btn-success">Cerrar Sesión</button>
                </form>
                <?php }elseif ($on == 2){
                    echo "<a>Bienvenido Admin: ",$nom;
                        ?>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    <li><a></a></li>
                    </ul>
                    <form class="nav navbar-form navbar-left" role="search" action="production/index">
                        <button onclick='production/index' class="btn btn-success"><i class="fa fa-home fa-lg"></i></button>
                    </form>
                    <form class="nav navbar-form navbar-left" role="search" action="logout">
                        <button onclick='logout' class="btn btn-success">Cerrar Sesión</button>
                    </form>
                <?php
                }echo "</ul>"?>
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
            <?php
            if ($on == 0){
                ?>
            <div class="sec-title text-center mb50 wow bounceInDown a  nimated" data-wow-duration="500ms">
                <h2>Registrate!</h2>
                <div class="devider"></div>
            </div>
            <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                <form class="form-horizontal" method="post">
                    <?php
                    $tiposUser = $conex->get_userRegistro();
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
                                    <option value="<?php  echo $tiposUser[$i]["idtipousuario"] ?>"><?php  echo $tiposUser[$i]["nombretipousuario"]; ?></option>
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
            } elseif ($on == 1) {
                ?>
                    <div class="row">
                        <div class="sec-title text-center mb50 wow bounceInDown a  nimated" data-wow-duration="500ms">
                            <h2>Modificar Producto</h2>
                            <div class="devider"></div>
                        </div>
                        <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
                        </div>
                        <div class="col-md-4 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                            <form class="form-horizontal" method="post">
                                <?php
                                if ($_POST) {
                                    if ($_POST["Enviar1"]) {
                                        $admin->update_ProductosVend($_GET['id']);
                                    }
                                }
                                $productos = $admin->get_LlenarFormProd($_GET['id']);
                                ?>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name"> Nombre del Producto <span class="required"></span>
                                    </center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" id="nomprod" name="nomprod" required="required"
                                               class="form-control col-md-7 col-xs-12"
                                               class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $productos[0][1]; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name">Cantidad Disponible</center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="number" id="cant" name="cant" required
                                               class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $productos[0][3]; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name"> Costo por Unidad</center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="number" id="costo" name="costo" required
                                               class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $productos[0][4]; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name"> Costo Total</center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="number" id="venta" name="venta" required
                                               class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $productos[0][5]; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-9 col-xs-12 form-group has-feedback">
                                    <center><label for="last-name"> Fecha de Cierre</center>
                                    </label>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <input type="date" id="fechaF" name="fechaF" required
                                               class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $productos[0][8]; ?>">
                                    </div>
                                </div>
                                <center>
                                    <input type="submit" class="btn btn-success" name="Enviar1" id="Enviar1" value="Guardar">
                                </center>
                        </div>
                        </form>
                    </div>
                <?php
            }
        ?>
    </div>
    </div>
</section>
<h5 align="center"><i>2018 - EcoFruit</i></h5>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.singlePageNav.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.mixitup.min.js"></script>
<script src="js/jquery.parallax-1.1.3.js"></script>
<script src="js/jquery-countTo.js"></script>
<script src="js/jquery.appear.js"></script>
<script src="js/jquery.easing.min.js"></script>
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
<script src="js/custom.js"></script>
<script type="text/javascript">
</script>
</body>
</html>