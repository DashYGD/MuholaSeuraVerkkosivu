document.addEventListener('DOMContentLoaded', function() {
    // Function to store the container ID in localStorage
    function storeContainerId(containerId) {
        localStorage.setItem('containerId', containerId);
    }

    // Function to retrieve the container ID from localStorage and scroll to its position
    function scrollToContainer() {
        var containerId = localStorage.getItem('containerId');
        if (containerId) {
            var container = document.getElementById(containerId);
            if (container) {
                var containerPosition = container.offsetTop;
                window.scrollTo(0, containerPosition-10);
            }
        }
    }

    // Store the ID of the clicked container when a container is clicked
    var containerId_1 = document.getElementById("eventCalendar").getAttribute('id');
    var containerId_2 = document.getElementById("etusivu_1").getAttribute('id');
    var containerId_3 = document.getElementById("toiminta").getAttribute('id');

    var clearEventsButton = document.getElementById("clearEvents");
    if (clearEventsButton) {
        clearEventsButton.addEventListener("submit", function() {
            storeContainerId(containerId_1);
        });
    }

    var newEventForm = document.getElementById("newEventForm");
    if (newEventForm) {
        newEventForm.addEventListener("submit", function() {
            storeContainerId(containerId_1);
        });
    }

    var form_1 = document.getElementById('form_1');
    if (form_1) {
        form_1.addEventListener('submit', function() {
            storeContainerId(containerId_2);
        });
    }

    var form_2 = document.getElementById('form_2');
    if (form_2) {
        form_2.addEventListener('submit', function() {
            storeContainerId(containerId_3);
        });
    }

    // Scroll to the stored container position on page load
    scrollToContainer();

    document.getElementById('searchInput_2').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent form submission on Enter
        }
    });
});
