<?php
function get_aulas() {
    include '../config/conexion.php'; // Conexión a la base de datos

    $query = "SELECT nombre FROM aulas";
    $result = $conexion->query($query);

    if (!$result) {
        die("Error en la consulta: " . $conexion->error);
    }

    $aulas = [];
    while ($row = $result->fetch_assoc()) {
        $aulas[] = $row['nombre'];
    }

    return $aulas;
}
?>
