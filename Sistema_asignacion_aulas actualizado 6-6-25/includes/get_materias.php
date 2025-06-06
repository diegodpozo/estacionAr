<?php
include '../config/conexion.php';

header("Content-Type: application/json");

$sql = "SELECT id, materia FROM materias";
$result = $conexion->query($sql);

if (!$result) {
    echo json_encode(["error" => "❌ Error en la consulta: " . $conexion->error]);
    exit();
}

$materias = [];
while ($row = $result->fetch_assoc()) {
    $materias[] = $row;
}

echo json_encode($materias);
?>
