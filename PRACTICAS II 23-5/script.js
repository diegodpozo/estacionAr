let timeoutId;

function toggleColor(element) {
  element.classList.toggle('inactive');
}

function showStatus(element) {
  clearTimeout(timeoutId);
  const status = element.classList.contains('inactive') ? 'No asignado' : 'Reservado';
  let message = `${element.innerText}: ${status}`;
  if (status === 'Reservado') {
    message += " – Usuario: [Nombre desde DB]";
  }

  const estadoDiv = document.getElementById('estado');
  estadoDiv.textContent = message;
  estadoDiv.style.opacity = 1;

  timeoutId = setTimeout(() => {
    estadoDiv.style.opacity = 0;
  }, 3000);
}
