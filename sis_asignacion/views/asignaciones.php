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
                <li><a href="aulas.php">Aulas</a></li>
                <li><a href="pantalla.php">Pantalla</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section id="asignaciones-actuales">
            <div class="view-options">
                <button class="view-btn" data-view="Lunes">Lunes</button>
                <button class="view-btn" data-view="Martes">Martes</button>
                <button class="view-btn" data-view="Miercoles">Miércoles</button>
                <button class="view-btn" data-view="Jueves">Jueves</button>
                <button class="view-btn" data-view="Viernes">Viernes</button>
                <button class="view-btn" data-view="Sabado">Sábado</button>
                <button class="view-btn" data-view="Todas">Todas</button>
            </div>

            <!-- Solapas para asignaciones -->
            <div class="tab-container">
                <button class="tab-btn active" data-tab="matutinas">Matutinas</button>
                <button class="tab-btn" data-tab="vespertinas">Vespertinas</button>
                <button class="tab-btn" data-tab="nocturnas">Nocturnas</button>
            </div>

            <div id="tab-content-matutinas" class="tab-content active">
                <h2>Asignaciones Matutinas</h2>
                <table id="asignaciones-matutinas">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>Carrera</th>
                            <th>Año</th>
                            <th>Materia</th>
                            <th>Profesor</th>
                            <th>Aula</th>
                            <th>Horario</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <button class="eliminar-seleccionadas" data-turno="matutinas">Eliminar</button>
                <button class="editar-seleccionadas" data-turno="matutinas">Editar</button>
            </div>

            <div id="tab-content-vespertinas" class="tab-content">
                <h2>Asignaciones Vespertinas</h2>
                <table id="asignaciones-vespertinas">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>Carrera</th>
                            <th>Año</th>
                            <th>Materia</th>
                            <th>Profesor</th>
                            <th>Aula</th>
                            <th>Horario</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <button class="eliminar-seleccionadas" data-turno="vespertinas">Eliminar</button>
                <button class="editar-seleccionadas" data-turno="vespertinas">Editar</button>
            </div>

            <div id="tab-content-nocturnas" class="tab-content">
                <h2>Asignaciones Nocturnas</h2>
                <table id="asignaciones-nocturnas">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>Carrera</th>
                            <th>Año</th>
                            <th>Materia</th>
                            <th>Profesor</th>
                            <th>Aula</th>
                            <th>Horario</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <button class="eliminar-seleccionadas" data-turno="nocturnas">Eliminar</button>
                <button class="editar-seleccionadas" data-turno="nocturnas">Editar</button>
            </div>

            <p id="no-asignaciones-msg">No hay asignaciones para mostrar en esta vista.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Instituto XYZ. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="../js/asignaciones.js"></script>
    <script src="../js/interacciones.js"></script>
    <script src="../js/alert-asignaciones.js"></script>
    <script src="../js/editar-asignaciones.js"></script>
    
</body>
</html>