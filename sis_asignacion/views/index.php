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
                <li><a href="index.html">Inicio</a></li>
             
                <li><a href="asignaciones.php">Asignaciones</a></li>
                <li><a href="aulas.php">Aulas</a></li>
                <li><a href="pantalla.php">Pantalla</a></li>
           
            </ul>
        </nav>
    </header>
    

    <main class="container">
        <div class="content-wrapper">
            <div class="main-content">
                <section id="asignar-aula">
                    <h2>Asignar Aula</h2>
                       <form id="assign-form" action="../actions/agregar_asignaciones.php" method="POST">
                        <div class="form-group">
                            <label for="dia-asignar">Día:</label>
                            <select id="dia-asignar" name="dia" required>
                                <option value="">Seleccione un día</option>
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles">Miercoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sabado</option>                             
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="turno-asignar">Turno:</label>
                           <select id="turno-asignar" name="turno" required>
                                <option value="">Seleccione un turno</option>
                                <option value="Matutino">Matutino</option>
                                <option value="Vespertino">Vespertino</option>
                                 <option value="Nocturno">Nocturno</option>
                                </select>

                        </div>

                        <div class="form-group">
                            <label for="carrera-asignar">Carrera:</label>
                            <input type="text" id="carrera-asignar" name="carrera" required placeholder="Ingrese una carrera"> 
                        </div>

                        <div class="form-group">
                        <label for="anio-asignar">Año:</label>
                            <input type="text" id="anio-asignar" name="anio" required placeholder="Ingrese un año">
                        </div>


                        <div class="form-group">
                            <label for="materia-asignar">Materia:</label>
                            <input type="text" id="materia-asignar" name="materia" required placeholder="Ingrese una materia">                           
                        </div>

                        <div class="form-group">
                            <label for="profesor-asignar">Profesor:</label>
                            <input type="text" id="profesor-asignar" name="profesor" required placeholder="Ingrese un profesor">
                            
                        </div>

                        <div class="form-group">
                            <label for="aula-asignar">Aula:</label>
                            <select id="aula-asignar" name="aula" required>
                                <option value="">Seleccione un aula</option>
                                <option value="Auditorio">Auditorio</option>
                                <option value="Aula Magna">Aula Magna</option>
                                <option value="Laboratorio">Laboratorio</option>
                                <option value="Laboratorio Fisica">Laboratorio Física</option>
                                <option value="1/2">Aula 1/2</option>
                                <option value="3">Aula 3</option>
                                <option value="4">Aula 4</option>
                                <option value="5/6">Aula 5/6</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hora-inicio-asignar">Hora de Inicio:</label>
                            <input type="time" id="hora-inicio-asignar" name="hora_inicio" required>
                        </div>

                        <div class="form-group">
                            <label for="hora-fin-asignar">Hora de Fin:</label>
                            <input type="time" id="hora-fin-asignar" name="hora_fin" required>
                            </div>
                        <button type="submit">Asignar Aula</button>
                    </form>
                </section>
            </div>
        </div>
    </main>

    

    <footer>
        <p>&copy; 2025 Instituto XYZ. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../js/alert.js"></script>
</body>
</html>