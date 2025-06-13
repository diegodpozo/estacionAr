document.addEventListener("DOMContentLoaded", function () {
    function obtenerHoraActual() {
        const ahora = new Date();
        return ahora.getHours();
    }

    function determinarTurno(horaInicio, horaFin) {
        if (horaInicio >= 8 && horaFin <= 13) {
            return "matutino";
        } else if (horaInicio >= 13 && horaFin <= 18) {
            return "vespertino";
        } else if (horaInicio >= 18 && horaFin <= 22) {
            return "nocturno";
        } else {
            return null; // Fuera del rango establecido
        }
    }

    function cargarAsignacionesHoy() {
        fetch("../includes/get_asig_dia.php")
            .then(response => response.json())
            .then(data => {
                const tablaAsignaciones = document.getElementById("tabla-asignaciones");
                tablaAsignaciones.innerHTML = "";

                if (!data || data.length === 0) {
                    tablaAsignaciones.innerHTML = "<tr><td colspan='6'>No hay asignaciones hoy.</td></tr>";
                    return;
                }

                const horaActual = obtenerHoraActual();
                const turnoActual = determinarTurno(horaActual, horaActual); // Detecta el turno actual basado en la hora

                if (!turnoActual) {
                    tablaAsignaciones.innerHTML = "<tr><td colspan='6'>Fuera del horario de asignaciones.</td></tr>";
                    return;
                }

                console.log(`Hora actual: ${horaActual}, Turno detectado: ${turnoActual}`);

                // 🔹 Filtrar asignaciones del turno actual
                const asignacionesFiltradas = data.filter(asignacion => {
                    const horaInicio = parseInt(asignacion.hora_inicio.split(":")[0]);
                    const horaFin = parseInt(asignacion.hora_fin.split(":")[0]);

                    return determinarTurno(horaInicio, horaFin) === turnoActual;
                });

                console.log("Asignaciones filtradas:", asignacionesFiltradas);

                if (asignacionesFiltradas.length === 0) {
                    tablaAsignaciones.innerHTML = "<tr><td colspan='6'>No hay asignaciones en este turno.</td></tr>";
                    return;
                }

                // 🔹 Mostrar solo asignaciones del turno actual
                asignacionesFiltradas.forEach(asignacion => {
                    let fila = `<tr>
                        <td>${asignacion.carrera}</td>
                        <td>${asignacion.anio}</td>
                        <td>${asignacion.materia}</td>
                        <td>${asignacion.profesor}</td>
                        <td>${asignacion.aula}</td>
                        <td>${asignacion.hora_inicio} - ${asignacion.hora_fin}</td>
                    </tr>`;
                    tablaAsignaciones.innerHTML += fila;
                });
            })
            .catch(error => console.error("Error al obtener asignaciones:", error));
    }

    cargarAsignacionesHoy();
});