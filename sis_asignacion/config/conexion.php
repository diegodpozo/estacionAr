<?php
$host = 'localhost';
$user = 'root'; // por defecto en XAMPP
$password = ''; // en XAMPP, suele estar vacío
$dbname = 'sis_asignacion';

$conexion = new mysqli("localhost", "root", "", "sis_asignacion");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>