<?php
include '../config/conexion.php';
include '../includes/get_aulas.php'; // Asegúrate de que la función esté accesible
include '../includes/get_turnos.php';

$turnos = get_turnos();
$aulas = get_aulas(); // Obtener aulas desde la función
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
                <li><a href="materias.php">Materias</a></li>
                <li><a href="aulas.php">Aulas</a></li>
                <li><a href="#reportes">Reportes</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="content-wrapper">
            <div class="main-content">
                <section id="asignar-aula">
                    <h2>Asignar Aula</h2>
                     <div class="form-group">
                            <label for="turno-asignar">Turno:</label>
                            <select id="turno-asignar" required>
                                <option value="">Seleccione un turno</option>
                                  <?php
        foreach ($turnos as $turno) {
            echo "<option value='{$turno['id']}'>{$turno['turno']}</option>";
        }
        ?>


                                </select>
                        </div>
                         <div class="form-group">
                            <label for="carrera-asignar">Carrera:</label>
                            <select id="carrera-asignar" required>
                                <option value="">Seleccione una carrera</option>
                                </select>
                        </div>
                         <div class="form-group">
                            <label for="anio-asignar">Año:</label>
                            <select id="anio-asignar" required>
                                <option value="">Seleccione una año</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="materia-asignar">Materia:</label>
                            <select id="materia-asignar" required>
                                <option value="">Seleccione una materia</option>
                                </select>
                        </div>
                    <form id="assign-form">
                        <div class="form-group">
                            <label for="profesor-asignar">Profesor:</label>
                            <select id="profesor-asignar" required>
                                <option value="">Seleccione un profesor</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
    <label for="aula-asignar">Aula:</label>
    <select id="aula-asignar" required>
        <option value="">Seleccione un aula</option>
        <?php
        foreach ($aulas as $aula) {
            echo "<option value='$aula'>$aula</option>";
        }
        ?>
    </select>
</div>


            
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="todo-el-ano">
                            <label for="todo-el-ano"> Asignar para todo el año</label>
                        </div>

                        <div id="temporal-assignment-fields">
                            <div class="form-group">
                                <label for="fecha-asignar">Fecha:</label>
                                <input type="date" id="fecha-asignar" required>
                            </div>
                            <div class="form-group">
                                <label for="hora-inicio-asignar">Hora de Inicio:</label>
                                <input type="time" id="hora-inicio-asignar" required>
                            </div>
                            <div class="form-group">
                                <label for="hora-fin-asignar">Hora de Fin:</label>
                                <input type="time" id="hora-fin-asignar" required>
                            </div>
                        </div>

                        <div id="annual-assignment-fields" style="display: none;">
                            <div class="form-group">
                                <label>Días de la Semana:</label>
                                <div class="days-of-week-checkboxes">
                                    <label><input type="checkbox" name="annual-day" value="Lunes"> Lun</label>
                                    <label><input type="checkbox" name="annual-day" value="Martes"> Mar</label>
                                    <label><input type="checkbox" name="annual-day" value="Miércoles"> Mié</label>
                                    <label><input type="checkbox" name="annual-day" value="Jueves"> Jue</label>
                                    <label><input type="checkbox" name="annual-day" value="Viernes"> Vie</label>
                                    <label><input type="checkbox" name="annual-day" value="Sábado"> Sáb</label>
                                    <label><input type="checkbox" name="annual-day" value="Domingo"> Dom</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="annual-hora-inicio">Hora de Inicio (Anual):</label>
                                <input type="time" id="annual-hora-inicio">
                            </div>
                            <div class="form-group">
                                <label for="annual-hora-fin">Hora de Fin (Anual):</label>
                                <input type="time" id="annual-hora-fin">
                            </div>
                        </div>
                        <button type="submit">Asignar Aula</button>
                    </form>
                </section>
            </div>
    </main>

    <footer>
        <p>&copy; 2025 Instituto XYZ. Todos los derechos reservados.</p>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>