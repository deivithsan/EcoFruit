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
        $frutas=$this->conexion->prepare("select * from productos where estado='En Cola'");
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
        echo"<script type=\"text/javascript\">window.location='index'</script>";
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
                $admin = new Admin();
                $info = "Inicio de Sesión";
                $admin->create_log($nom,$info,$i = null);
                header('Location: production/index');
            }elseif ($_SESSION["privil"] == 2 or 3 or 4){
                header('Location: index');
            }
        }else{
            echo"<script>alert('Datos ingresados incorrectos.')</script>";
            echo"<script type=\"text/javascript\">window.location='index'</script>";
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

    public function get_Nombre(){
        $nom = $_SESSION["user"];
        $sql="select nombre from infousuarios where nombreuser = '$nom'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $nombre= $datos[0][0];
        unset($this->x);
        return $nombre;
    }

    public function get_Apellido(){
        $nom = $_SESSION["user"];
        $sql="select apellido from infousuarios where nombreuser = '$nom'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $apellido= $datos[0][0];
        unset($this->x);
        return $apellido;
    }

    public function get_Correo(){
        $nom = $_SESSION["user"];
        $sql="select correo from infousuarios where nombreuser = '$nom'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $correo= $datos[0][0];
        unset($this->x);
        return $correo;
    }

    public function get_Tel(){
        $nom = $_SESSION["user"];
        $sql="select telefono from infousuarios where nombreuser = '$nom'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $telefono= $datos[0][0];
        unset($this->x);
        return $telefono;
    }

    public function get_Dir(){
        $nom = $_SESSION["user"];
        $sql="select direccion from infousuarios where nombreuser = '$nom'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $dir= $datos[0][0];
        unset($this->x);
        return $dir;
    }

    public function get_NumCC(){
        $nom = $_SESSION["user"];
        $sql="select cedula from infousuarios where nombreuser = '$nom'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $numCC= $datos[0][0];
        return $numCC;
    }

    public function get_ListaProductos(){
        $productos=$this->conexion->prepare("SELECT * FROM productos ORDER BY idprod");
        $productos->execute();
        $fetch = $productos->fetchAll();
        $rows = count($fetch);
        if ($rows == 0){
            echo"<script>alert('Se presentan problemas con los productos disponibles')</script>";
            echo"<script type=\"text/javascript\">window.location='index'</script>";
        } else{
            $sql2="select productos.idprod, productos.nombre, tipoprod.nombretipo, productos.estado, productos.cantidad, productos.costo, productos.venta, productos.ubicacion, productos.vendedor from productos, tipoprod where productos.tipo = tipoprod.idtipo order by idprod";
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
        echo "<script>alert('No existe un producto con ese id, intente nuevamente por favor')</script>";
        echo"<script type=\"text/javascript\">window.location='bd'</script>";
    }

    public function make_Buy(){

        $fecha = date( "Y/m/d", time() );
        $time = strftime( "%H:%M:%S", time() );
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
        $cantidadFinal = $cantdis - $cantbuy;

        if ($cantbuy > $cantdis ){
            $this->conexion = null;
            echo"<script>alert('No se pueden realizar compras mayores a la cantidad disponible actualmente, intente con una cantidad menor por favor.')</script>";
            echo"<script type=\"text/javascript\">window.location='bd'</script>";
        }

        $sql="insert into compra VALUES (DEFAULT , ?,?,?,?,?,?,?,?,?,?,DEFAULT , DEFAULT, ?,? );";
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
        $Dia = strip_tags($fecha);
        $hora = strip_tags($time);

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
        $envio->bindValue(11, $Dia, PDO::PARAM_STR);
        $envio->bindValue(12, $hora, PDO::PARAM_STR);

        $envio->execute();
        unset($this->x);

        $this->make_restaBD($cantidadFinal, $idpr);
        echo"<script>alert('Compra Realizada correctamente! Recuerda comunicarte con uno de nuestros administradores para iniciar el proceso de compra, Gracias!!')</script>";
        echo"<script type=\"text/javascript\">window.location='bd'</script>";
    }

    public function make_restaBD($valor, $id){

        $sql = "UPDATE productos set cantidad=? WHERE idprod=$id";
        $envio = $this->conexion->prepare($sql);

        $can = strip_tags($valor);

        $envio->bindValue(1, $can, PDO::PARAM_STR);

        $envio->execute();

        $this->conexion = null;

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
        $vend=$this->conexion->prepare("select vendedorprod, valoracion from compra where vendedorprod = '$nomusuario' and valoracion > 0");
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
        $nomus2 = $_POST["nomusuario"];
        $pass = $_POST["pass"];
        $tipoprod = $_POST["tiposlist"];
        $privilegio = 2;
        $vend=$this->conexion->prepare("select idtipousuario from tipousuarios where nombretipousuario = '$tipoprod'");
        $vend->execute();
        $fetch = $vend->fetchAll();
        $idtipouser = $fetch[0][0];
        $encripass = md5($pass);
        unset($this->x);
        $val =$this->validate_nomUser($nomus2);
        if ($val == 0) {
            $this->make_SubirRegistro($nomus2,$encripass,$privilegio,$idtipouser);
        }
        if ($val == 1){
            echo"<script type=\"text/javascript\">window.location='registro'</script>";
        }
    }

    public function create_AdminUser(){
        $nombre = $_POST["nomusuario"];
        $pass = $_POST["pass"];
        $encripass = md5($pass);
        $validate = $this->validate_nomUser($nombre);
        if ($validate == 0){
            $sql="insert into usuarios VALUES (?,?,1,1);";
            $envio=$this->conexion->prepare($sql);

            $nomAdmin = strip_tags($nombre);
            $contraseña = strip_tags($encripass);

            $envio->bindValue(1, $nomAdmin, PDO::PARAM_STR);
            $envio->bindValue(2, $contraseña, PDO::PARAM_STR);

            $envio->execute();
            unset($this->x);
            $this->create_NewInfoUser($nombre);
            echo '<script>alert("Creado el administrador: '.$nombre.', Deivith." )</script>';
            echo"<script type=\"text/javascript\">window.location='index'</script>";
        }
        if ($validate == 1){
            echo"<script type=\"text/javascript\">window.location='registro'</script>";

        }
    }

    public function update_InfoUsers(){
        $nameuser =$_POST["nombreusuario"];
        $name = $_POST["nombre"];
        $apell = $_POST["apellidos"];
        $email = $_POST["email"];
        $numerotel = $_POST["tel"];
        $dir = $_POST["dir"];
        $cedul = $_POST["numcc"];

        $sql = "UPDATE infousuarios set nombre=?, apellido=?, correo=?, telefono=?, direccion=?, cedula=? WHERE nombreuser='$nameuser'";
        $envio = $this->conexion->prepare($sql);

        $nombre = strip_tags($name);
        $apellido = strip_tags($apell);
        $correo = strip_tags($email);
        $telefono = strip_tags($numerotel);
        $direccion = strip_tags($dir);
        $cedula = strip_tags($cedul);

        $envio->bindValue(1, $nombre, PDO::PARAM_STR);
        $envio->bindValue(2, $apellido, PDO::PARAM_STR);
        $envio->bindValue(3, $correo, PDO::PARAM_STR);
        $envio->bindValue(4, $telefono, PDO::PARAM_STR);
        $envio->bindValue(5, $direccion, PDO::PARAM_STR);
        $envio->bindValue(6, $cedula, PDO::PARAM_STR);

        $envio->execute();
        $this->conexion = null;

        echo "<script>alert('Información actualizada correctamente.')</script>";
        echo "<script type=\"text/javascript\">window.location='registro'</script>";
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
        unset($this->x);
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
        $this->create_NewInfoUser($nombre);
        echo '<script>alert("Bienvenido a EcoFruit usuario '.$nombre.', le agradecemos hacer parte de este gran proyecto, " +
        "recuerde modificar su infomación en el link que se encuentra junto a cerrar sesion en el panel superior. Gracias." )</script>';
        unset($this->x);
        echo"<script type=\"text/javascript\">window.location='index'</script>";
    }

    public function create_NewInfoUser($nomUser){
        $sql="insert into infousuarios VALUES (DEFAULT ,?, 0 , 0 , 0 , 0 , 0 , 0 );";
        $envio=$this->conexion->prepare($sql);

        $nombre = strip_tags($nomUser);

        $envio->bindValue(1, $nombre, PDO::PARAM_STR);

        $envio->execute();
        unset($this->x);
    }
}

class Admin{
    private $conexion;
    private $x;

    public function __construct()
    {
        $this->conexion = new PDO('pgsql:host=' .NOMBRE_SERVIDOR. '; dbname=' .BASE_DE_DATOS, NOMBRE_USUARIO, PASSWORD);
        $this->x=array();
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
        $nombreyapellido = "$nombre $apellido";
        unset($this->x);
        return $nombreyapellido;
    }

    public function get_UsersNoInfo(){

        $sql="SELECT  nombreuser FROM usuarios WHERE NOT nombreuser IN (SELECT nombreuser FROM infousuarios)";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        if($datos == null){
            $datos = 0;
        }
        unset($this->x);
        return $datos;

    }

    public function make_InfoUser(){
        $nomus = $_POST["nombreusuario"];
        $name = $_POST["nombre"];
        $apell = $_POST["apellido"];
        $email = $_POST["correo"];
        $numerotel = $_POST["telefono"];
        $dir = $_POST["direccion"];
        $cedul = $_POST["cedula"];
        $dat = 0;
        $sql2="SELECT nombreuser from usuarios";
        foreach ($this->conexion->query($sql2) as $row2){
            $this->y[]=$row2;
        }
        $datos2 = $this->y;
        for ($i=0; $i<sizeof($datos2); $i++) {
            if ($datos2[$i][0] == $nomus) {
                $this->validar_NombreUsuarioInfo($nomus);
                $sql="insert into infousuarios VALUES (DEFAULT,?,?,?,?,?,?,?);";
                $envio=$this->conexion->prepare($sql);

                $nomUser = strip_tags($nomus);
                $nom = strip_tags($name);
                $ape = strip_tags($apell);
                $correo = strip_tags($email);
                $movil = strip_tags($numerotel);
                $direccion = strip_tags($dir);
                $CC = strip_tags($cedul);

                $envio->bindValue(1, $nomUser, PDO::PARAM_STR);
                $envio->bindValue(2, $nom, PDO::PARAM_STR);
                $envio->bindValue(3, $ape, PDO::PARAM_STR);
                $envio->bindValue(4, $correo, PDO::PARAM_STR);
                $envio->bindValue(5, $movil, PDO::PARAM_STR);
                $envio->bindValue(6, $direccion, PDO::PARAM_STR);
                $envio->bindValue(7, $CC, PDO::PARAM_STR);

                $envio->execute();
                $this->conexion = null;
                echo"<script>alert('Información agregada correctamente')</script>";
                echo"<script type=\"text/javascript\">window.location='form'</script>";

            } else{
                $val = 0;
            }
        }
        if ($val == 0){
                echo"<script>alert('Ese nombre de usuario no existe, por favor verifique los datos ingresados.')</script>";
                echo"<script type=\"text/javascript\">window.location='form'</script>";
                exit;
        }


    }

    public function validar_NombreUsuarioInfo($nombreUser){
        $sql="SELECT nombreuser from infousuarios";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        for ($i=0; $i<sizeof($datos); $i++) {
            if ($datos[$i][0] == $nombreUser){
                echo"<script>alert('Ese usario ya dispone de información, si desea modificarla acceda a la parte de modificar datos, opción Información de Usuarios.')</script>";
                echo"<script type=\"text/javascript\">window.location='form'</script>";
                exit;
            }
        }
    }

    public function get_TipoProducto(){
        $sql="SELECT idtipo, nombretipo, estado from tipoprod ORDER BY nombretipo";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }

    public function get_EstadosProd(){
        $sql="SELECT nombrestado, codest FROM estado ORDER BY nombrestado";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }

    public function get_Vendedores(){
        $sql="SELECT nombreuser from usuarios where tipousuario = 2 or tipousuario=4 order by nombreuser ASC";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }

    public function insert_Productos(){
        $nomprod = $_POST["nomprod"];
        $tipoprod = $_POST["tiposlist"];
        $sql2="select idtipo from tipoprod WHERE nombretipo = '$tipoprod'";
        foreach ($this->conexion->query($sql2) as $row2){
            $this->y[]=$row2;
        }
        $datos2 = $this->y;
        $tipoproducto = $datos2[0][0];
        $cantidad = $_POST["cant"];
        $costoprod = $_POST["costo"];
        $ventaprod = $_POST["venta"];
        $estado = $_POST["estadolist"];
        $cant = (int) $cantidad;
        $cost = (int) $costoprod;
        $venta = (int) $ventaprod;
        $ubicacion = $_POST["ubicacion"];
        $vendedor = $_POST["vendedoreslist"];

        $sql = "INSERT INTO productos VALUES (DEFAULT,?,?,?,?,?,?,?,?);";
        $envio = $this->conexion->prepare($sql);

        $nombreProd = strip_tags($nomprod);
        $estProd = strip_tags($estado);
        $cantProd = strip_tags($cant);
        $costProd = strip_tags($cost);
        $ventaProd = strip_tags($venta);
        $ubiProd = strip_tags($ubicacion);
        $vendProd = strip_tags($vendedor);
        $tipoProd = strip_tags($tipoproducto);

        $envio->bindValue(1, $nombreProd, PDO::PARAM_STR);
        $envio->bindValue(2, $estProd, PDO::PARAM_STR);
        $envio->bindValue(3, $cantProd, PDO::PARAM_STR);
        $envio->bindValue(4, $costProd, PDO::PARAM_STR);
        $envio->bindValue(5, $ventaProd, PDO::PARAM_STR);
        $envio->bindValue(6, $ubiProd, PDO::PARAM_STR);
        $envio->bindValue(7, $vendProd, PDO::PARAM_STR);
        $envio->bindValue(8, $tipoProd, PDO::PARAM_STR);

        $envio->execute();
        echo "<script>alert('Producto agregado correctamente')</script>";
    }

    public function make_AddPrivilegio(){
        $nompriv = $_POST["nombrepriv"];
        $numeroprivilegio = $_POST["numpriv"];
        $numpriv = (int) $numeroprivilegio;
        $sql="SELECT privil from privilegio";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        for ($i=0; $i<sizeof($datos); $i++) {
            if ($datos[$i][0] == $numpriv){
                echo"<script>alert('Ese número de privilegio ya se encuentra asignado.')</script>";
                echo"<script type=\"text/javascript\">window.location='formPriv'</script>";
                exit;
            }else{
                $num = 0;
            }
        }
        if ($num == 0){
            $sql = "INSERT INTO privilegio VALUES (?,?);";
            $envio = $this->conexion->prepare($sql);

            $nomPriv = strip_tags($nompriv);
            $numPriv = strip_tags($numpriv);

            $envio->bindValue(1, $nomPriv, PDO::PARAM_STR);
            $envio->bindValue(2, $numPriv, PDO::PARAM_STR);

            $envio->execute();
            $this->conexion = null;
            echo "<script>alert('Privilegio agregado correctamente')</script>";
            echo "<script type=\"text/javascript\">window.location='formPriv'</script>";
        }

    }

    public function make_Usuario(){
        $nomus2 = $_POST["nombreusuario2"];
        $pass = $_POST["contraseña"];
        $tipoprod = $_POST["tiposlist"];
        $sql = "select idtipousuario from tipousuarios where nombretipousuario = '$tipoprod'";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $datos = $this->x;
        $tipousuario = $datos[0][0];
        $encripass = md5($pass);
        $val = $this->validate_NomUser($nomus2);
        if ($val == 0) {
            $sql = "INSERT INTO usuarios VALUES (?,?,?,?);";
            $envio = $this->conexion->prepare($sql);

            $nombre = strip_tags($nomus2);
            $passUser = strip_tags($encripass);
            $privUser = strip_tags(2);
            $tipoUser = strip_tags($tipousuario);

            $envio->bindValue(1, $nombre, PDO::PARAM_STR);
            $envio->bindValue(2, $passUser, PDO::PARAM_STR);
            $envio->bindValue(3, $privUser, PDO::PARAM_STR);
            $envio->bindValue(4, $tipoUser, PDO::PARAM_STR);

            $envio->execute();
            $this->conexion = null;
            echo "<script>alert('Usuario agregado correctamente.')</script>";
            echo "<script type=\"text/javascript\">window.location='adduser'</script>";
        }
    }

    public function validate_NomUser($nomUser){
        $sql="SELECT nombreuser from usuarios";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        for ($i=0; $i<sizeof($datos); $i++){
            if ($datos[$i][0] == $nomUser){
                echo "<script>alert('El nombre de usuario ya existe')</script>";
                echo "<script type=\"text/javascript\">window.location='adduser'</script>";
            }
        }
        unset($this->x);
        return 0;

    }

    public function get_Compras(){
        $sql="SELECT * FROM compra ORDER BY idcompra";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        return $this->x;
    }

    public function get_InfoUsers(){
        $sql="SELECT * FROM infousuarios ORDER BY iduser";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $data = $this->x;
        unset($this->x);
        return $data;
    }

    public function  get_Privilegio(){
        $sql="SELECT * FROM privilegio ORDER BY privil";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        return $this->x;
    }

    public function get_Users(){
        $sql="select usuarios.nombreuser, usuarios.contraseña, usuarios.privilegio, tipousuarios.nombretipousuario from usuarios, tipousuarios where usuarios.tipousuario = tipousuarios.idtipousuario";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        return $this->x;
    }

    public function get_TiposUsuarios(){
        $sql="SELECT * FROM tipousuarios";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        return $this->x;
    }

    public function get_UserfromInfo($nombreUser){
        $sql="SELECT * from infousuarios where nombreuser ='$nombreUser' ";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $user = $this->x;
        ?>
        </div>
        </div>
        </div>
        <thead>
        <tr>
            <th>Id Usuario</th>
            <th>Nombre de Usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Dirección</th>
            <th>Número de Cedula</th>
        </tr>
        </thead>
        <?php
        $rows = count($user);
        for ($i = 0; $i < $rows; $i++) {
            ?>
            <tr>
                <td><?php echo $user[$i][0] ?></td>
                <td><?php echo $user[$i][1] ?></td>
                <td><?php echo $user[$i][2] ?></td>
                <td><?php echo $user[$i][3] ?></td>
                <td><?php echo $user[$i][4] ?></td>
                <td><?php echo $user[$i][5] ?></td>
                <td><?php echo $user[$i][6] ?></td>
                <td><?php echo $user[$i][7] ?></td>
            </tr>
            <?php
        }
    }

    public function get_LlenarFormInfoUsers($nombreUser){
        $sql="SELECT * from infousuarios where nombreuser ='$nombreUser' ";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $data = $this->x;
        unset($this->x);
        return $data;
    }

    public function update_InfoUser(){
        $nameuser =$_POST["nomuser"];
        $name = $_POST["nombre"];
        $apell = $_POST["apellido"];
        $email = $_POST["correo"];
        $numerotel = $_POST["telefono"];
        $dir = $_POST["direccion"];
        $cedul = $_POST["cedula"];
        $tel = (int) $numerotel;
        $ced = (int) $cedul;

        $sql = "UPDATE infousuarios set nombre=?, apellido=?, correo=?, telefono=?, direccion=?, cedula=? WHERE nombreuser='$nameuser'";
        $envio = $this->conexion->prepare($sql);

        $nombre = strip_tags($name);
        $apellido = strip_tags($apell);
        $correo = strip_tags($email);
        $telefono = strip_tags($tel);
        $direccion = strip_tags($dir);
        $cedula = strip_tags($ced);

        $envio->bindValue(1, $nombre, PDO::PARAM_STR);
        $envio->bindValue(2, $apellido, PDO::PARAM_STR);
        $envio->bindValue(3, $correo, PDO::PARAM_STR);
        $envio->bindValue(4, $telefono, PDO::PARAM_STR);
        $envio->bindValue(5, $direccion, PDO::PARAM_STR);
        $envio->bindValue(6, $cedula, PDO::PARAM_STR);

        $envio->execute();
        $this->conexion = null;

        echo "<script>alert('Información actualizada correctamente.')</script>";
        echo "<script type=\"text/javascript\">window.location='modInfo'</script>";

    }

    public function get_Productos(){
        $sql="SELECT productos.idprod, productos.nombre, tipoprod.nombretipo, productos.estado, productos.cantidad, productos.costo, productos.venta, productos.ubicacion, productos.vendedor FROM productos, tipoprod WHERE productos.tipo = tipoprod.idtipo ORDER BY idprod";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $prod = $this->x;
        unset($this->x);
        return $prod;
    }

    public function find_Prod($id){
        $sql = "select productos.idprod, productos.nombre, tipoprod.nombretipo, productos.estado, productos.cantidad, productos.costo, productos.venta, productos.ubicacion, productos.vendedor from productos, tipoprod where productos.tipo = tipoprod.idtipo AND idprod =$id ";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $prod = $this->x;

        ?>
        </div>
        </div>
        </div>
        <thead>
        <tr>
            <th>Id Producto</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Estado Actual</th>
            <th>Cantidad</th>
            <th>Costo Producto</th>
            <th>Costo Venta</th>
            <th>Ubicación</th>
            <th>Vendedor</th>
        </tr>
        </thead>
        <?php
        $rows = count($prod);
        for ($i = 0; $i < $rows; $i++) {
            ?>
        <tr>
            <td><?php echo $prod[$i][0]; ?></td>
            <td><?php echo $prod[$i][1]; ?></td>
            <td><?php echo $prod[$i][2]; ?></td>
            <td><?php echo $prod[$i][3]; ?></td>
            <td><?php echo $prod[$i][4]; ?></td>
            <td><?php echo $prod[$i][5]; ?></td>
            <td><?php echo $prod[$i][6]; ?></td>
            <td><?php echo $prod[$i][7]; ?></td>
            <td><?php echo $prod[$i][8]; ?></td>
        </tr>
        <?php
        }
    }

    public function get_LlenarFormProd($id){
        $sql = "select productos.idprod, productos.nombre, tipoprod.nombretipo, productos.estado, productos.cantidad, productos.costo, productos.venta, productos.ubicacion, productos.vendedor from productos, tipoprod where productos.tipo = tipoprod.idtipo AND idprod = '$id' ";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $data = $this->x;
        unset($this->x);
        return $data;
    }

    public function update_Productos(){
        $idedelproducto = $_POST["idproduc"];
        $idpro = (int) $idedelproducto;
        $nomprod = $_POST["nomprod"];
        $tipoprod = $_POST["tiposlist"];
        $tipo = $this->get_idTipoProd($tipoprod);
        $cantidad = $_POST["cant"];
        $costoprod = $_POST["costo"];
        $ventaprod = $_POST["venta"];
        $estado = $_POST["estadolist"];
        $cant = (int) $cantidad;
        $cost = (int) $costoprod;
        $venta = (int) $ventaprod;
        $ubicacion = $_POST["ubicacion"];
        $vendedor = $_POST["vendedoreslist"];

        $sql = "UPDATE productos set nombre=?, tipo=?, estado=?, cantidad=?, costo=?, venta=?, ubicacion=?, vendedor=? WHERE idprod=$idpro";
        $envio = $this->conexion->prepare($sql);

        $nombre = strip_tags($nomprod);
        $tipoProd = strip_tags($tipo);
        $est = strip_tags($estado);
        $cantid = strip_tags($cant);
        $costo = strip_tags($cost);
        $ven = strip_tags($venta);
        $ubic = strip_tags($ubicacion);
        $vendedorProd = strip_tags($vendedor);

        $envio->bindValue(1, $nombre, PDO::PARAM_STR);
        $envio->bindValue(2, $tipoProd, PDO::PARAM_STR);
        $envio->bindValue(3, $est, PDO::PARAM_STR);
        $envio->bindValue(4, $cantid, PDO::PARAM_STR);
        $envio->bindValue(5, $costo, PDO::PARAM_STR);
        $envio->bindValue(6, $ven, PDO::PARAM_STR);
        $envio->bindValue(7, $ubic, PDO::PARAM_STR);
        $envio->bindValue(8, $vendedorProd, PDO::PARAM_STR);

        $envio->execute();
        echo "<script>alert('Producto actualizado correctamente.')</script>";
    }

    public function create_log($nom,$info,$i){

        $fecha = date( "Y/m/d", time() );
        $time = strftime( "%H:%M:%S", time() );

        if ($info == "Inicio de Sesión"){

            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?, DEFAULT );";
            $BD = $this->conexion->prepare($sqlLOG);

            $log = strip_tags($info);
            $nombre = strip_tags($nom);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);

            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $nombre, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $hora, PDO::PARAM_STR);

            $BD->execute();

            $this->conexion = null;

        } elseif ($info == "Cerró Sesión"){

            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?, DEFAULT );";
            $BD = $this->conexion->prepare($sqlLOG);

            $log = strip_tags($info);
            $nombre = strip_tags($nom);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);

            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $nombre, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $hora, PDO::PARAM_STR);

            $BD->execute();

            $this->conexion = null;

        } elseif ($info == "Creación de Producto"){

            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?,DEFAULT );";
            $BD = $this->conexion->prepare($sqlLOG);

            $log = strip_tags($info);
            $nombre = strip_tags($nom);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);

            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $nombre, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $hora, PDO::PARAM_STR);

            $BD->execute();

            $this->conexion = null;

            echo "<script type=\"text/javascript\">window.location='form_validation'</script>";

        } elseif($info == "Modificación de Producto"){

            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?,?);";
            $BD = $this->conexion->prepare($sqlLOG);

            $log = strip_tags($info);
            $nombre = strip_tags($nom);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $id = strip_tags($i);

            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $nombre, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $hora, PDO::PARAM_STR);
            $BD->bindValue(5, $id, PDO::PARAM_STR);

            $BD->execute();

            $this->conexion = null;

        } elseif ($info == "Eliminó un Producto"){

            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?,?);";
            $BD = $this->conexion->prepare($sqlLOG);

            $log = strip_tags($info);
            $nombre = strip_tags($nom);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $id = strip_tags($i);

            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $nombre, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $hora, PDO::PARAM_STR);
            $BD->bindValue(5, $id, PDO::PARAM_STR);

            $BD->execute();

            $this->conexion = null;

            echo "<script type=\"text/javascript\">window.location='modProd'</script>";

        } elseif ($info == "Modificación de Compra"){

            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?,?);";
            $BD = $this->conexion->prepare($sqlLOG);

            $log = strip_tags($info);
            $nombre = strip_tags($nom);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $id = strip_tags($i);

            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $nombre, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $hora, PDO::PARAM_STR);
            $BD->bindValue(5, $id, PDO::PARAM_STR);

            $BD->execute();

            $this->conexion = null;

            echo "<script type=\"text/javascript\">window.location='modBuy'</script>";

        } elseif ($info == "Eliminó una Compra"){

            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?,?);";
            $BD = $this->conexion->prepare($sqlLOG);

            $log = strip_tags($info);
            $nombre = strip_tags($nom);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $id = strip_tags($i);

            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $nombre, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $hora, PDO::PARAM_STR);
            $BD->bindValue(5, $id, PDO::PARAM_STR);

            $BD->execute();

            $this->conexion = null;

            echo "<script type=\"text/javascript\">window.location='modBuy'</script>";
        }

    }

    public function get_logUser($user){
        $sql="SELECT * FROM log WHERE usuario = '$user'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        if ($this->x == null){
            $log = 0;
        } else{
            $log = $this->x;
        }
        return $log;
    }

    public function get_idTipoProd($tipo){
        $sql = "select idtipo from tipoprod WHERE nombretipo = '$tipo'";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $data = $this->x;
        unset($this->x);
        $tipo = $data[0][0];
        return $tipo;
    }

    public function delete_Prod(){
        $id = $_POST["idproduc"];

        if ($id == 0){
            echo "<script>alert('Busque primero el producto que desea eliminar.')</script>";
            echo "<script type=\"text/javascript\">window.location='modProd'</script>";
        } else{
            $sql = "delete from productos WHERE idprod = ?";
            $envio = $this->conexion->prepare($sql);

            $envio->bindValue(1, $_POST["idproduc"], PDO::PARAM_STR);

            $envio->execute();

            echo "<script>alert('Producto eliminado correctamente.')</script>";
        }
    }

    public function get_ComprasProd(){
        $sql = "select * from compra";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $compra = $this->x;
        unset($this->x);
        return $compra;
    }

    public function find_Compra($id){
        $sql = "SELECT * from compra where idcompra ='$id'";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $compra = $this->x;
        ?>
        </center>
        </div>
        </div>
        </div>
        <thead>
        <tr>
            <th>Id Compra</th>
            <th>Id Producto</th>
            <th>Nombre Producto</th>
            <th>Estado</th>
            <th>Cantidad Disponible</th>
            <th>Costo Unidad</th>
            <th>Cantidad Comprada</th>
            <th>Número de Cedula</th>
            <th>Número de Telefono</th>
            <th>Vendedor del Producto</th>
            <th>Comprador del Producto</th>
            <th>Valoración de la Compra</th>
            <th>Detalle de la Valoración</th>
        </tr>
        </thead>
        <?php
        $rows = count($compra);
        for ($i = 0; $i < $rows; $i++){
            ?>
            <tr>
                <td><?php echo $compra[$i][0]; ?></td>
                <td><?php echo $compra[$i][1]; ?></td>
                <td><?php echo $compra[$i][2]; ?></td>
                <td><?php echo $compra[$i][3]; ?></td>
                <td><?php echo $compra[$i][4]; ?></td>
                <td><?php echo $compra[$i][5]; ?></td>
                <td><?php echo $compra[$i][6]; ?></td>
                <td><?php echo $compra[$i][7]; ?></td>
                <td><?php echo $compra[$i][8]; ?></td>
                <td><?php echo $compra[$i][9]; ?></td>
                <td><?php echo $compra[$i][10]; ?></td>
                <td><?php echo $compra[$i][11]; ?></td>
                <td><?php echo $compra[$i][12]; ?></td>
            </tr>
            <?php
        }
    }

    public function get_LlenarFormCompra($id){
        $sql = "SELECT * from compra where idcompra ='$id' ";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $compra = $this->x;
        unset($this->x);
        return $compra;
    }

    public function update_Compras(){
        $idcompraproducto =$_POST["idcompra"];
        $idproducto = $_POST["idprod"];
        $nomprod = $_POST["nomprod"];
        $cantidadisponible = $_POST["cantdisp"];
        $cantidadcomprada = $_POST["cantcomprada"];
        $numerocedula = $_POST["numcedula"];
        $numerotelefono = $_POST["numtelefono"];
        $infoval = $_POST["detval"];
        $val = $_POST["tiposlist"];
        $valoracion= $this->get_IdValoracion($val);
        $idc = (int) $idcompraproducto;
        $idp = (int) $idproducto;
        $numc = (int) $numerocedula;
        $numt = (int) $numerotelefono;

        if ($cantidadcomprada > $cantidadisponible){
            $this->conexion = null;
            echo "<script>alert('Error, no se puede actualizar debido a que la cantidad comprada del producto es superior a la disponible. Intente de nuevo por favor.')</script>";
            echo "<script type=\"text/javascript\">window.location='modBuy'</script>";
        }

        $sql = "UPDATE compra set cantbuy=?, valoracion=?, infoval=? WHERE idcompra =$idc";
        $envio = $this->conexion->prepare($sql);

        $cantidad = strip_tags($cantidadcomprada);
        $valCompra = strip_tags($valoracion);
        $infoVal = strip_tags($infoval);

        $envio->bindValue(1, $cantidad, PDO::PARAM_STR);
        $envio->bindValue(2, $valCompra, PDO::PARAM_STR);
        $envio->bindValue(3, $infoVal, PDO::PARAM_STR);

        $envio->execute();

        echo "<script>alert('Compra actualizada correctamente.')</script>";
    }

    public function  get_IdValoracion($val){
        $sql = "select idvaloracion from valoraciones WHERE nombreval = '$val'";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $valoracion = $this->x;
        $idvalor = $valoracion[0][0];
        $idVal = (int) $idvalor;
        unset($this->x);
        return $idVal;
    }

    public function get_Valoraciones(){
        $sql = "SELECT nombreval from valoraciones ORDER BY idvaloracion DESC ";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $val = $this->x;
        unset($this->x);
        return $val;
    }

    public function delete_Compra(){
        $idcompraproducto =$_POST["idcompra"];
        $idc = (int) $idcompraproducto;

        if ($idc == 0){
            echo "<script>alert('Busque primero la compra que desea eliminar.')</script>";
            echo "<script type=\"text/javascript\">window.location='modBuy'</script>";
        } else{
            $sql = "delete from compra WHERE idcompra=?";
            $envio = $this->conexion->prepare($sql);

            $id = strip_tags($idc);

            $envio->bindValue(1, $id, PDO::PARAM_STR);

            $envio->execute();

            echo "<script>alert('Compra eliminada correctamente.')</script>";
        }
    }

    public function update_AdminInfo(){
        $nameuser =$_POST["nombreusuario"];
        $name = $_POST["nombre"];
        $apell = $_POST["apellidos"];
        $email = $_POST["email"];
        $numerotel = $_POST["tel"];
        $dir = $_POST["dir"];
        $cedul = $_POST["numcc"];

        $sql = "UPDATE infousuarios set nombre=?, apellido=?, correo=?, telefono=?, direccion=?, cedula=? WHERE nombreuser='$nameuser'";
        $envio = $this->conexion->prepare($sql);

        $nombre = strip_tags($name);
        $apellido = strip_tags($apell);
        $correo = strip_tags($email);
        $telefono = strip_tags($numerotel);
        $direccion = strip_tags($dir);
        $cedula = strip_tags($cedul);

        $envio->bindValue(1, $nombre, PDO::PARAM_STR);
        $envio->bindValue(2, $apellido, PDO::PARAM_STR);
        $envio->bindValue(3, $correo, PDO::PARAM_STR);
        $envio->bindValue(4, $telefono, PDO::PARAM_STR);
        $envio->bindValue(5, $direccion, PDO::PARAM_STR);
        $envio->bindValue(6, $cedula, PDO::PARAM_STR);

        $envio->execute();
        unset($this->x);

        echo "<script>alert('Información actualizada correctamente.')</script>";
        echo "<script type=\"text/javascript\">window.location='perfil'</script>";
    }

}
?>