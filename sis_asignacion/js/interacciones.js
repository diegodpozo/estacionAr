let diaSeleccionado = null; // Variable global

// 📌 Definir eliminarAsignacion en el ámbito global
window.eliminarAsignacion = function (ids) {
    if (!ids || ids.length === 0) {
        Swal.fire({
            title: "Atención",
            text: "Debes seleccionar al menos una asignación para eliminar.",
            icon: "warning",
            confirmButtonText: "Entendido"
        });
        return;
    }

    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción eliminará las asignaciones seleccionadas.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../actions/eliminar_asignaciones.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ids })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire("Eliminado", "Las asignaciones han sido eliminadas.", "success");

                    // Si `diaSeleccionado` es null, establecer un valor válido antes de recargar
                    if (!diaSeleccionado || diaSeleccionado === "null") {
                        console.warn("No hay día seleccionado, usando 'Todas' como fallback.");
                        diaSeleccionado = "Todas"; // Valor predeterminado
                    }

                    cargarAsignaciones(diaSeleccionado);
                } else {
                    Swal.fire("Error", "Hubo un problema al eliminar las asignaciones.", "error");
                    console.error("Respuesta del servidor:", data);
                }
            })
            .catch(error => {
                Swal.fire("Error", "No se pudo conectar con el servidor.", "error");
                console.error("Error en la solicitud:", error);
            });
        }
    });
};


// 📌 Eventos
document.addEventListener("DOMContentLoaded", function () {
    const botonesVista = document.querySelectorAll(".view-btn");
    const tabButtons = document.querySelectorAll(".tab-btn");
    const botonesEliminar = document.querySelectorAll(".eliminar-seleccionadas");

    // 📌 Evento para seleccionar el día
    botonesVista.forEach(boton => {
        boton.addEventListener("click", function () {
            diaSeleccionado = this.getAttribute("data-view");
            console.log("Día seleccionado:", diaSeleccionado);
            cargarAsignaciones(diaSeleccionado);

            // Agregar la clase 'active' solo al botón seleccionado
            botonesVista.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
        });
    });

    // 📌 Evento para seleccionar el turno
    tabButtons.forEach(button => {
        button.addEventListener("click", function () {
            if (!diaSeleccionado) {
                Swal.fire({
                    title: "Atención",
                    text: "Por favor, selecciona un día antes de elegir un turno.",
                    icon: "warning",
                    confirmButtonText: "Entendido"
                });
                return;
            }
            // Guardar el turno seleccionado
            const tabSeleccionado = this.getAttribute("data-tab");
            console.log("Turno seleccionado:", tabSeleccionado);

            // Ocultar todas las solapas
            document.querySelectorAll(".tab-content").forEach(contenedor => contenedor.style.display = "none");

            // Mostrar la solapa seleccionada
            document.getElementById(`tab-content-${tabSeleccionado}`).style.display = "block";

            // Agregar la clase 'active' solo al botón de turno seleccionado
            tabButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
        });
    });

    // 📌 Evento para eliminar asignaciones seleccionadas por turno
    botonesEliminar.forEach(boton => {
        boton.addEventListener("click", function () {
            const turno = this.getAttribute("data-turno");
            const seleccionados = Array.from(document.querySelectorAll(`#asignaciones-${turno} .seleccion:checked`))
                .map(checkbox => checkbox.value)
                .filter(id => id && id !== "undefined" && id !== "");

            console.log(`IDs seleccionados para eliminar en ${turno}:`, seleccionados);

            if (seleccionados.length === 0) {
                Swal.fire({
                    title: "Atención",
                    text: "Selecciona al menos una asignación.",
                    icon: "warning",
                    confirmButtonText: "Entendido"
                });
                return;
            }
            // Llamar a la función
            eliminarAsignacion(seleccionados);
        });
    });
});