const calendar = document.getElementById('calendar');
const eventModal = document.getElementById('event-modal');
const eventTitleInput = document.getElementById('event-title');
const addEventButton = document.getElementById('add-event-btn');
const closeButton = document.getElementsByClassName('close')[0];

// Obtener la fecha actual
const date = new Date();
var currentYear = date.getFullYear();
var currentMonth = date.getMonth();
var currentDay = date.getDate();

// Renderizar el calendario
renderCalendar(currentYear, currentMonth);

function renderCalendar(year, month) {
  // Obtener el primer día del mes y el último día del mes
  const firstDay = new Date(year, month, 1).getDay();
  const lastDay = new Date(year, month + 1, 0).getDate();

  // Nombres de los meses
  const months = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
    'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
  ];

  // HTML para el encabezado del mes
  const monthHeader = `
    <div class="month">
      <button onclick="prevMonth()">&#10094;</button>
      <h2>${months[month]} ${year}</h2>
      <button onclick="nextMonth()">&#10095;</button>
    </div>
  `;

  // HTML para los nombres de los días de la semana
  const weekdaysHeader = `
    <div class="weekdays">
      <div class="day">Dom</div>
      <div class="day">Lun</div>
      <div class="day">Mar</div>
      <div class="day">Mié</div>
      <div class="day">Jue</div>
      <div class="day">Vie</div>
      <div class="day">Sáb</div>
    </div>
  `;

  let days = '';

  // HTML para cada día del mes
  for (let i = 1; i <= lastDay; i++) {
    const isCurrentDay = (i === currentDay && month === currentMonth && year === currentYear);
    const day = `
      <div class="day ${isCurrentDay ? 'current-day' : ''}" onclick="openEventModal(${i}, ${month}, ${year})">${i}</div>
    `;
    days += day;
  }

  // HTML completo del calendario
  const calendarHTML = monthHeader + weekdaysHeader + '<div class="days">' + days + '</div>';

  // Renderizar el calendario en el elemento "calendar"
  calendar.innerHTML = calendarHTML;
}

function prevMonth() {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  renderCalendar(currentYear, currentMonth);
}

function nextMonth() {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  renderCalendar(currentYear, currentMonth);
}

function openEventModal(day, month, year) {
  eventTitleInput.value = '';
  eventModal.style.display = 'block';
  addEventButton.addEventListener('click', function () {
    const eventTitle = eventTitleInput.value;
    if (eventTitle !== '') {
      // Aquí puedes agregar la lógica para guardar el evento en tu sistema
      console.log(`Evento añadido: ${eventTitle}`);
      eventModal.style.display = 'none';
    }
  });
}

closeButton.addEventListener('click', function () {
  eventModal.style.display = 'none';
});

function openEventModal(day, month, year) {
  eventTitleInput.value = '';
  eventModal.style.display = 'block';
  addEventButton.addEventListener('click', function () {
    const eventTitle = eventTitleInput.value;
    if (eventTitle !== '') {
      const dayElement = document.querySelector(`.day[data-day="${day}"][data-month="${month}"][data-year="${year}"]`);
      const eventElement = document.createElement('div');
      eventElement.className = 'event';
      eventElement.textContent = eventTitle;
      dayElement.appendChild(eventElement);
      eventModal.style.display = 'none';
    }
  });
}