<?php
include '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carrera = $_POST["carrera"];
    $anio = intval($_POST["anio"]); // Convierte a número entero
    $materia = $_POST["materia"];

    // Validar que anio sea mayor que 0
    if ($anio <= 0) {
        echo "❌ Error: El campo año debe ser un número válido.";
        exit();
    }

    // Verificar si la materia ya existe
    $stmt = $conexion->prepare("SELECT COUNT(*) FROM materias WHERE carrera = ? AND anio = ? AND materia = ?");
    $stmt->bind_param("sis", $carrera, $anio, $materia);
    $stmt->execute();
    $stmt->bind_result($cantidad);
    $stmt->fetch();

    if ($cantidad > 0) {
        echo "❌ Error: La materia ya está registrada.";
        exit();
    }

    $stmt->close(); // Cerrar consulta previa

    // Insertar la materia con consulta preparada
    $stmt = $conexion->prepare("INSERT INTO materias (carrera, anio, materia) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $carrera, $anio, $materia);

   if ($stmt->execute()) {
    echo "✅ Materia agregada correctamente.";
} else {
    echo "❌ Error en la inserción: " . $conexion->error;
}
exit(); // Asegura que el mensaje se envía sin cambiar de página

    $stmt->close();
}

$conexion->close(); // Cerrar conexión global
?>
