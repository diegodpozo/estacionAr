<?php
include '../config/conexion.php'; // Conexión a la base de datos

header("Content-Type: application/json"); // Indicar que la respuesta será JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar los datos del formulario correctamente
    $dia = $_POST['dia'];
    $turno = ucwords(strtolower(trim($_POST['turno'])));
    $carrera = ucwords(strtolower(trim($_POST['carrera'])));
    $anio = intval($_POST['anio']);
    $materia = ucwords(strtolower(trim($_POST['materia'])));
    $profesor = ucwords(strtolower(trim($_POST['profesor'])));
    $aula = $_POST['aula'];
    $hora_inicio = date("H:i", strtotime($_POST['hora_inicio']));
    $hora_fin = date("H:i", strtotime($_POST['hora_fin']));

    // Validación de horario según turno
    $validacion_horario = false;

    if ($hora_inicio < $hora_fin && (
        ($turno === "Matutino" && $hora_inicio >= "00:00" && $hora_fin <= "13:00") ||
        ($turno === "Vespertino" && $hora_inicio >= "13:00" && $hora_fin <= "18:00") ||
        ($turno === "Nocturno" && $hora_inicio >= "18:00" && $hora_fin <= "23:59")
    )) {
        $validacion_horario = true;
    }

    if (!$validacion_horario) {
        echo json_encode(["status" => "error", "message" => "Error: El horario seleccionado no corresponde al turno o la hora de inicio es mayor a la de fin."]);
        exit;
    }

    $query_check = "SELECT COUNT(*) FROM asignaciones 
                WHERE dia = ? AND aula = ? 
                AND ((hora_inicio < ? AND hora_fin > ?) 
                OR (hora_inicio < ? AND hora_fin > ?) 
                OR (? > hora_inicio AND ? < hora_fin))";


    $stmt_check = $conexion->prepare($query_check);
    if (!$stmt_check) {
        echo json_encode(["status" => "error", "message" => "Error en la validación de horarios: " . $conexion->error]);
        exit;
    }

    $stmt_check->bind_param("ssssssss", $dia, $aula, $hora_inicio, $hora_fin, $hora_inicio, $hora_fin, $hora_inicio, $hora_fin);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        echo json_encode(["status" => "error", "message" => "Error: Esta aula ya tiene una asignación en un horario que se superpone."]);
        exit;
    }

    // Inserción de la nueva asignación
    $query = "INSERT INTO asignaciones (dia, turno, anio, carrera, materia, profesor, aula, hora_inicio, hora_fin) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Error en la preparación de la consulta: " . $conexion->error]);
        exit;
    }

    $stmt->bind_param("ssissssss", $dia, $turno, $anio, $carrera, $materia, $profesor, $aula, $hora_inicio, $hora_fin);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Asignación registrada correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar la asignación: " . $stmt->error]);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido."]);
}
?>