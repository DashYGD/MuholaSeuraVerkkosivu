let currentDate = new Date();
let eventsData;

let eventColors = {};

function updateCalendar() {
  const days = ['Su', 'Ma', 'Ti', 'Ke', 'To', 'Pe', 'La'];

  const dayContainers = ['day1', 'day2', 'day3'];

  dayContainers.forEach((containerId, index) => {
    const dayValue = getDayValue(index - 1);

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth() + 1; // months are zero-based
    const day = getDayValue(index - 1);

    const formattedMonth = month < 10 ? `0${month}` : `${month}`;
    const formattedDay = day < 10 ? `0${day}` : `${day}`;

    const fullDate = `${year}-${formattedMonth}-${formattedDay}`;


    const dayElement = document.getElementById(containerId);
    dayElement.innerText = days[(currentDate.getDay() + index - 1 + 7) % 7] + ' ' + dayValue + '.';
    dayElement.setAttribute('data-date', dayValue);

    // Check if there is an event for the current day
    const eventData = getEventData(fullDate);

    if (eventData.title && eventData.description) {
      if (!eventColors[dayValue]) {
        eventColors[dayValue] = getRandomColor();
      }
      dayElement.style.backgroundColor = eventColors[dayValue];
    } else {
      dayElement.style.backgroundColor = '';
    }
  });

  const options = { year: 'numeric', month: 'long', timeZone: 'UTC' };
  const title = currentDate.toLocaleDateString('fi-FI', options).replace(/\b\w/g, (l) => l.toUpperCase());
  document.getElementById('calendarHeader').innerText = title;
}

function findEvent(direction) {
  for (let i = 1; i <= 365; i++) {
    const nextDate = new Date(currentDate);
    if (direction == '-') {
    nextDate.setDate(nextDate.getDate() - i);
    } else {
      nextDate.setDate(nextDate.getDate() + i);
    }
    
    const fullDate = formatDate(nextDate);

    const eventData = getEventData(fullDate);

    if (eventData.title && eventData.description) {
      updateCalendarDate(nextDate);
      break;
    }
  }
}

function updateCalendarDate(newDate) {
  currentDate = newDate;
  updateCalendar();
}

function getRandomColor() {
  const randomColor = () => Math.floor(Math.random() * 256);
  return `rgb(${randomColor()}, ${randomColor()}, ${randomColor()})`;
}

function getDayValue(offset) {
  const day = currentDate.getDate() + offset;
  const lastDayOfMonth = new Date(currentDate.getFullYear(), (currentDate.getMonth() + 1), 0).getDate();
  
  return (day > 0 && day <= lastDayOfMonth) ? `${day}` : '';
}

function prevDay() {
  currentDate.setDate(currentDate.getDate() - 1);
  updateCalendar();
}

function nextDay() {
  currentDate.setDate(currentDate.getDate() + 1);
  updateCalendar();
}

function showEventInfo() {
  const overlay = document.getElementById('overlay');
  const eventInfo = document.getElementById('eventInfo');
  const fullDate = formatDate(currentDate);
  const eventData = getEventData(fullDate);

  if (eventData.title && eventData.description) {
    eventInfo.innerHTML = `
      <h3>${eventData.title}</h3>
      <p>${eventData.description}</p>
    `;
  } else {
    eventInfo.innerHTML = `<p>No events for this date.</p>`;
  }

  overlay.classList.add('show');
  overlay.addEventListener('click', hideEventInfo);
}

function formatDate(baseDate) {
  const year = baseDate.getFullYear();
  const month = baseDate.getMonth() + 1; // months are zero-based
  const day = baseDate.getDate();

  const formattedMonth = month < 10 ? `0${month}` : `${month}`;
  const formattedDay = day < 10 ? `0${day}` : `${day}`;

  return `${year}-${formattedMonth}-${formattedDay}`;
}



function hideEventInfo() {
  const overlay = document.getElementById('overlay');
  overlay.classList.remove('show');
}

function getEventData(fullDate) {
  const event = eventsData.find(event => event.date === fullDate);
  return event || { title: '', description: '' };
}


// Fetch events from the PHP file
fetch('../static/server/fetchEvents.php')
  .then(response => response.json())
  .then(data => {
    eventsData = data;
    updateCalendar();
  })
  .catch(error => console.error('Error fetching events:', error));
