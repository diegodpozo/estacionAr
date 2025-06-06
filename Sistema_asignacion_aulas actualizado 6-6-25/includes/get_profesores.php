<?php
include '../config/conexion.php';

// Configurar encabezado para devolver JSON
header("Content-Type: application/json");

// Consulta de profesores
$sql = "SELECT id, nombre, apellido FROM profesores";
$result = $conexion->query($sql);

// Verificar si hay errores en la consulta
if (!$result) {
    echo json_encode(["error" => "❌ Error en la consulta: " . $conexion->error]);
    exit();
}

// Convertir resultados a un array
$profesores = [];
while ($row = $result->fetch_assoc()) {
    $profesores[] = $row;
}

// Enviar respuesta JSON
echo json_encode($profesores);
?>
