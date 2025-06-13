// 📌 Función para capitalizar texto
function capitalizarTexto(texto) {
    if (!texto) return ""; // Evita errores si el texto es nulo o vacío
    return texto.toLowerCase().replace(/\b\w/g, letra => letra.toUpperCase());
}

document.addEventListener("DOMContentLoaded", function () {
    const botonesVista = document.querySelectorAll(".view-btn");
    const tabButtons = document.querySelectorAll(".tab-btn");
    const mensajeNoAsignaciones = document.getElementById("no-asignaciones-msg");
    
    let diaSeleccionado = null;
    let turnoSeleccionado = null;

    // 📌 Ocultar todas las tablas al inicio
    document.querySelectorAll(".tab-content").forEach(contenedor => (contenedor.style.display = "none"));
    mensajeNoAsignaciones.style.display = "none";

    function cargarAsignaciones(dia) {
        console.log(`Ejecutando cargarAsignaciones para: ${dia}`); // 🔍 Verificación
        if (!dia) {
            console.warn("Día inválido, deteniendo ejecución de cargarAsignaciones.");
            return;
        }

        let url = "../includes/get_asignaciones.php";
        url += `?dia=${dia.toLowerCase()}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Datos recibidos en la recarga:", data); // 🔍 Verificación

                // Si `data.error` existe, significa que no hay asignaciones
                if (data.error) {
                    console.warn("El servidor respondió sin asignaciones:", data.error);
                    mensajeNoAsignaciones.style.display = "block";
                    document.querySelectorAll(".tab-content").forEach(contenedor => (contenedor.style.display = "none"));
                    return;
                }

                actualizarTablas(data);
            })
            .catch(error => console.error("Error al cargar asignaciones:", error));
    }

    function actualizarTablas(data) {
        document.querySelectorAll(".tab-content tbody").forEach(tabla => tabla.innerHTML = "");

        if (Array.isArray(data) && data.length > 0) {
            mensajeNoAsignaciones.style.display = "none";

            data.forEach(asignacion => {
                if (!asignacion.id) {
                    console.warn("Asignación sin ID:", asignacion);
                    return;
                }

                const fila = document.createElement("tr");
                fila.innerHTML = `
                    <td><input type="checkbox" class="seleccion" id="${asignacion.id}" name="asignaciones" value="${asignacion.id}"></td>
                    <td>${capitalizarTexto(asignacion.carrera)}</td>
                    <td>${asignacion.anio}</td>
                    <td>${capitalizarTexto(asignacion.materia)}</td>
                    <td>${capitalizarTexto(asignacion.profesor)}</td>
                    <td>${capitalizarTexto(asignacion.aula)}</td>
                    <td>${asignacion.hora_inicio} - ${asignacion.hora_fin}</td>
                `;

                const horaInicio = parseInt(asignacion.hora_inicio.split(":")[0]);
                const horaFin = parseInt(asignacion.hora_fin.split(":")[0]);

                let turno;
                if (horaInicio >= 8 && horaFin <= 13) {
                    turno = "matutinas";
                } else if (horaInicio >= 13 && horaFin <= 18) {
                    turno = "vespertinas";
                } else {
                    turno = "nocturnas";
                }

                document.querySelector(`#asignaciones-${turno} tbody`).appendChild(fila);
            });
        } else {
            mensajeNoAsignaciones.style.display = "block";
        }
    }

    function mostrarTurno(turno) {
        if (!diaSeleccionado) {
            Swal.fire({
                title: "Atención",
                text: "Por favor, selecciona un día antes de elegir un turno.",
                icon: "warning",
                confirmButtonText: "Entendido"
            });
            return;
        }

        turnoSeleccionado = turno;
        console.log(`Ejecutando mostrarTurno para: ${turno}`);

        document.querySelectorAll(".tab-content").forEach(contenedor => (contenedor.style.display = "none"));

        const contenedor = document.getElementById(`tab-content-${turno}`);
        if (contenedor && contenedor.querySelector("tbody").childElementCount > 0) {
            contenedor.style.display = "block";
            mensajeNoAsignaciones.style.display = "none";
        } else {
            mensajeNoAsignaciones.style.display = "block";
        }
    }

    // 📌 Evento para seleccionar el día
    botonesVista.forEach(boton => {
        boton.addEventListener("click", function () {
            diaSeleccionado = this.getAttribute("data-view");
            console.log("Día seleccionado:", diaSeleccionado);

            // Ocultar todas las tablas hasta que también se seleccione un turno
            document.querySelectorAll(".tab-content").forEach(contenedor => (contenedor.style.display = "none"));
            mensajeNoAsignaciones.style.display = "none"; // Ocultar mensaje

            cargarAsignaciones(diaSeleccionado);
        });
    });

    // 📌 Evento para seleccionar el turno
    tabButtons.forEach(button => {
        button.addEventListener("click", function () {
            const turno = this.dataset.tab;
            console.log("Botón clickeado, mostrando turno:", turno);

            if (!diaSeleccionado) {
                Swal.fire({
                    title: "Atención",
                    text: "Por favor, selecciona un día antes de elegir un turno.",
                    icon: "warning",
                    confirmButtonText: "Entendido"
                });
                return;
            }

            mostrarTurno(turno);
        });
    });

    window.cargarAsignaciones = cargarAsignaciones;
    window.mostrarTurno = mostrarTurno;
});