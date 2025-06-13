<?php
include '../config/conexion.php';

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
                <li><a href="aulas.php">Aulas</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
      <h2>Asignaciones de Hoy</h2>
<table id="asignaciones-del-dia" class="tab-content">
    <thead>
        <tr>
            <th>Carrera</th>
            <th>Año</th>
            <th>Materia</th>
            <th>Profesor</th>
            <th>Aula</th>
            <th>Horario</th>
        </tr>
    </thead>
    <tbody id="tabla-asignaciones"></tbody>
</table>
    </main>

    <footer>
        <p>&copy; 2025 Instituto XYZ. Todos los derechos reservados.</p>
    </footer>
   
    
    <script src="../js/asig-del-dia.js"></script>
    
</body>
</html>