<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "validar";

$conexion=mysqli_connect("localhost","root","","validar") or die("error conexion");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>