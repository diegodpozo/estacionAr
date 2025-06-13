document.querySelectorAll(".editar-seleccionadas").forEach(button => {
    button.addEventListener("click", function () {
        const turno = this.dataset.turno;

        // 🔍 Buscar checkboxes con la clase correcta
        const todosLosCheckboxes = document.querySelectorAll(`#asignaciones-${turno} .seleccion`);
        console.log("Total de checkboxes encontrados:", todosLosCheckboxes.length);

        // 🔍 Filtrar los que están seleccionados
        const seleccionados = Array.from(todosLosCheckboxes).filter(checkbox => checkbox.checked);
        console.log("Seleccionados:", seleccionados.length);

        if (seleccionados.length !== 1) {
            Swal.fire("Error", "Selecciona solo una asignación para editar", "error");
            return;
        }

        const id = seleccionados[0].id;
        const fila = seleccionados[0].closest("tr");
        const datos = {
            id,
            turno,
            carrera: fila.children[1].textContent,
            anio: fila.children[2].textContent,
            materia: fila.children[3].textContent,
            profesor: fila.children[4].textContent,
            aula: fila.children[5].textContent,
            hora_inicio: fila.children[6].textContent.split(" - ")[0],
            hora_fin: fila.children[6].textContent.split(" - ")[1]
        };

        console.log("Datos de la asignación seleccionada:", datos);


Swal.fire({
    title: "Editar Asignación",
    html: `
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <label for="edit-turno">Turno:</label>
            <select id="edit-turno" class="swal2-select">
                <option value="">Seleccione un turno</option>
                <option value="Matutino" ${datos.turno === "Matutino" ? "selected" : ""}>Matutino</option>
                <option value="Vespertino" ${datos.turno === "Vespertino" ? "selected" : ""}>Vespertino</option>
                <option value="Nocturno" ${datos.turno === "Nocturno" ? "selected" : ""}>Nocturno</option>
            </select>

            <label for="edit-dia">Día:</label>
            <select id="edit-dia" class="swal2-select">
                <option value="">Seleccione un día</option>
                <option value="Lunes" ${datos.dia === "Lunes" ? "selected" : ""}>Lunes</option>
                <option value="Martes" ${datos.dia === "Martes" ? "selected" : ""}>Martes</option>
                <option value="Miércoles" ${datos.dia === "Miércoles" ? "selected" : ""}>Miércoles</option>
                <option value="Jueves" ${datos.dia === "Jueves" ? "selected" : ""}>Jueves</option>
                <option value="Viernes" ${datos.dia === "Viernes" ? "selected" : ""}>Viernes</option>
                <option value="Sábado" ${datos.dia === "Sábado" ? "selected" : ""}>Sábado</option>
            </select>

            <input id="edit-carrera" class="swal2-input" value="${datos.carrera}">
            <input id="edit-anio" class="swal2-input" value="${datos.anio}">
            <input id="edit-materia" class="swal2-input" value="${datos.materia}">
            <input id="edit-profesor" class="swal2-input" value="${datos.profesor}">

            <label for="edit-aula">Aula:</label>
            <select id="edit-aula" class="swal2-select">
                <option value="">Seleccione un aula</option>
                <option value="Auditorio" ${datos.aula === "Auditorio" ? "selected" : ""}>Auditorio</option>
                <option value="Aula Magna" ${datos.aula === "Aula Magna" ? "selected" : ""}>Aula Magna</option>
                <option value="Laboratorio" ${datos.aula === "Laboratorio" ? "selected" : ""}>Laboratorio</option>
                <option value="Laboratorio Fisica" ${datos.aula === "Laboratorio Fisica" ? "selected" : ""}>Laboratorio Física</option>
                <option value="1/2" ${datos.aula === "1/2" ? "selected" : ""}>Aula 1/2</option>
                <option value="3" ${datos.aula === "3" ? "selected" : ""}>Aula 3</option>
                <option value="4" ${datos.aula === "4" ? "selected" : ""}>Aula 4</option>
                <option value="5/6" ${datos.aula === "5/6" ? "selected" : ""}>Aula 5/6</option>
            </select>

            <div style="display: flex; justify-content: space-between;">
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <label for="edit-hora-inicio">Hora Inicio:</label>
                    <input id="edit-hora-inicio" class="swal2-input" type="time" value="${datos.hora_inicio}">
                </div>
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <label for="edit-hora-fin">Hora Fin:</label>
                    <input id="edit-hora-fin" class="swal2-input" type="time" value="${datos.hora_fin}">
                </div>
            </div>
        </div>
    `,
    preConfirm: () => ({
        id: datos.id,
        turno: document.getElementById("edit-turno").value, // Ahora toma el valor del select de turno
        dia: document.getElementById("edit-dia").value, // Ahora toma el valor del select de día
        carrera: document.getElementById("edit-carrera").value,
        anio: document.getElementById("edit-anio").value,
        materia: document.getElementById("edit-materia").value,
        profesor: document.getElementById("edit-profesor").value,
        aula: document.getElementById("edit-aula").value,
        hora_inicio: document.getElementById("edit-hora-inicio").value,
        hora_fin: document.getElementById("edit-hora-fin").value
    })
}).then(result => {
    if (result.isConfirmed) {
        fetch("../actions/editar_asignaciones.php", {
            method: "POST",
            body: JSON.stringify(result.value),
            headers: { "Content-Type": "application/json" }
        })
        .then(response => response.json())
        .then(data => Swal.fire("Éxito", data.success, "success").then(() => location.reload()));
    }
}); }); }); 