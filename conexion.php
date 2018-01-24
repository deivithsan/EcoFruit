<?php
define('NOMBRE_SERVIDOR','ec2-54-243-200-159.compute-1.amazonaws.com');
define('NOMBRE_USUARIO','ithxzpubsdyssh');
define('PASSWORD','yzRs8R1aJkymNawqYGJkS_4ySJ');
define('BASE_DE_DATOS','d3q71k9f5t7k2c');
date_default_timezone_set('America/Bogota');

class Conexion{
    private $conexion;
    private $x;

    public function __construct()
    {
        $this->conexion = new PDO('pgsql:host=' .NOMBRE_SERVIDOR. '; dbname=' .BASE_DE_DATOS, NOMBRE_USUARIO, PASSWORD);
        $this->x=array();
    }


    public function obtenerConexion(){
        if (isset($conexion)){
            echo "Conexión Establecida";
        }
        else{
            echo "No se pudo conectar a la BD";
        }
    }

    public function get_mensajes(){
        $sql="select * from mensajes";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $this->conexion=null;
        return $this->x;
    }

    public function get_Compradores(){
        $comp=$this->conexion->prepare('select tipousuario from usuarios where tipousuario = 3 OR tipousuario = 4');
        $comp->execute();
        $fetch = $comp->fetchAll();
        $rows = count($fetch);
        return $rows;
    }

    public function get_Vendedores(){
        $vend=$this->conexion->prepare('select tipousuario from usuarios where tipousuario = 2 OR tipousuario = 4');
        $vend->execute();
        $fetch = $vend->fetchAll();
        $rows = count($fetch);
        return $rows;
    }

    public function get_Frutas(){
        $frutas=$this->conexion->prepare("select * from productos where estado='Activo'");
        $frutas->execute();
        $fetch = $frutas->fetchAll();
        $rows = count($fetch);
        return $rows;
    }

    public function get_Compras(){
        $compras=$this->conexion->prepare('select * from compra');
        $compras->execute();
        $fetch = $compras->fetchAll();
        $rows = count($fetch);
        $this->conexion = null;
        return $rows;
    }

    public function enviarComentario(){

        $fecha = date( "Y/m/d", time() );
        $time = strftime( "%H:%M:%S", time() );
        $sql="insert into mensajes VALUES (default, ?,?,?,?,?);";
        $envio=$this->conexion->prepare($sql);

        $Dia = strip_tags($fecha);
        $hora = strip_tags($time);

        $envio->bindValue(1, $_POST["name"], PDO::PARAM_STR);
        $envio->bindValue(2, $_POST["tel"], PDO::PARAM_STR);
        $envio->bindValue(3, $_POST["message"], PDO::PARAM_STR);
        $envio->bindValue(4, $Dia, PDO::PARAM_STR);
        $envio->bindValue(5, $hora, PDO::PARAM_STR);

        $envio->execute();
        $this->conexion = null;

        echo"<script>alert('Mensaje enviado correctamente')</script>";
        echo"<script type=\"text/javascript\">window.location='index.php'</script>";
    }

    public function login(){
        $nom = $_POST["nomusuario"];
        $password = $_POST["pass"];
        $pasencrip = md5($password);

        $sql = "SELECT nombreuser,contraseña FROM usuarios WHERE nombreuser='$nom' and contraseña ='$pasencrip'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        if ($datos[0]["nombreuser"] == $nom && $datos[0]["contraseña"] == $pasencrip){
            $_SESSION["user"]=$nom;
            $sqlpriv = "SELECT tipousuario FROM usuarios WHERE nombreuser = '$nom'";
            foreach ($this->conexion->query($sqlpriv) as $row2){
                $this->y[]=$row2;
            }
            $datos2 = $this->y;
            $_SESSION["privil"] = $datos2[0]["tipousuario"];
            if ($_SESSION["privil"] == 1){
                header('Location: production/index.php');
            }elseif ($_SESSION["privil"] == 2 or 3 or 4){
                header('Location: index.php');
            }
        }else{
            echo"<script>alert('Datos ingresados incorrectos.')</script>";
            echo"<script type=\"text/javascript\">window.location='index.php'</script>";
        }
    }

    public function get_NombreApellido(){
        $nom = $_SESSION["user"];
        $sql="select nombre, apellido from infousuarios where nombreuser = '$nom'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $nombre= $datos[0][0];
        $apellido = $datos[0][1];
        $nombreyapellido = $nombre.$apellido;
        unset($this->x);
        return $nombreyapellido;
    }

    public function get_ListaProductos(){
        $productos=$this->conexion->prepare("SELECT * FROM productos ORDER BY idprod");
        $productos->execute();
        $fetch = $productos->fetchAll();
        $rows = count($fetch);
        if ($rows == 0){
            echo"<script>alert('Se presentan problemas con los productos disponibles')</script>";
            echo"<script type=\"text/javascript\">window.location='index.php'</script>";
        } else{
            $sql2="SELECT * FROM productos ORDER BY idprod";
            foreach ($this->conexion->query($sql2) as $row){
                $this->x[]=$row;
            }
            $datos = $this->x;
            unset($this->x);
            return $datos;
        }
    }

    public function get_Id(){
        $idproduc = $_POST["idprod"];
        $id=$this->conexion->prepare("SELECT idprod FROM productos");
        $id->execute();
        while ($fetch = $id->fetchColumn()){
            if ($fetch == $idproduc){
                $sql ="SELECT * from productos where idprod ='$idproduc'";
                foreach ($this->conexion->query($sql) as $row){
                    $this->x[]=$row;
                }
                $datos = $this->x;
                unset($this->x);
                return $datos;
            }
        }
    }

    public function make_Buy(){
        $nom = $_SESSION["user"];
        $iddelproductocompra = $_POST["idproduc"];
        $idpr = (int) $iddelproductocompra;
        $nomprod = $_POST["nomprod"];
        $est = $_POST["est"];
        $cantidaddisp = $_POST["cant"];
        $costounitario = $_POST["costo"];
        $cantidadcomp = $_POST["cantbuy"];
        $vendedor = $_POST["vendedor"];
        $sql="select cedula from infousuarios where nombreuser='$nom'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $numerocedula = $datos[0][0];
        $sql2="select telefono from infousuarios where nombreuser='$nom'";
        foreach ($this->conexion->query($sql2) as $row2){
            $this->y[]=$row2;
        }
        $datos2 = $this->y;
        $numerocelular = $datos2[0][0];
        $cantdis = (int) $cantidaddisp;
        $costun = (int) $costounitario;
        $cantbuy = (int) $cantidadcomp;
        $numced = (int) $numerocedula;
        $telef = (int) $numerocelular;
        $sql="insert into compra VALUES (DEFAULT , ?,?,?,?,?,?,?,?,?,?,DEFAULT , DEFAULT );";
        $envio=$this->conexion->prepare($sql);

        $idProd = strip_tags($idpr);
        $nomProd = strip_tags($nomprod);
        $estProd = strip_tags($est);
        $cantProdDisp = strip_tags($cantdis);
        $costProd = strip_tags($costun);
        $cantComp = strip_tags($cantbuy);
        $numCed = strip_tags($numced);
        $numCel = strip_tags($telef);
        $vend = strip_tags($vendedor);
        $comp = strip_tags($nom);

        $envio->bindValue(1, $idProd, PDO::PARAM_STR);
        $envio->bindValue(2, $nomProd, PDO::PARAM_STR);
        $envio->bindValue(3, $estProd, PDO::PARAM_STR);
        $envio->bindValue(4, $cantProdDisp, PDO::PARAM_STR);
        $envio->bindValue(5, $costProd, PDO::PARAM_STR);
        $envio->bindValue(6, $cantComp, PDO::PARAM_STR);
        $envio->bindValue(7, $numCed, PDO::PARAM_STR);
        $envio->bindValue(8, $numCel, PDO::PARAM_STR);
        $envio->bindValue(9, $vend, PDO::PARAM_STR);
        $envio->bindValue(10, $comp, PDO::PARAM_STR);

        $envio->execute();
        $this->conexion = null;

        echo"<script>alert('Compra Realizada correctamente! Recuerda comunicarte con uno de nuestros administradores para iniciar el proceso de compra, Gracias!!')</script>";
        echo"<script type=\"text/javascript\">window.location='bd.php'</script>";
    }

    public function get_Usuarios(){
        $users=$this->conexion->prepare("select infousuarios.nombre, infousuarios.apellido, infousuarios.direccion, usuarios.tipousuario, infousuarios.nombreuser from infousuarios, usuarios where usuarios.nombreuser = infousuarios.nombreuser and (usuarios.tipousuario = 2 or usuarios.tipousuario = 4) order by infousuarios.nombre");
        $users->execute();
        while ($fetch = $users->fetchAll()){
            $rows1 = count($fetch);
            for ($i=0; $i<$rows1; $i++){
                $nomUser= $fetch[$i][4];
                $nombre= $fetch[$i][0];
                $apellido= $fetch[$i][1];
                $direccion= $fetch[$i][2];
                $val=$this->get_SelectUsuarios($nomUser);
                ?>
                <figure class="team-member col-md-3 col-sm-6 col-xs-12 text-center fa-border">
                    <div class="member-thumb">
                        <h5>Nombre:</h5>
                        <p><?php echo $nombre." ".$apellido?></p>
                        <h5>Ubicación:</h5>
                        <p><?php echo $direccion?></p>
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
            <?php
            }
        }
    }

    public function get_SelectUsuarios($nomusuario){
        $vend=$this->conexion->prepare("select vendedorprod, valoracion from compra where vendedorprod = '$nomusuario'");
        $vend->execute();
        $fetch = $vend->fetchAll();
        $rows = count($fetch);
        if ($rows == 0){
            $val = 0;
            return $val;
        } elseif ($rows == 1){
            $val = $fetch[0][1];
            return $val;
        } elseif ($rows >= 2) {
            $sql ="select sum(valoracion) as promedio from compra where vendedorprod = '$nomusuario'";
            foreach ($this->conexion->query($sql) as $row){
                $this->x[]=$row;
            }
            $datos = $this->x;
            $z = $datos[0][0];
            $valoracion = $z/$rows ;
            $val = round($valoracion);
            return $val;
        }
        $this->conexion = null;
    }

    public function get_TiposUsers(){
        $sql="select nombretipousuario, privilegio from tipousuarios where privilegio != 1";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }

    public function make_Registro(){
        $nomus2 = $_POST["nombreusuario2"];
        $pass = $_POST["contraseña"];
        $tipoprod = $_POST["tiposlist"];
        $privilegio = 2;
        $vend=$this->conexion->prepare("select idtipousuario from tipousuarios where nombretipousuario = '$tipoprod'");
        $vend->execute();
        $fetch = $vend->fetchAll();
        $idtipouser = $fetch[0][0];
        $encripass = md5($pass);
        $val =$this->validate_nomUser($nomus2);
        if ($val == 0) {
            $this->make_SubirRegistro($nomus2,$encripass,$privilegio,$idtipouser);
        }
    }

    public function validate_nomUser($nombre){
        $sql="SELECT nombreuser from usuarios";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        for ($i=0; $i<sizeof($datos); $i++){
            if ($datos[$i][0] == $nombre){
                echo "<script>alert('El nombre de usuario ya existe')</script>";
                return $val = 1;
            }
        }
        return $val = 0;
    }

    public function make_SubirRegistro($nomus2,$encripass,$privilegio,$idtipouser){
        $sql="insert into usuarios VALUES (?,?,?,?);";
        $envio=$this->conexion->prepare($sql);

        $nombre = strip_tags($nomus2);
        $contraseña = strip_tags($encripass);
        $priv = strip_tags($privilegio);
        $idTipUser = strip_tags($idtipouser);

        $envio->bindValue(1, $nombre, PDO::PARAM_STR);
        $envio->bindValue(2, $contraseña, PDO::PARAM_STR);
        $envio->bindValue(3, $priv, PDO::PARAM_STR);
        $envio->bindValue(4, $idTipUser, PDO::PARAM_STR);

        $envio->execute();
        $this->conexion = null;
        echo"<script>alert('Usuario Agregado Correctamente')</script>";
        echo"<script type=\"text/javascript\">window.location='registro.php'</script>";
    }
}
?>