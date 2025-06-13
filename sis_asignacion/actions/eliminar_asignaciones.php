<?php
include '../config/conexion.php';

header("Content-Type: application/json");

// Obtener los datos de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['ids']) || !is_array($data['ids']) || empty($data['ids'])) {
    echo json_encode(["error" => "No se recibieron IDs válidos"]);
    error_log("Error: IDs no recibidos correctamente.");
    exit;
}

$ids = $data['ids'];
error_log("IDs recibidos: " . implode(", ", $ids));

// Construcción de la consulta
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$query = "DELETE FROM asignaciones WHERE id IN ($placeholders)";

// Preparar la consulta
$stmt = $conexion->prepare($query);
if (!$stmt) {
    echo json_encode(["error" => "Error al preparar la consulta: " . $conexion->error]);
    exit;
}

// Vincular parámetros y ejecutar consulta
$stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
$stmt->execute();

// Manejo de respuesta según filas afectadas
if ($stmt->affected_rows > 0) {
    echo json_encode(["success" => "Asignaciones eliminadas"]);
} else {
    echo json_encode(["error" => "No se encontraron las asignaciones para eliminar"]);
}

// Cerrar la consulta
$stmt->close();
$conexion->close();
?>