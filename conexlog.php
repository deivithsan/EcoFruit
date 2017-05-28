<?php
session_start();
$host = 'localhost';
$user = 'postgres';
$passwd = 'liz6625382';
$db = 'postgres';
$port = '5432';
$strCnx = "host=$host port=$port dbname=$db user=$user password=$passwd sslmode='allow'" ;
$cnx = pg_connect($strCnx) or die (print "Error de conexion. ");
$nom = $_POST["nomusuario"];
$password = $_POST["pass"];
$pasencrip = md5($password);

if (empty($nom) & empty($pasencrip)){

echo "Campos vacios";
	}else{
	$sql = "SELECT nombreuser,contraseña FROM public.usuarios WHERE nombreuser='$nom' and contraseña ='$pasencrip'";
	$busqueda=pg_query($sql);
	$compara = pg_fetch_array($busqueda);
		if ($compara["nombreuser"] ==$nom && $compara["contraseña"]==$pasencrip){
			$_SESSION["user"] = $compara['nombreuser'];
		$sqlpriv = "SELECT privilegio.privil FROM public.usuarios, public.privilegio WHERE usuarios.nombreuser = '$nom' and usuarios.privilegio=privilegio.privil";
				$busprov = pg_query($sqlpriv);
				$igual = pg_fetch_array($busprov);
				$_SESSION["privil"] = $igual['privil'];
					if ($igual["privil"]== 1){
					header('Location: production/index.php');
					}elseif ($igual["privil"]== 2){
						header('Location: comprador.php');
					}elseif ($igual["privil"]== 3){
						header('Location: vendedor.php');
						}
						}else{
						header ('Location: logerror.php');
							}
								}
									pg_close($cnx);
?>
