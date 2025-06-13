<?php
include '../config/conexion.php';

header("Content-Type: application/json");

// Validar conexión
if (!$conexion) {
    echo json_encode(["error" => "Error en la conexión a la base de datos"]);
    exit;
}

// Obtener el parámetro día, asegurando que no sea vacío o inválido
$dia = isset($_GET['dia']) && !empty($_GET['dia']) ? $_GET['dia'] : "Todas";

// Construcción dinámica de la consulta con `TIME_FORMAT` para eliminar los segundos
$query = "SELECT id, carrera, anio, materia, profesor, aula, 
                 TIME_FORMAT(hora_inicio, '%H:%i') AS hora_inicio, 
                 TIME_FORMAT(hora_fin, '%H:%i') AS hora_fin 
          FROM asignaciones";

// Si el día no es "Todas", filtramos por día
if ($dia !== "Todas") {
    $query .= " WHERE dia = ?";
}

// Ordenar por hora de inicio
$query .= " ORDER BY hora_inicio";

// Preparar la consulta
$stmt = $conexion->prepare($query);

if (!$stmt) {
    echo json_encode(["error" => "Error al preparar la consulta: " . $conexion->error]);
    exit;
}

// Vincular parámetros si se recibe un día válido
if ($dia !== "Todas") {
    $stmt->bind_param("s", $dia);
}

// Ejecutar la consulta y verificar errores
if (!$stmt->execute()) {
    echo json_encode(["error" => "Error al ejecutar la consulta: " . $stmt->error]);
    exit;
}

$resultado = $stmt->get_result();
$asignaciones = [];

// Procesar resultados
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $asignaciones[] = $fila;
    }
} else {
    echo json_encode(["error" => "No se encontraron asignaciones"]);
    exit;
}

// Enviar la respuesta en formato JSON
echo json_encode($asignaciones);
?>