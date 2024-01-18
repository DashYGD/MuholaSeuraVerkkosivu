document.addEventListener('DOMContentLoaded', function () {
    var eventDetailsContainer = document.getElementById('eventDetails');
    var initialEvents = [
        { title: 'Test Event 1', date: '2024-01-21', description: 'Description for Test Event 1' },
        { title: 'Test Event 2', date: '2024-01-22', description: 'Description for Test Event 2' },
        { title: 'Test Event 3', date: '2024-01-23', description: 'Description for Test Event 3' }
    ];

    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        locale: 'fi',
        events: initialEvents,
        eventClick: function (info) {
            var clickedEvent = info.event;
            var eventDetailsContainer = document.getElementById('eventDetails');

            if (eventDetailsContainer.style.display === 'flex' && eventDetailsContainer.innerHTML.includes(clickedEvent.title)) {
                checkScreenWidth_1();
            } else {
                eventDetailsContainer.innerHTML = `<strong>${clickedEvent.title}</strong><br>Date: ${clickedEvent.start.toLocaleDateString('fi-FI')}<br>Description: ${clickedEvent.extendedProps.description}`;
                eventDetailsContainer.style.display = 'flex';
            }
        }
    });

    calendar.render();

    function checkScreenWidth_1() {
        var eventDetailsContainer = document.getElementById('eventDetails');
        if (window.innerWidth <= 650) {
            eventDetailsContainer.style.display = 'none';
        }
    }

    function isEventDetailsFlex() {
        return window.getComputedStyle(eventDetailsContainer).display === 'flex';
    }

    document.addEventListener('click', function (event) {
        if (window.innerWidth >= 651 && window.innerWidth <= 900) {
            var eventDetailsContainer = document.getElementById('eventDetails');
            var calendarContainer = document.querySelector('.fc-daygrid-day-events');

            if (!eventDetailsContainer.contains(event.target) && event.target !== calendarContainer) {
                var isCalendarEvent = event.target.closest('.fc-event, .fc-event-action');

                setTimeout(function () {
                    if (isEventDetailsFlex() && !isCalendarEvent) {
                        console.log('EventDetails is set to flex');
                        eventDetailsContainer.style.display = 'none';
                    }
                }, 50);
            }
        }
    });

    function checkScreenWidth_2() {
        if (window.innerWidth >= 900) {
            eventDetailsContainer.style.display = 'flex';
        }
    }

    window.addEventListener('resize', checkScreenWidth_2);
});
