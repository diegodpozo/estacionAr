<?php
include '../config/conexion.php';

header("Content-Type: application/json");

// Obtener los datos de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

// Registrar los datos recibidos en el log
error_log("Datos recibidos: " . json_encode($data));

if (!isset($data['id'], $data['turno'], $data['carrera'], $data['profesor'], $data['materia'], $data['hora_inicio'], $data['hora_fin'])) {
    echo json_encode(["error" => "Datos incompletos"]);
    exit;
}

// Preparar la consulta
$stmt = $conexion->prepare("
    UPDATE asignaciones 
    SET turno = ?, dia = ?, carrera = ?, anio = ?, profesor = ?, materia = ?, aula = ?, hora_inicio = ?, hora_fin = ? 
    WHERE id = ?
");

if (!$stmt) {
    error_log("Error al preparar la consulta: " . $conexion->error);
    echo json_encode(["error" => "Error al preparar la consulta"]);
    exit;
}

// Vincular parámetros y ejecutar consulta
$stmt->bind_param(
    "sssisssssi",
    $data['turno'],
    $data['dia'],
    $data['carrera'],
    $data['anio'],
    $data['profesor'],
    $data['materia'],
    $data['aula'],
    $data['hora_inicio'],
    $data['hora_fin'],
    $data['id']
);

$stmt->execute();

// Registrar el número de filas afectadas
error_log("Filas afectadas: " . $stmt->affected_rows);

if ($stmt->affected_rows > 0) {
    echo json_encode(["success" => "Asignación actualizada correctamente"]);
} else {
    echo json_encode(["error" => "No se realizaron cambios"]);
}

$stmt->close();
$conexion->close();
?>