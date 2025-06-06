<?php
include '../config/conexion.php';

// Verifica si la conexión es válida
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}


// Ejecuta la consulta para obtener los profesores
$sql = "SELECT * FROM profesores";
$result = $conexion->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conexion->error);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Asignación de Aulas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <img src="../img/CRUI_logo.png" alt="Logo CRUI" class="header-logo-absolute">
        
        <h1>Sistema de Asignación de Aulas</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="asignaciones.php">Asignaciones</a></li>
                <li><a href="materias.php">Materias</a></li>
                <li><a href="aulas.php">Aulas</a></li>
                <li><a href="#reportes">Reportes</a></li>
            </ul>
        </nav>
    </header>

     <section id="agregar-profesor">
                    <h2>Agregar Profesor</h2>
                   <form id="form-profesor"  method="POST" >
    <div class="form-group">
        <label for="profesor-nombre">Nombre:</label>
        <input type="text" id="profesor-nombre" name="nombre" placeholder="Nombre/s" required>
    </div>
    <div class="form-group">
        <label for="profesor-apellido">Apellido:</label>
        <input type="text" id="profesor-apellido" name="apellido" placeholder="Apellido/s" required>
    </div>
    <div class="form-group">
        <label for="profesor-legajo">Legajo:</label>
        <input type="text" id="profesor-legajo" name="legajo" placeholder="N° de legajo" required>
    </div>
    <div class="form-group">
        <label for="profesor-dni">DNI:</label>
        <input type="text" id="profesor-dni" name="dni" placeholder="Ejemplo:32345678" required>
    </div>
    <div class="form-group">
        <label for="profesor-direccion">Dirección:</label>
        <input type="text" id="profesor-direccion" name="direccion" placeholder="Av. Rivadavia  22234" required>
    </div>
    <div class="form-group">
        <label for="profesor-localidad">Localidad:</label>
        <input type="text" id="profesor-localidad" name="localidad" placeholder="Ituzaingó" required>
    </div>
    <div class="form-group">
        <label for="profesor-telefono">Telefono:</label>
        <input type="text" id="profesor-telefono" name="telefono" placeholder="11 3554 4555" required>
    </div>
    <div class="form-group">
        <label for="profesor-email">Email:</label>
     <input type="email" id="profesor-email" name="email" placeholder="ejemplo@email.com" required>
    </div>
    <button type="submit">Agregar Profesor</button>


</form>
                </section>


    <main class="container">
        <section id="asignaciones-actuales">
            <h2>Profesores</h2>
<table id="current-assignments-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Legajo</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["apellido"] . "</td>";
                echo "<td>" . $row["dni"] . "</td>";
                echo "<td>" . $row["legajo"] . "</td>";
                echo "<td>" . $row["direccion"] . "</td>";
                echo "<td>" . $row["telefono"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay profesores agregados.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php $conexion->close(); ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Instituto XYZ. Todos los derechos reservados.</p>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <script src="../js/script.js"></script>
</body>
</html>