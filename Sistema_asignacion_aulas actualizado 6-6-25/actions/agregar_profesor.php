<?php
include '../config/conexion.php'; // Conectamos a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $legajo = $_POST["legajo"];
    $direccion = $_POST["direccion"];
    $localidad = $_POST["localidad"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

    // Verificar si el DNI ya existe
    $checkDNI = "SELECT id FROM profesores WHERE dni = '$dni'";
    $resultDNI = $conexion->query($checkDNI);

    // Verificar si el Email ya existe
    $checkEmail = "SELECT id FROM profesores WHERE email = '$email'";
    $resultEmail = $conexion->query($checkEmail);

    // Validaciones antes de la inserción
    if ($resultDNI->num_rows > 0) {
        echo "❌ Error: El profesor con DNI $dni ya está registrado.";
        exit();
    }

    if ($resultEmail->num_rows > 0) {
        echo "❌ Error: El email $email ya está registrado.";
        exit();
    }

    if (empty($email)) {
        echo "❌ Error: El campo email no puede estar vacío.";
        exit();
    }

    // Insertar el profesor si pasa las validaciones
    $sql = "INSERT INTO profesores (nombre, apellido, dni, legajo, direccion, localidad, telefono, email) 
            VALUES ('$nombre', '$apellido', '$dni', '$legajo', '$direccion', '$localidad', '$telefono', '$email')";

    if ($conexion->query($sql) === TRUE) {
        echo "✅ Profesor agregado correctamente.";
    } else {
        echo "❌ Error al intentar agregar profesor: " . $conexion->error;
    }

    // Cerrar la conexión al final
    $conexion->close();
}
?>
