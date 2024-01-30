document.addEventListener('DOMContentLoaded', function() {
    function storeContainerId(containerId) {
        localStorage.setItem('containerId', containerId);
    }

    function scrollToContainer() {
        var containerId = localStorage.getItem('containerId');
        if (containerId) {
            var container = document.getElementById(containerId);
            if (container) {
                var containerPosition = container.offsetTop;
                window.scrollTo(0, containerPosition-5);
            }
        }
    }

    var containerId_1 = document.getElementById("tapahtumakalenteri_1").getAttribute('id');
    var containerId_2 = document.getElementById("etusivu_1").getAttribute('id');
    var containerId_3 = document.getElementById("toiminta_1").getAttribute('id');

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

    scrollToContainer();

    document.getElementById('searchInput_2').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
        }
    });
});
