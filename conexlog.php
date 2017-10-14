<?php
session_start();
$host = 'ec2-54-243-200-159.compute-1.amazonaws.com';
$user = 'ithxzpubsdyssh';
$passwd = 'yzRs8R1aJkymNawqYGJkS_4ySJ';
$db = 'd3q71k9f5t7k2c';
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
		$sqlpriv = "SELECT tipousuario FROM public.usuarios WHERE nombreuser = '$nom'";
				$busprov = pg_query($sqlpriv);
				$igual = pg_fetch_array($busprov);
				$_SESSION["privil"] = $igual['tipousuario'];
					if ($igual["tipousuario"]== 1){
					header('Location: production/index.php');
					}elseif ($igual["tipousuario"]== 3 or 4){
						header('Location: index.php');
					}
						}else{
						header ('Location: logerror.php');
							}
								}
									pg_close($cnx);
?>
