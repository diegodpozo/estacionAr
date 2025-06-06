


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
                <li><a href="materias.php">Materias</a></li>
                <li><a href="aulas.php">Aulas</a></li>
                <li><a href="#reportes">Reportes</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
   

        <section id="asignaciones-actuales">
            <h2>Asignaciones</h2>
            <div class="view-options">
                <button class="view-btn active" data-view="day">Día</button>
                <button class="view-btn" data-view="week">Semana</button>
                <button class="view-btn" data-view="month">Mes</button>
            </div>
            <table id="current-assignments-table">
                <thead>
                    <tr>
                        <th>Turno</th>
                        <th>Carrera</th>
                        <th>Curso</th>
                        <th>Aula</th>
                        <th>Materia</th>
                        <th>Profesor</th>
                        <th>Horario</th>
                        <th>Capacidad</th>
                    </tr>
                </thead>
                <tbody>
                    </tbody>
            </table>
            <p id="no-asignaciones-msg">No hay asignaciones para mostrar en esta vista.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Instituto XYZ. Todos los derechos reservados.</p>
    </footer>

     <script src="../js/script.js"></script>
</body>
</html>