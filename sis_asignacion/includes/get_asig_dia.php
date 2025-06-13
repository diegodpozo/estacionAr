<?php
include '../config/conexion.php'; // Conexión a la base de datos

header("Content-Type: application/json"); // Respuesta en JSON

// Obtener el día actual (de lunes a sábado)
$diasSemana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
$diaActual = $diasSemana[date("N") - 1]; // `N` devuelve el número de día (1=Lunes, 7=Domingo)

if ($diaActual) {
    // 🔄 Aplicamos `TIME_FORMAT` para eliminar los segundos de la hora
    $query = "SELECT id, carrera, anio, materia, profesor, aula, 
                     TIME_FORMAT(hora_inicio, '%H:%i') AS hora_inicio, 
                     TIME_FORMAT(hora_fin, '%H:%i') AS hora_fin 
              FROM asignaciones WHERE dia = ?";
    
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $diaActual);
    $stmt->execute();
    $result = $stmt->get_result();

    $asignaciones = [];
    while ($fila = $result->fetch_assoc()) {
        $asignaciones[] = $fila;
    }

    echo json_encode($asignaciones);
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Hoy es domingo, no hay asignaciones."]);
}

$conexion->close();
?>