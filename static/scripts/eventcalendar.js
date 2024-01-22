document.addEventListener('DOMContentLoaded', function () {
    var eventDetailsContainer = document.getElementById('eventDetails');
    var eventDetailsOverlay = document.getElementById('eventOverlay');

    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        locale: 'fi',
        events: '../static/server/fetchEvents.php', // Replace with the actual path to your PHP script
        eventClick: function (info) {
            var clickedEvent = info.event;
            var eventDetailsContainer = document.getElementById('eventDetails');
                eventDetailsContainer.innerHTML = `<strong>${clickedEvent.title}</strong><br>Date: ${clickedEvent.start.toLocaleDateString('fi-FI')}<br>Description: ${clickedEvent.extendedProps.description}`;
                eventDetailsContainer.style.display = 'flex';
                eventDetailsOverlay.style.display = 'flex';
        }
    });

    calendar.render();

    function isEventDetailsFlex() {
        return window.getComputedStyle(eventDetailsContainer).display === 'flex';
    }

    document.addEventListener('click', function (event) {
            var eventDetailsContainer = document.getElementById('eventDetails');
            var eventDetailsOverlay = document.getElementById('eventOverlay');
            var calendarContainer = document.querySelector('.fc-daygrid-day-events');

            if (!eventDetailsContainer.contains(event.target) && event.target !== calendarContainer) {
                var isCalendarEvent = event.target.closest('.fc-event, .fc-event-action');
                    if (isEventDetailsFlex() && !isCalendarEvent) {
                        console.log('EventDetails is set to flex');
                        eventDetailsContainer.style.display = 'none';
                        eventDetailsOverlay.style.display = 'none';
                    }
        }
    });

    function checkScreenWidth_1() {
            eventDetailsContainer.style.display = 'none';
            eventDetailsOverlay.style.display = 'none';
    }

    window.addEventListener('resize', checkScreenWidth_1);
});
