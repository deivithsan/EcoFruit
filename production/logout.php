<?php
session_start();
require_once "../conexion.php";
$nom = $_SESSION["user"];
$info = "Cerró Sesión";
$admin = new Admin();
$admin->create_log($nom, $info, $i = null);
session_unset();
echo '<script> window.location="../index"; </script>';
?>