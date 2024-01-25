document.addEventListener('DOMContentLoaded', function() {
    function storeScrollPosition() {
        localStorage.setItem('scrollPosition', window.scrollY);
    }

    var form_1 = document.getElementById('form_1');
    form_1.addEventListener('submit', storeScrollPosition);

    var form_2 = document.getElementById('form_2');
    form_2.addEventListener('submit', storeScrollPosition);

    var scrollPosition = localStorage.getItem('scrollPosition') || 0;
    window.scrollTo(0, parseInt(scrollPosition));

    document.getElementById('searchForm_1').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            // Prevent default form submission on Enter key
            event.preventDefault();
            storeScrollPosition();
        }
    });
});
