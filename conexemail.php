<?php
session_start();
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

$result=pg_query($cnx, "INSERT INTO public.mensajes (nombre, telefono, mensaje) VALUES('$name', $tel, '$msg');");

		 var_dump($result);
		 header('Location: index.php');
		 pg_close($cnx);

?>
