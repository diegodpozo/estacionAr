<?php
include '../config/conexion.php';

// Verifica si la conexión es válida
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
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
                <li><a href="pantalla.php">Pantalla</a></li>
       
         
            </ul>
        </nav>
    </header>

    <main class="container">
         <main class="container">
        <section id="asignaciones-actuales">
            <h2>Aulas</h2>
<table id="current-assignments-table">
    <thead>
        <tr>
            <th>Piso</th>
            <th>Nombre</th>
            <th>Capacidad</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["piso"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["capacidad"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay aulas registradas.</td></tr>";
        }
        ?>
    </tbody>
</table>


        <section id="mapa-imagen-interactivo">
            <h2>Mapa de Aulas del Instituto</h2>
            <p>Haz clic en las aulas para ver sus detalles o asignar una clase.</p>
            <div class="mapa-completo">
                <img src="../img/1P_FINAL.jpg" alt="Plano del Instituto" usemap="#mapaulas">
                <map name="mapaulas">
                    <area shape="rect" coords="887,143,1093,313" alt="Aula 1" href="#asignar-aula" data-aula="Aula 1" title="Aula 1">
                    <area shape="rect" coords="1114,142,1306,315" alt="Aula 2" href="#asignar-aula" data-aula="Aula 2" title="Aula 2">
                    <area shape="rect" coords="1330,140,1523,313" alt="Aula 3" href="#asignar-aula" data-aula="Aula 3" title="Aula 3">
                    <area shape="rect" coords="1323,680,1520,845" alt="Aula 4" href="#asignar-aula" data-aula="Aula 4" title="Aula 4">
                    <area shape="rect" coords="1119,679,1315,847" alt="Aula 5" href="#asignar-aula" data-aula="Aula 5" title="Aula 5">
                    <area shape="rect" coords="910,681,1106,846" alt="Aula 6" href="#asignar-aula" data-aula="Aula 6" title="Aula 6">
                    <area shape="rect" coords="410,143,584,312" alt="Sala de Docentes" href="#asignar-aula" data-aula="Sala de Docentes" title="Sala de Docentes">
                    <area shape="rect" coords="415,530,580,660" alt="Baño Izquierdo" href="#" data-aula="Baño Izquierdo" title="Baño Izquierdo">
                    <area shape="rect" coords="600,530,765,660" alt="Baño Derecho" href="#" data-aula="Baño Derecho" title="Baño Derecho">
                    <area shape="rect" coords="205,530,370,845" alt="Escaleras" href="#" data-aula="Escaleras" title="Escaleras">
                </map>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Instituto XYZ. Todos los derechos reservados.</p>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>