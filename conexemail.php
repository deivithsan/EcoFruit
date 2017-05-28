<?php
session_start();
date_default_timezone_set('America/Bogota');
$host = 'ec2-54-243-200-159.compute-1.amazonaws.com';
$user = 'ithxzpubsdyssh';
$passwd = 'yzRs8R1aJkymNawqYGJkS_4ySJ';
$db = 'd3q71k9f5t7k2c';
$port = '5432';
$strCnx = "host=$host port=$port dbname=$db user=$user password=$passwd sslmode='allow'" ;
$cnx = pg_connect($strCnx) or die (print "Error de conexion. ");

$name = $_POST["name"];
$numerotel = $_POST["tel"];
$msg = $_POST["message"];
$tel = (int) $numerotel;
$fecha = date( "Y/m/d", time() );
$hora = strftime( "%H:%M:%S", time() );

$result=pg_query($cnx, "INSERT INTO public.mensajes (nombre, telefono, mensaje, fecha, hora) VALUES('$name', $tel, '$msg', '$fecha', '$hora');");
echo"<script>alert('Mensaje enviado correctamente')</script>";

         echo"<script type=\"text/javascript\">window.location='index.php'</script>";
		 pg_close($cnx);
?>
