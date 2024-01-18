let currentDate = new Date();

function updateCalendar() {
  const days = ['Su', 'Ma', 'Ti', 'Ke', 'To', 'Pe', 'La'];

  document.getElementById('day1').innerText = days[(currentDate.getDay() - 1 + 7) % 7] + ' ' + getDayValueWithDot(-1);
  document.getElementById('day1').setAttribute('data-date', getDayValueWithDot(-1));

  document.getElementById('day2').innerText = days[currentDate.getDay()] + ' ' + getDayValueWithDot(0);
  document.getElementById('day2').setAttribute('data-date', getDayValueWithDot(0));

  document.getElementById('day3').innerText = days[(currentDate.getDay() + 1) % 7] + ' ' + getDayValueWithDot(1);
  document.getElementById('day3').setAttribute('data-date', getDayValueWithDot(1));

  const options = { year: 'numeric', month: 'long', timeZone: 'UTC' };
  const title = currentDate.toLocaleDateString('fi-FI', options).replace(/\b\w/g, (l) => l.toUpperCase());
  document.getElementById('calendarHeader').innerText = title;


  
}

function getDayValueWithDot(offset) {
  const day = currentDate.getDate() + offset;
  const lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
  return (day > 0 && day <= lastDayOfMonth) ? `${day}.` : '';
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
  
    eventInfo.innerHTML = `
      <h3>${eventData.title}</h3>
      <p>${eventData.description}</p>
    `;
  
    overlay.classList.add('show');
    overlay.addEventListener('click', hideEventInfo);
  }
  
  function hideEventInfo() {
    const overlay = document.getElementById('overlay');
    overlay.classList.remove('show');
  }
  

function getEventData(dayNumber) {
  return {
    title: 'Event Title',
    description: 'Event Description for day ' + dayNumber,
  };
}

updateCalendar();

