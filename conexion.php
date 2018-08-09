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

        $comp=$this->conexion->prepare('select idtipousuario from usuarios where idtipousuario = 3 OR idtipousuario = 4');
        $comp->execute();

        $fetch = $comp->fetchAll();
        $rows = count($fetch);

        return $rows;
    }

    public function get_Vendedores(){
        $vend=$this->conexion->prepare('select idtipousuario from usuarios where idtipousuario = 2 OR idtipousuario = 4');
        $vend->execute();
        $fetch = $vend->fetchAll();
        $rows = count($fetch);
        return $rows;
    }
    public function get_Frutas(){
        $frutas=$this->conexion->prepare("select * from productosusuarios where idestado='1' or idestado='2'");
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
        $fecha = date( "Y-m-d", time() );
        $horaActual = strftime( "%H:%M:%S", time() );

        $sql="insert into mensajes VALUES (default, ?,?,?,?,?);";
        $envio=$this->conexion->prepare($sql);
        $Dia = strip_tags($fecha);
        $hora = strip_tags($horaActual);

        $envio->bindValue(1, $_POST["name"], PDO::PARAM_STR);
        $envio->bindValue(2, $_POST["tel"], PDO::PARAM_STR);
        $envio->bindValue(3, $_POST["message"], PDO::PARAM_STR);
        $envio->bindValue(4, $hora, PDO::PARAM_STR);
        $envio->bindValue(5, $Dia, PDO::PARAM_STR);

        $envio->execute();
        $this->conexion = null;

        echo"<script>alert('Mensaje enviado correctamente')</script>";
        echo"<script type=\"text/javascript\">window.location='index'</script>";
    }
    public function login(){
        $nom = $_POST["nomusuario"];
        $password = $_POST["pass"];
        $pasencrip = md5($password);
        $sql = "SELECT nombreuser,pass, iduser FROM usuarios WHERE nombreuser='$nom' and pass ='$pasencrip'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        if ($datos[0]["nombreuser"] == $nom && $datos[0]["pass"] == $pasencrip){
            $_SESSION["user"]=$nom;
            $_SESSION["iduser"]= $datos[0]["iduser"];
            $iduser = $datos[0]["iduser"];
            $sqlpriv = "SELECT idtipousuario FROM usuarios WHERE nombreuser = '$nom'";
            foreach ($this->conexion->query($sqlpriv) as $row2){
                $this->y[]=$row2;
            }
            $datos2 = $this->y;
            $_SESSION["privil"] = $datos2[0]["idtipousuario"];
            if ($_SESSION["privil"] == 1){
                $admin = new Admin();
                $info = "Inicio de Sesión";
                $admin->create_log($iduser,$info,$i = null);
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
        $iduser = $_SESSION["iduser"];
        $sql="select nombre, apellido from usuarios where iduser = '$iduser'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $nombre= $datos[0][0];
        $apellido = $datos[0][1];
        $nombreyapellido = $nombre.' '.$apellido;
        unset($this->x);
        return $nombreyapellido;
    }
    public function get_Nombre(){
        $iduser = $_SESSION["iduser"];
        $sql="select nombre from usuarios where iduser = '$iduser'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $nombre= $datos[0][0];
        unset($this->x);
        return $nombre;
    }
    public function get_Apellido(){
        $iduser = $_SESSION["iduser"];
        $sql="select apellido from usuarios where iduser = '$iduser'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $apellido= $datos[0][0];
        unset($this->x);
        return $apellido;
    }
    public function get_Correo(){
        $iduser = $_SESSION["iduser"];
        $sql="select correo from usuarios where iduser = '$iduser'";

        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $correo= $datos[0][0];

        unset($this->x);
        return $correo;
    }
    public function get_Tel(){
        $iduser = $_SESSION["iduser"];
        $sql="select telefono from usuarios where iduser = '$iduser'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $telefono= $datos[0][0];
        unset($this->x);
        return $telefono;
    }
    public function get_Dir(){
        $iduser = $_SESSION["iduser"];
        $sql="select direccion from usuarios where iduser = '$iduser'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $dir= $datos[0][0];
        unset($this->x);
        return $dir;
    }
    public function get_NumCC(){
        $iduser = $_SESSION["iduser"];
        $sql="select cedula from usuarios where iduser = '$iduser'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        $numCC= $datos[0][0];
        return $numCC;
    }
    public function get_ProductosToBuy($iduser){
        $user = (int) $iduser;
        $productos=$this->conexion->prepare("SELECT * FROM productosusuarios ORDER BY idprod");
        $productos->execute();
        $fetch = $productos->fetchAll();
        $rows = count($fetch);
        if ($rows == 0){
            echo"<script>alert('Se presentan problemas con los productos disponibles')</script>";
            echo"<script type=\"text/javascript\">window.location='index'</script>";
        } else{
            if($iduser == null){
                $sql2='select productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, estado.nombre, productosusuarios.cantidad, productosusuarios.costoUnitario, productosusuarios.costoTotal, productosusuarios.ubicacion, productosusuarios.fechaCreacion, productosusuarios.fechaFinal, usuarios.nombre, productosusuarios.idprod from productosusuarios, usuarios, estado, productos where productosusuarios.idestado = estado.idestado and usuarios.iduser = productosusuarios.idusers and productos.idprod = productosusuarios.idprod  and productosusuarios.idestado != 3 order by idProductosUsuarios';
                foreach ($this->conexion->query($sql2) as $row){
                    $this->x[]=$row;
                }
                $datos = $this->x;
                unset($this->x);
                return $datos;
            } else{
                $sql2="select productosusuarios.idProductosUsuarios, productosusuarios.nombreProducto, estado.nombre, productosusuarios.cantidad, productosusuarios.costoUnitario, productosusuarios.costoTotal, productosusuarios.ubicacion, productosusuarios.fechaCreacion, productosusuarios.fechaFinal, usuarios.nombre, productosusuarios.idprod from productosusuarios, usuarios, estado, productos where productosusuarios.idestado = estado.idestado and usuarios.iduser = productosusuarios.idusers and productos.idprod = productosusuarios.idprod and productosusuarios.idusers != '$user' and productosusuarios.idestado != 3 order by idProductosUsuarios";
                foreach ($this->conexion->query($sql2) as $row){
                    $this->x[]=$row;
                }
                $datos = $this->x;
                unset($this->x);
                return $datos;
            }
        }
    }
    public function get_ListaProductos(){
        $productos=$this->conexion->prepare("SELECT * FROM productosusuarios ORDER BY idprod");
        $productos->execute();
        $fetch = $productos->fetchAll();
        $rows = count($fetch);
        if ($rows == 0){
            echo"<script>alert('Se presentan problemas con los productos disponibles')</script>";
            echo"<script type=\"text/javascript\">window.location='index'</script>";
        } else{
            $sql2="select productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, estado.nombre, productosusuarios.cantidad, productosusuarios.costoUnitario, productosusuarios.costoTotal, productosusuarios.ubicacion, productosusuarios.fechaCreacion, productosusuarios.fechaFinal, usuarios.nombre, productosusuarios.idprod, productos.nombre from productosusuarios, usuarios, estado, productos where productosusuarios.idestado = estado.idestado and usuarios.iduser = productosusuarios.idusers and productos.idprod = productosusuarios.idprod order by idProductosUsuarios";
            foreach ($this->conexion->query($sql2) as $row){
                $this->x[]=$row;
            }
            $datos = $this->x;
            unset($this->x);
            return $datos;
        }
    }

    public function get_ProductosPrin(){
        $sql2="select productos.idprod, productos.nombre, tipoprod.nombretipo from productos, tipoprod where tipoprod.idtipo = productos.idtipo order by idprod";
        foreach ($this->conexion->query($sql2) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        if ($datos == 0){
            echo"<script>alert('Se presentan problemas con los productos disponibles')</script>";
            echo"<script type=\"text/javascript\">window.location='index'</script>";
        }else{
            unset($this->x);
            return $datos;
        }

    }

    public function get_Id(){
        $idproduc = $_POST["idprod"];
        $id=$this->conexion->prepare("SELECT idproductosusuarios FROM productosusuarios");
        $id->execute();
        while ($fetch = $id->fetchColumn()){
            if ($fetch == $idproduc){
                $sql ="select productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, estado.nombre, productosusuarios.cantidad, productosusuarios.costoUnitario, productosusuarios.costoTotal, productosusuarios.ubicacion, productosusuarios.fechaCreacion, productosusuarios.fechaFinal, usuarios.nombre, productosusuarios.idprod, productosusuarios.idusers from productosusuarios, usuarios, estado, productos where productosusuarios.idestado = estado.idestado and usuarios.iduser = productosusuarios.idusers and productos.idprod = productosusuarios.idprod  and productosusuarios.idestado != 3 and idproductosusuarios ='$idproduc' order by idProductosUsuarios";
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
        $fecha = date( "Y-m-d", time() );
        $time = strftime( "%H:%M:%S", time() );
        $iduser = $_SESSION["iduser"];
        $iddelproductocompra = $_POST["idproduc"];
        $idpr = (int) $iddelproductocompra;
        $cantidaddisp = $_POST["cant"];
        $cantidadcomp = $_POST["cantbuy"];
        $costo = $_POST["costo"];
        $valorCompra = $costo * $cantidadcomp;
        $vendedor = $_POST["vendedor"];

        $cantdis = (int) $cantidaddisp;
        $cantbuy = (int) $cantidadcomp;
        $cantidadFinal = $cantdis - $cantbuy;
        if ($cantbuy > $cantdis ){
            $this->conexion = null;
            echo"<script>alert('No se pueden realizar compras mayores a la cantidad disponible actualmente, intente con una cantidad menor por favor.')</script>";
            echo"<script type=\"text/javascript\">window.location='bd'</script>";
        }
        $sql="insert into compra VALUES (DEFAULT , ?,DEFAULT ,?,?,DEFAULT ,?,0,? ,?, ?);";
        $envio=$this->conexion->prepare($sql);

        $idProd = strip_tags($idpr);
        $cantComp = strip_tags($cantbuy);
        $idusr = strip_tags($iduser);
        $Dia = strip_tags($fecha);
        $hora = strip_tags($time);
        $idvendedor = strip_tags($vendedor);
        $costocompra = strip_tags($valorCompra);


        $envio->bindValue(1, $cantComp, PDO::PARAM_STR);
        $envio->bindValue(2, $Dia, PDO::PARAM_STR);
        $envio->bindValue(3, $hora, PDO::PARAM_STR);
        $envio->bindValue(4, $idusr, PDO::PARAM_STR);
        $envio->bindValue(5, $idProd, PDO::PARAM_STR);
        $envio->bindValue(6, $idvendedor, PDO::PARAM_STR);
        $envio->bindValue(7, $costocompra, PDO::PARAM_STR);

        $envio->execute();
        unset($this->x);
        $this->make_restaBD($cantidadFinal, $idpr);
        echo"<script>alert('Compra Realizada correctamente! Uno de nuestros administradores se comunicara contigo para iniciar el proceso de venta, Gracias!!')</script>";
        echo"<script type=\"text/javascript\">window.location='bd'</script>";
    }
    public function make_restaBD($valor, $id){
        if ($valor == 0){
            $this->update_estado($id);
        }
        $sql = "UPDATE productosusuarios set cantidad=? WHERE idproductosusuarios=$id";
        $envio = $this->conexion->prepare($sql);
        $cant = strip_tags($valor);
        $envio->bindValue(1, $cant, PDO::PARAM_STR);
        $envio->execute();
        $this->conexion = null;
    }
    public function update_estado($id){
        $sql = "UPDATE productosusuarios set idestado=? WHERE idproductosusuarios=$id";
        $envio = $this->conexion->prepare($sql);
        $valor = 3;
        $cant = strip_tags($valor);
        $envio->bindValue(1, $cant, PDO::PARAM_STR);
        $envio->execute();
    }
    public function get_Usuarios(){
        $users=$this->conexion->prepare("select nombre, apellido, direccion, idtipousuario, nombreuser, iduser from usuarios where idtipousuario = 2 or idtipousuario = 4 order by nombre");
        $users->execute();
        while ($fetch = $users->fetchAll()){
            $rows1 = count($fetch);
            for ($i=0; $i<$rows1; $i++){
                $nombre= $fetch[$i][0];
                $apellido= $fetch[$i][1];
                $direccion= $fetch[$i][2];
                $iduser= $fetch[$i][5];
                $val=$this->get_SelectUsuarios($iduser);
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
    public function get_SelectUsuarios($iduser){
        $vend=$this->conexion->prepare("select idcompra, v_idvaloracion, pu_iduser from compra where v_idvaloracion > 0 and  pu_iduser = '$iduser' group by idcompra");
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
            $sql ="select sum(v_idvaloracion) as promedio from compra where v_idvaloracion > 0 and  pu_iduser = '$iduser'";
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
        $sql="select * from tipousuarios";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_userRegistro(){
        $sql="select * from tipousuarios where idtipousuario != '1' ";
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
        $idtipouser = (int) $_POST["tiposlist"];
        $encripass = md5($pass);
        unset($this->x);
        $val =$this->validate_nomUser($nomus2);
        if ($val == 0) {
            $this->make_SubirRegistro($nomus2,$encripass,$idtipouser);
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
            $sql="insert into usuarios VALUES (default, ?, 0 , 0 , 0 , 0 , 0 , 0 ,?,1);";
            $envio=$this->conexion->prepare($sql);
            $nomAdmin = strip_tags($nombre);
            $contraseña = strip_tags($encripass);
            $envio->bindValue(1, $nomAdmin, PDO::PARAM_STR);
            $envio->bindValue(2, $contraseña, PDO::PARAM_STR);
            $envio->execute();
            unset($this->x);
            echo '<script>alert("Creado el administrador: '.$nombre.', Deivith." )</script>';
            echo"<script type=\"text/javascript\">window.location='index'</script>";
        }
        if ($validate == 1){
            echo"<script type=\"text/javascript\">window.location='registro'</script>";
        }
    }
    public function update_InfoUsers(){
        $iduser = $_SESSION["iduser"];
        $name = $_POST["nombre"];
        $apell = $_POST["apellidos"];
        $email = $_POST["email"];
        $numerotel = $_POST["tel"];
        $dir = $_POST["dir"];
        $cedul = $_POST["numcc"];
        $sql = "UPDATE usuarios set nombre=?, apellido=?, correo=?, telefono=?, direccion=?, cedula=? WHERE iduser='$iduser'";
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
    public function make_SubirRegistro($nomus2,$encripass,$idtipouser){
        $sql="insert into usuarios VALUES (default, ?, 0 , 0 , 0 , 0 , 0 , 0 ,?,?);";
        $envio=$this->conexion->prepare($sql);
        $nombre = strip_tags($nomus2);
        $password = strip_tags($encripass);
        $idTipUser = strip_tags($idtipouser);
        $envio->bindValue(1, $nombre, PDO::PARAM_STR);
        $envio->bindValue(2, $password, PDO::PARAM_STR);
        $envio->bindValue(3, $idTipUser, PDO::PARAM_STR);
        $envio->execute();
        echo '<script>alert("Bienvenido a EcoFruit usuario '.$nombre.', le agradecemos hacer parte de este gran proyecto, " +
        "recuerde modificar su infomación en el link que se encuentra junto a cerrar sesion en el panel superior. Gracias." )</script>';
        unset($this->x);
        echo"<script type=\"text/javascript\">window.location='index'</script>";
    }

}
class Admin{
    private $conexion;
    private $x;
    private $year;
    public function __construct()
    {
        $this->conexion = new PDO('pgsql:host=' .NOMBRE_SERVIDOR. '; dbname=' .BASE_DE_DATOS, NOMBRE_USUARIO, PASSWORD);
        $this->x=array();
        $this->year = date("Y");
    }
    public function get_NombreApellido(){
        $nom = $_SESSION["user"];
        $sql="select nombre, apellido from usuarios where nombreuser = '$nom'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        if ($datos[0][0] == "0"){
            echo"<script>alert('Diríjase a la pagina de su perfil para agregar su correspondiente información')</script>";
        }
        $nombre= $datos[0][0];
        $apellido = $datos[0][1];
        $nombreyapellido = "$nombre $apellido";
        unset($this->x);
        return $nombreyapellido;
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
                $sql="insert into usuarios VALUES (DEFAULT,?,?,?,?,?,?,?);";
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
        $sql="SELECT nombreuser from usuarios";
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
        $sql="SELECT idtipo, nombretipo from tipoprod ORDER BY nombretipo";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_EstadosProd(){
        $sql="SELECT * FROM estado";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_EstadosProdAdd(){
        $sql="SELECT nombre, idestado FROM estado WHERE idestado < 3 ORDER BY nombre";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_Vendedores(){
        $sql="SELECT iduser, nombreuser, nombre, apellido from usuarios where idtipousuario = 2 or idtipousuario=4 order by nombreuser ASC";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }

    public function add_ProdPrin(){
        $nomprod = $_POST["nomProd"];
        $prod = $_POST["tipoProd"];
        $tipoProd = (int) $prod;

        $sql = "INSERT INTO productos VALUES (DEFAULT,?,?);";
        $envio = $this->conexion->prepare($sql);
        $nombre = strip_tags($nomprod);
        $tipo = strip_tags($tipoProd);

        $envio->bindValue(1, $nombre, PDO::PARAM_STR);
        $envio->bindValue(2, $tipo, PDO::PARAM_STR);

        $envio->execute();
        echo "<script>alert('Producto principal agregado correctamente')</script>";
    }

    public function insert_Productos(){
        $fecha = date( "Y-m-d", time() );
        $nomprod = $_POST["nomprod"];
        $prod = $_POST["productos"];
        $cantidad = $_POST["cant"];
        $costoprod = $_POST["costo"];
        $ventaprod = $_POST["venta"];
        $estado = $_POST["estadolist"];
        $fechaLimite = $_POST["fechaF"];
        $cant = (int) $cantidad;
        $cost = (int) $costoprod;
        $venta = (int) $ventaprod;
        $ubicacion = $_POST["ubicacion"];
        $vendedor = $_POST["vendedoreslist"];
        $idvendedor = (int) $vendedor;
        $sql = "INSERT INTO productosusuarios VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?);";

        $envio = $this->conexion->prepare($sql);
        $nombreProd = strip_tags($nomprod);
        $estProd = strip_tags($estado);
        $cantProd = strip_tags($cant);
        $costProd = strip_tags($cost);
        $ventaProd = strip_tags($venta);
        $ubiProd = strip_tags($ubicacion);
        $vendProd = strip_tags($idvendedor);
        $idProdP = strip_tags($prod);
        $date = strip_tags($fecha);
        $fechaF = strip_tags($fechaLimite);

        $envio->bindValue(1, $nombreProd, PDO::PARAM_STR);
        $envio->bindValue(2, $cantProd, PDO::PARAM_STR);
        $envio->bindValue(3, $costProd, PDO::PARAM_STR);
        $envio->bindValue(4, $ventaProd, PDO::PARAM_STR);
        $envio->bindValue(5, $ubiProd, PDO::PARAM_STR);
        $envio->bindValue(6, $date, PDO::PARAM_STR);
        $envio->bindValue(7, $fechaF, PDO::PARAM_STR);
        $envio->bindValue(8, $vendProd, PDO::PARAM_STR);
        $envio->bindValue(9, $idProdP, PDO::PARAM_STR);
        $envio->bindValue(10, $estProd, PDO::PARAM_STR);

        $envio->execute();
        echo "<script>alert('Producto para la venta agregado correctamente')</script>";
    }

    public function make_Usuario(){
        $nomus2 = $_POST["nombreusuario2"];
        $pass = $_POST["contraseña"];
        $tipousuario = $_POST["tiposlist"];
        $encripass = md5($pass);
        $val = $this->validate_NomUser($nomus2);
        if ($val == 0) {
            $sql = "INSERT INTO usuarios VALUES (default, ?,0,0,0,0,0,0,?,?);";
            $envio = $this->conexion->prepare($sql);
            $nombre = strip_tags($nomus2);
            $passUser = strip_tags($encripass);
            $tipoUser = strip_tags($tipousuario);
            $envio->bindValue(1, $nombre, PDO::PARAM_STR);
            $envio->bindValue(2, $passUser, PDO::PARAM_STR);
            $envio->bindValue(3, $tipoUser, PDO::PARAM_STR);
            $envio->execute();
            echo "<script>alert('Usuario agregado correctamente.')</script>";
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
        $sql="select compra.idcompra, valoraciones.nombreval, compra.infoval, compra.fecha, compra.hora, usuarios.nombre, productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, productosusuarios.ubicacion, compra.costo, compra.cantbuy, compra.observaciones, compra.u_iduser from compra, valoraciones, usuarios, productosusuarios where compra.v_idvaloracion = valoraciones.idvaloracion and compra.pu_iduser = usuarios.iduser and productosusuarios.idproductosusuarios = compra.pu_idproduser order by compra.idcompra";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        return $this->x;
    }
    public function get_InfoUsers(){
        $sql="SELECT usuarios.*, tipousuarios.nombretipousuario FROM usuarios, tipousuarios where usuarios.idtipousuario = tipousuarios.idtipousuario order by iduser";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $data = $this->x;
        unset($this->x);
        return $data;
    }

    public function get_TiposUsuarios(){
        $sql="SELECT * FROM tipousuarios";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        return $this->x;
    }
    public function get_UserfromInfo($nombreUser){
        $sql="SELECT usuarios.*, tipousuarios.nombretipousuario FROM usuarios, tipousuarios where usuarios.idtipousuario = tipousuarios.idtipousuario and nombreuser ='$nombreUser' order by iduser";
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
            <th>Tipo</th>
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
                <td><?php echo $user[$i][10] ?></td>
            </tr>
            <?php
        }
    }
    public function get_LlenarFormInfoUsers($nombreUser){
        $sql="SELECT usuarios.*, tipousuarios.nombretipousuario FROM usuarios, tipousuarios where usuarios.idtipousuario = tipousuarios.idtipousuario and nombreuser ='$nombreUser' order by iduser";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $data = $this->x;
        unset($this->x);
        return $data;
    }
    public function update_InfoUser(){
        $iduser =$_POST["iduser"];
        $name = $_POST["nombre"];
        $apell = $_POST["apellido"];
        $email = $_POST["correo"];
        $numerotel = $_POST["telefono"];
        $dir = $_POST["direccion"];
        $cedul = $_POST["cedula"];
        $ced = (int) $cedul;
        $sql = "UPDATE usuarios set nombre=?, apellido=?, correo=?, telefono=?, direccion=?, cedula=? WHERE iduser='$iduser'";
        $envio = $this->conexion->prepare($sql);
        $nombre = strip_tags($name);
        $apellido = strip_tags($apell);
        $correo = strip_tags($email);
        $telefono = strip_tags($numerotel);
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
        $sql="select productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, estado.nombre, productosusuarios.cantidad, productosusuarios.costoUnitario, productosusuarios.costoTotal, productosusuarios.ubicacion, productosusuarios.fechaCreacion, productosusuarios.fechaFinal, usuarios.nombre, productosusuarios.idprod, productos.nombre from productosusuarios, usuarios, estado, productos where productosusuarios.idestado = estado.idestado and usuarios.iduser = productosusuarios.idusers and productos.idprod = productosusuarios.idprod order by idProductosUsuarios";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $prod = $this->x;
        unset($this->x);
        return $prod;
    }

    public function get_ProductosPrin(){
        $sql2="select productos.idprod, productos.nombre, tipoprod.nombretipo from productos, tipoprod where tipoprod.idtipo = productos.idtipo order by idprod";
        foreach ($this->conexion->query($sql2) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        if ($datos == 0){
            echo"<script>alert('Se presentan problemas con los productos disponibles')</script>";
            echo"<script type=\"text/javascript\">window.location='index'</script>";
        }else{
            unset($this->x);
            return $datos;
        }

    }

    public function find_ProdPrin($id){
        $sql = "select productos.idprod, productos.nombre, tipoprod.nombretipo from productos, tipoprod where productos.idprod= '$id' and tipoprod.idtipo = productos.idtipo order by idprod";
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
        </tr>
        </thead>
        <?php
        $rows = count($prod);
        for ($i = 0; $i < $rows; $i++) {
            ?>
            <tr>
                <td><?php echo $prod[$i][0] ?></td>
                <td><?php echo $prod[$i][1] ?></td>
                <td><?php echo $prod[$i][2] ?></td>
            </tr>
            <?php
        }
    }

    public function get_LlenarFormProdPrin($id){
        $sql = "select productos.idprod, productos.nombre, tipoprod.nombretipo from productos, tipoprod where productos.idprod= '$id' and tipoprod.idtipo = productos.idtipo order by idprod";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $data = $this->x;
        unset($this->x);
        return $data;
    }

    public function find_Prod($id){
        $sql = "select productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, estado.nombre, productosusuarios.cantidad, productosusuarios.costoUnitario, productosusuarios.costoTotal, productosusuarios.ubicacion, productosusuarios.fechaCreacion, productosusuarios.fechaFinal, usuarios.nombre, productosusuarios.idprod, productos.nombre, productosusuarios.idusers, productosusuarios.idprod from productosusuarios, usuarios, estado, productos where  productosusuarios.idproductosusuarios = '$id' and productosusuarios.idestado = estado.idestado and usuarios.iduser = productosusuarios.idusers and productos.idprod = productosusuarios.idprod order by idProductosUsuarios";
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
            <th>Nombre de Venta</th>
            <th>Estado Actual</th>
            <th>Cantidad (Kilos)</th>
            <th>Costo Unitario</th>
            <th>Costo Total</th>
            <th>Ubicación</th>
            <th>Fecha Creación</th>
            <th>Fecha Limite Venta</th>
            <th>Vendedor</th>
            <th>Producto Principal:</th>
        </tr>
        </thead>
        <?php
        $rows = count($prod);
        for ($i = 0; $i < $rows; $i++) {
            ?>
            <tr>
                <td><?php echo $prod[$i][0] ?></td>
                <td><?php echo $prod[$i][1] ?></td>
                <td><?php echo $prod[$i][2] ?></td>
                <td><?php echo number_format($prod[$i][3],0) ?></td>
                <td>$<?php echo number_format($prod[$i][4],0) ?>.00</td>
                <td>$<?php echo number_format($prod[$i][5],0) ?>.00</td>
                <td><?php echo $prod[$i][6] ?></td>
                <td><?php echo $prod[$i][7] ?></td>
                <td><?php echo $prod[$i][8] ?></td>
                <td><?php echo $prod[$i][9] ?></td>
                <td><?php echo $prod[$i][11] ?></td>
            </tr>
            <?php
        }
    }
    public function get_LlenarFormProd($id){
        $sql = "select productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, productosusuarios.idestado, productosusuarios.cantidad, productosusuarios.costoUnitario, productosusuarios.costoTotal, productosusuarios.ubicacion, productosusuarios.fechaCreacion, productosusuarios.fechaFinal, usuarios.nombre, productosusuarios.idprod, productos.nombre, productosusuarios.idusers from productosusuarios, usuarios, productos where  productosusuarios.idproductosusuarios = '$id' and usuarios.iduser = productosusuarios.idusers and productos.idprod = productosusuarios.idprod order by idProductosUsuarios";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $data = $this->x;
        unset($this->x);
        return $data;
    }

    public function update_ProductosPrin(){
        $idpro = $_POST["idproduc"];
        $nomprod = $_POST["nomprod"];
        $tipo = $_POST["tipo"];

        $sql = "UPDATE productos set nombre=?, idtipo=? WHERE idprod = '$idpro'";
        $envio = $this->conexion->prepare($sql);
        $nombre = strip_tags($nomprod);
        $idtipo = strip_tags($tipo);
        $envio->bindValue(1, $nombre, PDO::PARAM_STR);
        $envio->bindValue(2, $idtipo, PDO::PARAM_STR);

        $envio->execute();
        echo "<script>alert('Producto actualizado correctamente.')</script>";
    }

    public function update_Productos(){
        $idpro = $_POST["idproduc"];
        $nomprod = $_POST["nomprod"];
        $estado = $_POST["estadolist"];
        $ubicacion = $_POST["ubicacion"];
        $fechaF = $_POST["fechaF"];
        $prodP = $_POST["prodP"];
        $cant = $_POST["cant"];
        $cost = $_POST["costo"];
        $venta = $_POST["venta"];
        $idvendedor = $_POST["vendedoreslist"];

        $sql = "UPDATE productosusuarios set nombreproducto=?, cantidad=?, costounitario=?, costototal=?, ubicacion=?, fechafinal=?, idusers=?, idprod=?, idestado=? WHERE idproductosusuarios = '$idpro'";
        $envio = $this->conexion->prepare($sql);
        $nombre = strip_tags($nomprod);
        $est = strip_tags($estado);
        $cantid = strip_tags($cant);
        $costo = strip_tags($cost);
        $ven = strip_tags($venta);
        $ubic = strip_tags($ubicacion);
        $vendedorProd = strip_tags($idvendedor);
        $fechaFinal = strip_tags($fechaF);
        $idProdP = strip_tags($prodP);
        $envio->bindValue(1, $nombre, PDO::PARAM_STR);
        $envio->bindValue(2, $cantid, PDO::PARAM_STR);
        $envio->bindValue(3, $costo, PDO::PARAM_STR);
        $envio->bindValue(4, $ven, PDO::PARAM_STR);
        $envio->bindValue(5, $ubic, PDO::PARAM_STR);
        $envio->bindValue(6, $fechaFinal, PDO::PARAM_STR);
        $envio->bindValue(7, $vendedorProd, PDO::PARAM_STR);
        $envio->bindValue(8, $idProdP, PDO::PARAM_STR);
        $envio->bindValue(9, $est, PDO::PARAM_STR);

        $envio->execute();
        echo "<script>alert('Producto actualizado correctamente.')</script>";
    }
    public function create_log($iduser,$info,$i){
        $fecha = date( "Y-m-d", time() );
        $time = strftime( "%H:%M:%S", time() );
        if ($info == "Inicio de Sesión"){
            $sqlLOG = "INSERT INTO log VALUES (default, ?,?, DEFAULT ,?, ? );";
            $BD = $this->conexion->prepare($sqlLOG);
            $log = strip_tags($info);
            $user = strip_tags($iduser);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $hora, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $user, PDO::PARAM_STR);
            $BD->execute();
            $this->conexion = null;
        } elseif ($info == "Cerró Sesión"){
            $sqlLOG = "INSERT INTO log VALUES (default, ?,?, DEFAULT ,?, ? );";
            $BD = $this->conexion->prepare($sqlLOG);
            $log = strip_tags($info);
            $user = strip_tags($iduser);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $hora, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $user, PDO::PARAM_STR);
            $BD->execute();
            $this->conexion = null;
        } elseif ($info == "Creación de Producto a la Venta"){
            $sqlLOG = "INSERT INTO log VALUES (default, ?,?, DEFAULT ,?, ? );";
            $BD = $this->conexion->prepare($sqlLOG);
            $log = strip_tags($info);
            $user = strip_tags($iduser);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $hora, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $user, PDO::PARAM_STR);
            $BD->execute();
            $this->conexion = null;
            echo "<script type=\"text/javascript\">window.location='createProdV'</script>";
        } elseif($info == "Modificación de Producto de Usuario"){
            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,? ,?, ? );";
            $BD = $this->conexion->prepare($sqlLOG);
            $log = strip_tags($info);
            $user = strip_tags($iduser);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $id = strip_tags($i);
            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $hora, PDO::PARAM_STR);
            $BD->bindValue(3, $id, PDO::PARAM_STR);
            $BD->bindValue(4, $dia, PDO::PARAM_STR);
            $BD->bindValue(5, $user, PDO::PARAM_STR);
            $BD->execute();
            $this->conexion = null;
        } elseif ($info == "Eliminó un Producto de Usuario"){
            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?,?);";
            $BD = $this->conexion->prepare($sqlLOG);
            $log = strip_tags($info);
            $user = strip_tags($iduser);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $id = strip_tags($i);
            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $hora, PDO::PARAM_STR);
            $BD->bindValue(3, $id, PDO::PARAM_STR);
            $BD->bindValue(4, $dia, PDO::PARAM_STR);
            $BD->bindValue(5, $user, PDO::PARAM_STR);
            $BD->execute();
            $this->conexion = null;
            echo "<script type=\"text/javascript\">window.location='modProd'</script>";
        } elseif ($info == "Modificación de Compra"){
            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?,?);";
            $BD = $this->conexion->prepare($sqlLOG);
            $log = strip_tags($info);
            $user = strip_tags($iduser);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $id = strip_tags($i);
            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $hora, PDO::PARAM_STR);
            $BD->bindValue(3, $id, PDO::PARAM_STR);
            $BD->bindValue(4, $dia, PDO::PARAM_STR);
            $BD->bindValue(5, $user, PDO::PARAM_STR);
            $BD->execute();
            $this->conexion = null;
            echo "<script type=\"text/javascript\">window.location='modBuy'</script>";
        } elseif ($info == "Eliminó una Compra"){
            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?,?);";
            $BD = $this->conexion->prepare($sqlLOG);
            $log = strip_tags($info);
            $user = strip_tags($iduser);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $id = strip_tags($i);
            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $hora, PDO::PARAM_STR);
            $BD->bindValue(3, $id, PDO::PARAM_STR);
            $BD->bindValue(4, $dia, PDO::PARAM_STR);
            $BD->bindValue(5, $user, PDO::PARAM_STR);
            $BD->execute();
            $this->conexion = null;
            echo "<script type=\"text/javascript\">window.location='modBuy'</script>";
        }elseif ($info == "Creación de Producto Principal"){
            $sqlLOG = "INSERT INTO log VALUES (default, ?,?, DEFAULT ,?, ? );";
            $BD = $this->conexion->prepare($sqlLOG);
            $log = strip_tags($info);
            $user = strip_tags($iduser);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $hora, PDO::PARAM_STR);
            $BD->bindValue(3, $dia, PDO::PARAM_STR);
            $BD->bindValue(4, $user, PDO::PARAM_STR);
            $BD->execute();
            $this->conexion = null;
            echo "<script type=\"text/javascript\">window.location='createProdP'</script>";
        }elseif($info == "Modificación de Producto Principal"){
            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,? ,?, ? );";
            $BD = $this->conexion->prepare($sqlLOG);
            $log = strip_tags($info);
            $user = strip_tags($iduser);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $id = strip_tags($i);
            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $hora, PDO::PARAM_STR);
            $BD->bindValue(3, $id, PDO::PARAM_STR);
            $BD->bindValue(4, $dia, PDO::PARAM_STR);
            $BD->bindValue(5, $user, PDO::PARAM_STR);
            $BD->execute();
            $this->conexion = null;
        }elseif ($info == "Eliminó un Producto Principal"){
            $sqlLOG = "INSERT INTO log VALUES (default, ?,?,?,?,?);";
            $BD = $this->conexion->prepare($sqlLOG);
            $log = strip_tags($info);
            $user = strip_tags($iduser);
            $dia = strip_tags($fecha);
            $hora = strip_tags($time);
            $id = strip_tags($i);
            $BD->bindValue(1, $log, PDO::PARAM_STR);
            $BD->bindValue(2, $hora, PDO::PARAM_STR);
            $BD->bindValue(3, $id, PDO::PARAM_STR);
            $BD->bindValue(4, $dia, PDO::PARAM_STR);
            $BD->bindValue(5, $user, PDO::PARAM_STR);
            $BD->execute();
            $this->conexion = null;
            echo "<script type=\"text/javascript\">window.location='modProdPrin'</script>";
        }
    }
    public function get_logUser(){
        $sql="select log.* , nombre from log left join usuarios on usuarios.iduser = log.iduser";
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

    public function delete_ProdPrin(){
        $id = $_POST["idproduc"];
        if ($id == 0){
            echo "<script>alert('Busque primero el producto que desea eliminar.')</script>";
            echo "<script type=\"text/javascript\">window.location='modProdPrin'</script>";
        } else{
            $sql = "delete from productos WHERE idprod = ?";
            $envio = $this->conexion->prepare($sql);
            $envio->bindValue(1, $_POST["idproduc"], PDO::PARAM_STR);
            $envio->execute();
            echo "<script>alert('Producto principal eliminado correctamente.')</script>";
        }
    }

    public function delete_Prod(){
        $id = $_POST["idproduc"];
        if ($id == 0){
            echo "<script>alert('Busque primero el producto que desea eliminar.')</script>";
            echo "<script type=\"text/javascript\">window.location='modProd'</script>";
        } else{
            $sql = "delete from productosusuarios WHERE idproductosusuarios = ?";
            $envio = $this->conexion->prepare($sql);
            $envio->bindValue(1, $_POST["idproduc"], PDO::PARAM_STR);
            $envio->execute();
            echo "<script>alert('Producto de usuario eliminado correctamente.')</script>";
        }
    }
    public function find_Compra($id){
        $sql = "select compra.idcompra, valoraciones.nombreval, compra.infoval, compra.fecha, compra.hora, usuarios.nombre, productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, productosusuarios.ubicacion, compra.costo, compra.cantbuy, compra.observaciones, compra.u_iduser, productosusuarios.cantidad from compra, valoraciones, usuarios, productosusuarios where compra.idcompra = '$id' and compra.v_idvaloracion = valoraciones.idvaloracion and compra.pu_iduser = usuarios.iduser and productosusuarios.idproductosusuarios = compra.pu_idproduser order by compra.idcompra";
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
            <th>Nombre del Producto</th>
            <th>Cantidad Comprada (Kilos)</th>
            <th>Vendedor del Producto</th>
            <th>Valoración de Compra</th>
            <th>Detalle de Valoración</th>
            <th>Fecha de Compra</th>
            <th>Hora de Compra:</th>
            <th>Observación de Compra:</th>
            <th>Valor a Pagar:</th>
            <th>Id del Comprador:</th>
        </tr>
        </thead>
        <?php
        $rows = count($compra);
        for ($i = 0; $i < $rows; $i++){
            ?>
            <tr>
                <td align="center"><?php echo $compra[$i][0]; ?></td>
                <td align="center"><?php echo $compra[$i][6]; ?></td>
                <td align="center"><?php echo $compra[$i][7]; ?></td>
                <td align="center"><?php echo number_format($compra[$i][10],0); ?></td>
                <td align="center"><?php echo $compra[$i][5]; ?></td>
                <td align="center"><?php echo $compra[$i][1]; ?></td>
                <td align="center"><?php echo $compra[$i][2]; ?></td>
                <td align="center"><?php echo $compra[$i][3]; ?></td>
                <td align="center"><?php echo $compra[$i][4]; ?></td>
                <td align="center"><?php echo $compra[$i][11]; ?></td>
                <td align="center">$<?php echo number_format($compra[$i][9],0); ?>.00</td>
                <td align="center"><?php echo $compra[$i][12]; ?></td>
            </tr>
            <?php
        }
    }
    public function get_LlenarFormCompra($id){
        $sql = "select compra.idcompra, valoraciones.nombreval, compra.infoval, compra.fecha, compra.hora, usuarios.nombre, productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, productosusuarios.ubicacion, compra.costo, compra.cantbuy, compra.observaciones, compra.u_iduser, productosusuarios.cantidad from compra, valoraciones, usuarios, productosusuarios where compra.idcompra = '$id' and compra.v_idvaloracion = valoraciones.idvaloracion and compra.pu_iduser = usuarios.iduser and productosusuarios.idproductosusuarios = compra.pu_idproduser order by compra.idcompra";
        foreach ($this->conexion->query($sql) as $row) {
            $this->x[] = $row;
        }
        $compra = $this->x;
        unset($this->x);
        return $compra;
    }
    public function update_Compras(){
        $idcompra =$_POST["idcompra"];
        $cantidadcomprada = $_POST["cantcomprada"];
        $valoracion = $_POST["valoracion"];
        $infoval = $_POST["detval"];
        $observacion = $_POST["detcompra"];
        $comprador = $_POST["comprador"];

        $sql = "UPDATE compra set cantbuy=?, infoval=?, observaciones=?, u_iduser=?, v_idvaloracion=?  WHERE idcompra = '$idcompra'";
        $envio = $this->conexion->prepare($sql);
        $cantidad = strip_tags($cantidadcomprada);
        $valCompra = strip_tags($valoracion);
        $infoVal = strip_tags($infoval);
        $observ = strip_tags($observacion);
        $idcomprador = strip_tags($comprador);

        $envio->bindValue(1, $cantidad, PDO::PARAM_STR);
        $envio->bindValue(2, $infoVal, PDO::PARAM_STR);
        $envio->bindValue(3, $observ, PDO::PARAM_STR);
        $envio->bindValue(4, $idcomprador, PDO::PARAM_STR);
        $envio->bindValue(5, $valCompra, PDO::PARAM_STR);
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
        $sql = "SELECT * from valoraciones ORDER BY idvaloracion DESC ";
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
        $iduser = $_SESSION["iduser"];
        $name = $_POST["nombre"];
        $apell = $_POST["apellidos"];
        $email = $_POST["email"];
        $numerotel = $_POST["tel"];
        $dir = $_POST["dir"];
        $cedul = $_POST["numcc"];
        $sql = "UPDATE usuarios set nombre=?, apellido=?, correo=?, telefono=?, direccion=?, cedula=? WHERE iduser='$iduser'";
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
    public function get_ventasVendedor($iduser){
        $sql="select compra.idcompra, valoraciones.nombreval, compra.infoval, compra.fecha, compra.hora, usuarios.nombre, productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, productosusuarios.ubicacion, compra.costo, compra.cantbuy, compra.observaciones from compra, valoraciones, usuarios, productosusuarios where compra.pu_iduser = '$iduser' and compra.v_idvaloracion = valoraciones.idvaloracion and compra.pu_iduser = usuarios.iduser and productosusuarios.idproductosusuarios = compra.pu_idproduser order by compra.idcompra";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }

    public function get_datosuser($iduser){
        $sql="select * from usuarios where iduser = '$iduser'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasEne($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-01' AND pu_iduser= '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasFeb($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-02' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasMar($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-03' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasAbr($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-04' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasMay($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-05' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasJun($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-06' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasJul($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-07' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasAgo($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-08' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasSep($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-09' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasOct($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-10' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasNov($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-11' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasDic($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-12' AND pu_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasGlobales(){
        $año = $this->year;
        $sql="SELECT usuarios.iduser, count(compra.pu_iduser), usuarios.nombre FROM usuarios,compra WHERE compra.pu_iduser = usuarios.iduser AND to_char(fecha, 'YYYY') = '$año' GROUP BY usuarios.iduser";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesEne(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-01'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesFeb(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-02'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesMar(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-03'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesAbr(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-04'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesMay(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-05'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesJun(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-06'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public  function get_ventasGlobalesJul(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-07'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesAgo(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-08'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesSep(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-09'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesOct(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-10'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesNov(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-11'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ventasGlobalesDic(){
        $año = $this->year;
        $sql="select count(*) from compra WHERE to_char(fecha,'YYYY-MM') = '$año-12'";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_totalProductos(){
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM productosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_ubicacionProductos(){
        $sql="SELECT DISTINCT productosusuarios.ubicacion, count(productosusuarios.ubicacion) FROM productosusuarios GROUP BY productosusuarios.ubicacion";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_misCompras($iduser){
        $sql="select compra.idcompra, valoraciones.nombreval, compra.infoval, compra.fecha, compra.hora, usuarios.nombre, productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, productosusuarios.ubicacion, compra.costo, compra.cantbuy, compra.observaciones from compra, valoraciones, usuarios, productosusuarios where compra.u_iduser = '$iduser' and compra.v_idvaloracion = valoraciones.idvaloracion and compra.pu_iduser = usuarios.iduser and productosusuarios.idproductosusuarios = compra.pu_idproduser order by compra.idcompra";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $data = $this->x;
        if ($data == null){
            echo "<script>alert('No has realizado ninguna compra actualmente.')</script>";
            echo "<script type=\"text/javascript\">window.location='index'</script>";
        }
        return $this->x;
    }
    public function get_misProductos($iduser){
        $sql= "select productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, estado.nombre, productosusuarios.cantidad, productosusuarios.costoUnitario, productosusuarios.costoTotal, productosusuarios.ubicacion, productosusuarios.fechaCreacion, productosusuarios.fechaFinal, usuarios.nombre, productosusuarios.idprod from productosusuarios, usuarios, estado, productos where productosusuarios.idestado = estado.idestado and usuarios.iduser = productosusuarios.idusers and productos.idprod = productosusuarios.idprod and productosusuarios.idusers = '$iduser' order by idProductosUsuarios";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $data = $this->x;
        if ($data == null){
            echo "<script>alert('Actualmente no tienes ningun producto en la página.')</script>";
            echo "<script type=\"text/javascript\">window.location='index'</script>";
        }
        unset($this->x);
        return $data;
    }
    public function get_compradores(){
        $sql="SELECT * from usuarios where idtipousuario = 3 or idtipousuario=4 order by nombreuser ASC";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_comprasUser($iduser){
        $sql="select compra.idcompra, valoraciones.nombreval, compra.infoval, compra.fecha, compra.hora, usuarios.nombre, productosusuarios.idproductosusuarios, productosusuarios.nombreproducto, productosusuarios.ubicacion, compra.costo, compra.cantbuy, compra.observaciones from compra, valoraciones, usuarios, productosusuarios where compra.u_iduser = '$iduser' and compra.v_idvaloracion = valoraciones.idvaloracion and compra.pu_iduser = usuarios.iduser and productosusuarios.idproductosusuarios = compra.pu_idproduser order by compra.idcompra";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        return $datos;
    }
    public function get_comprasEne($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-01' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasFeb($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-02' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasMar($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-03' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasAbr($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-04' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasMay($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-05' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasJun($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-06' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasJul($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-07' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasAgo($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-08' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasSep($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-09' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasOct($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-10' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasNov($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-11' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_comprasDic($user){
        $año = $this->year;
        $users = $this->conexion->prepare("select * from compra WHERE to_char(fecha, 'YYYY-MM') = '$año-12' AND u_iduser = '$user'");
        $users->execute();
        $fetch = $users->fetchAll();
        if ($fetch == null){
            return 0;
        } else{
            $rows = count($fetch);
            return $rows;
        }
    }
    public function get_ventasProdEne($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-01' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdFeb($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-02' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdMar($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-03' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdAbr($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-04' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdMay($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-05' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdJun($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-06' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdJul($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-07' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdAgo($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-08' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdSep($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-09' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdOct($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-10' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdNov($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-11' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_ventasProdDic($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(compra.pu_idproduser) FROM compra, productosusuarios WHERE compra.pu_iduser = '$user' AND to_char(fecha, 'YYYY-MM') = '$año-12' and compra.pu_idproduser = productosusuarios.idproductosusuarios GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_comprasProdEne($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-01' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_comprasProdFeb($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-02' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_comprasProdMar($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-03' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_comprasProdAbr($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-04' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }
    public function get_comprasProdMay($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-05' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }

    public function get_comprasProdJun($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-06' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }

    public function get_comprasProdJul($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-07' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }

    public function get_comprasProdAgo($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-08' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }

    public function get_comprasProdSep($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-09' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }

    public function get_comprasProdOct($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-10' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }

    public function get_comprasProdNov($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-11' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }

    public function get_comprasProdDic($user){
        $año = $this->year;
        $sql="SELECT DISTINCT productosusuarios.nombreproducto, count(productosusuarios.nombreproducto) FROM compra, productosusuarios WHERE compra.u_iduser = '$user' and compra.pu_idproduser = productosusuarios.idproductosusuarios AND to_char(compra.fecha, 'YYYY-MM') = '$año-12' GROUP BY productosusuarios.nombreproducto";
        foreach ($this->conexion->query($sql) as $row){
            $this->x[]=$row;
        }
        $datos = $this->x;
        unset($this->x);
        if ($datos == null){
            $datos = 0;
            return $datos;
        }
        return $datos;
    }

    public function update_Pass($iduser){
        $pass =$_POST["newPass"];
        $encriptPass = md5($pass);
        $user =$_POST["iduser"];
        if ($iduser == $user){
            echo '<script>alert("No puedes cambiar tu propia contraseña, comunicate con otro administrador para realizar " +
                                "el respectivo cambio, gracias.")</script>';
            echo "<script type=\"text/javascript\">window.location='modInfo'</script>";
        } else{
            $sql = "UPDATE usuarios set pass = ? WHERE iduser ='$user'";
            $envio = $this->conexion->prepare($sql);
            $newPass = strip_tags($encriptPass);
            $envio->bindValue(1, $newPass, PDO::PARAM_STR);
            $envio->execute();
            echo '<script>alert("La contraseña del usuario '.$user.', ha sido actualizada.")</script>';
            echo "<script type=\"text/javascript\">window.location='modInfo'</script>";
        }
    }

    public function update_Tipo($iduser){
        $newTipo =$_POST["tiposlist"];
        $user =$_POST["iduser"];
        $sql2 = "select idtipousuario from tipousuarios where nombretipousuario = '$newTipo'";
        foreach ($this->conexion->query($sql2) as $row) {
            $this->x[] = $row;
        }
        $datos = $this->x;
        $tipousuario = $datos[0][0];
        if ($iduser == $user){
            echo '<script>alert("No puedes cambiar tu propio tipo de usuario, comunicate con otro administrador para realizar " +
                                "el respectivo cambio, gracias.")</script>';
            echo "<script type=\"text/javascript\">window.location='modInfo'</script>";
        } else{
            $sql = "UPDATE usuarios set idtipousuario=? WHERE iduser='$user'";
            $envio = $this->conexion->prepare($sql);
            $tipo = strip_tags($tipousuario);
            $envio->bindValue(1, $tipo, PDO::PARAM_STR);
            $envio->execute();
            echo '<script>alert("El tipo del usuario '.$user.', ha sido actualizado.")</script>';
            echo "<script type=\"text/javascript\">window.location='modInfo'</script>";
        }
    }
}
?>