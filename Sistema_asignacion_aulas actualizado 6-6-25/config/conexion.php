<?php
$host = 'localhost';
$user = 'root'; // por defecto en XAMPP
$password = ''; // en XAMPP, suele estar vacío
$dbname = 'gestion_aulas';

$conexion = new mysqli("localhost", "root", "", "gestion_aulas");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>