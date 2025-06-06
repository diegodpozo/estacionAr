document.addEventListener("DOMContentLoaded", function () {
    // Cargar profesores
    fetch("../includes/get_profesores.php")
        .then(res => res.json())
        .then(data => {
            const selectProfesor = document.getElementById("profesor-asignar");
            if (selectProfesor) {
                data.forEach(prof => {
                    const option = document.createElement("option");
                    option.value = prof.id;
                    option.textContent = `${prof.nombre} ${prof.apellido}`;
                    selectProfesor.appendChild(option);
                });
            }
        })
        .catch(error => console.error("❌ Error al cargar profesores:", error));

    // Cargar materias
    fetch("../includes/get_materias.php")
        .then(res => res.json())
        .then(data => {
            const selectMateria = document.getElementById("materia-asignar");
            if (selectMateria) {
                data.forEach(mat => {
                    const option = document.createElement("option");
                    option.value = mat.id;
                    option.textContent = mat.materia;
                    selectMateria.appendChild(option);
                });
            }
        })
        .catch(error => console.error("❌ Error al cargar materias:", error));
});


function manejarFormulario(formId, url) {
    const form = document.getElementById(formId);
    if (form) {
        form.addEventListener("submit", function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch(url, {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                Swal.fire({
                    title: data.includes("✅") ? "Éxito" : "Error",
                    text: data,
                    icon: data.includes("✅") ? "success" : "error",
                    confirmButtonText: "Aceptar",
                });

                // Vaciar el formulario después de agregar el profesor
                if (data.includes("✅")) {
                    form.reset();
                }
            })
            .catch(error => {
                Swal.fire({
                    title: "Error inesperado",
                    text: "Hubo un problema con la solicitud.",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                });
            });
        });
    }
}


// Aplicar la función a los formularios
manejarFormulario("add-materia-form", "../actions/agregar_materia.php");
manejarFormulario("form-profesor", "../actions/agregar_profesor.php");

