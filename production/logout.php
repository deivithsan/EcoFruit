<?php
session_start();
require_once "../conexion.php";
$iduser = $_SESSION["iduser"];
$info = "Cerró Sesión";
$admin = new Admin();
$admin->create_log($iduser, $info, $i = null);
session_unset();
echo '<script> window.location="../index"; </script>';
?>