<?php
function get_turnos() {
    include '../config/conexion.php'; // Conexión a la base de datos

    $query = "SELECT id, turno FROM turnos"; 
    $result = $conexion->query($query);

    if (!$result) {
        die("Error en la consulta: " . $conexion->error);
    }

    $turnos = [];
    while ($row = $result->fetch_assoc()) {
        $turnos[] = $row; // Guardamos el ID y el turno en el array
    }

    return $turnos;
}
?>
