let currentDate = new Date();
let eventsData;

function updateCalendar() {
  const days = ['Su', 'Ma', 'Ti', 'Ke', 'To', 'Pe', 'La'];

  // Assume day containers have IDs like 'day1', 'day2', 'day3'
  const dayContainers = ['day1', 'day2', 'day3'];

  dayContainers.forEach((containerId, index) => {
    const dayValue = getDayValue(index - 1);
    const dayElement = document.getElementById(containerId);
    dayElement.innerText = days[(currentDate.getDay() + index - 1 + 7) % 7] + ' ' + dayValue + '.';
    dayElement.setAttribute('data-date', dayValue);

    // Check if there is an event for the current day
    const eventData = getEventData(dayValue);

    if (eventData.title && eventData.description) {
      // Set a background color if there is an event (you can adjust the color)
      dayElement.style.backgroundColor = 'rgb(0, 255, 0)';
    } else {
      // Reset the background color if there is no event
      dayElement.style.backgroundColor = '';
    }
  });

  const options = { year: 'numeric', month: 'long', timeZone: 'UTC' };
  const title = currentDate.toLocaleDateString('fi-FI', options).replace(/\b\w/g, (l) => l.toUpperCase());
  document.getElementById('calendarHeader').innerText = title;
}


function getDayValue(offset) {
  const day = currentDate.getDate() + offset;
  const lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
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

function showEventInfo(dayNumber) {
  const overlay = document.getElementById('overlay');
  const eventInfo = document.getElementById('eventInfo');
  const eventData = getEventData(dayNumber);

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


function hideEventInfo() {
  const overlay = document.getElementById('overlay');
  overlay.classList.remove('show');
}

function getEventData(dayNumber) {
  const formattedDate = formatDate(currentDate, dayNumber);
  console.log('Formatted Date:', formattedDate);

  const event = eventsData.find(event => {
    const eventDate = event.date;
    console.log(eventDate);
    return eventDate === formattedDate;
  });

  console.log('Event Data:', event);

  return event || { title: '', description: '' };
}



function formatDate(baseDate, dayNumber) {
  const year = baseDate.getFullYear();
  const month = baseDate.getMonth() + 1; // months are zero-based
  const day = dayNumber;

  const formattedMonth = month < 10 ? `0${month}` : `${month}`;
  const formattedDay = day < 10 ? `0${day}` : `${day}`;

  return `${year}-${formattedMonth}-${formattedDay}`;
}


// Fetch events from the PHP file
fetch('../static/server/fetchEvents.php')
  .then(response => response.json())
  .then(data => {
    eventsData = data;
    console.log(data);
    updateCalendar();
  })
  .catch(error => console.error('Error fetching events:', error));
