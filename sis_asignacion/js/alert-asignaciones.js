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

                    // Recargar asignaciones correctamente
                    const dia = diaSeleccionado || "Todas";
                    cargarAsignaciones(dia);
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