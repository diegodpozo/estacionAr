<?php
include '../config/conexion.php'; // Conecta la base de datos

// Verifica si la conexión es válida
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Ejecuta la consulta para obtener las materias
$sql = "SELECT * FROM materias";
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
                <li><a href="profesores.php">Profesores</a></li>
                <li><a href="asignaciones.php">Asignaciones</a></li>
                <li><a href="aulas.php">Aulas</a></li>
                <li><a href="#reportes">Reportes</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
                <section id="agregar-materia">
                    <h2>Agregar Materia</h2>
                    <form id="add-materia-form" action="agregar_materia.php" method="POST">
                          <div class="form-group">
        <label for="materia-carrera">Carrera:</label>
        <input type="text" id="materia-carrera" name="carrera" placeholder="Carrera" required>
    </div>
    <div class="form-group">
        <label for="materia-anio">Año:</label>
      <input type="number" id="materia-anio" name="anio" placeholder="N° de año" required>
    </div>
    <div class="form-group">
        <label for="materia-materia">Materia:</label>
        <input type="text" id="materia-materia" name="materia" placeholder="Materia" required>
    </div>
    <button type="submit">Agregar Materia</button>
</form>
        <section id="asignaciones-actuales">
            <h2>Listado de materias</h2>
<table id="current-assignments-table">
    <thead>
        <tr>
            <th>Carrera</th>
            <th>Año</th>
            <th>Materia</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["carrera"] . "</td>";
                echo "<td>" . $row["anio"] . "</td>";
                echo "<td>" . $row["materia"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay materias registradas.</td></tr>";
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