document.addEventListener('DOMContentLoaded', function() {
    var initialEvents = [
        { title: 'Test Event 1', date: '2024-01-21', description: 'Description for Test Event 1' },
        { title: 'Test Event 2', date: '2024-01-22', description: 'Description for Test Event 2' },
        { title: 'Test Event 3', date: '2024-01-23', description: 'Description for Test Event 3' }
    ];

    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        locale: 'fi',
        events: initialEvents,
        eventClick: function(info) {
            var clickedEvent = info.event;
            var eventDetailsContainer = document.getElementById('eventDetails');
            eventDetailsContainer.innerHTML = `<strong>${clickedEvent.title}</strong><br>Date: ${clickedEvent.start.toLocaleDateString('fi-FI')}<br>Description: ${clickedEvent.extendedProps.description}`;
            eventDetailsContainer.style.display = 'flex';

        }
    });

    calendar.render();
});