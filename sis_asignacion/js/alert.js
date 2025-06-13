document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("assign-form");

    if (!form) {
        console.warn("No se encontró el formulario 'assign-form', omitiendo eventos.");
        return; // Si no existe el formulario, no ejecuta el código
    }

    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Evita envío por defecto

        Swal.fire({
            title: "¿Confirmar asignación?",
            text: "¿Estás seguro de que quieres registrar esta asignación?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, registrar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                let formData = new FormData(event.target);

                fetch("../actions/agregar_asignaciones.php", {
                    method: "POST",
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Respuesta del servidor:", data);
                    Swal.fire({
                        title: data.status === "success" ? "¡Éxito!" : "Error",
                        text: data.message,
                        icon: data.status === "success" ? "success" : "error",
                        confirmButtonText: "OK"
                    }).then(() => {
                        if (data.status === "success") {
                            location.reload();
                        }
                    });
                })
                .catch(error => {
                    console.error("Error de conexión:", error);
                    Swal.fire({
                        title: "Error",
                        text: "No se pudo conectar con el servidor.",
                        icon: "error",
                        confirmButtonText: "Cerrar"
                    });
                });
            }
        });
    });
});
