document.addEventListener('DOMContentLoaded', function () {
    // Set the scroll position on page load
    var scrollPositionCookie = document.cookie.replace(/(?:(?:^|.*;\s*)scrollPosition\s*=\s*([^;]*).*$)|^.*$/, '$1');
    var scrollPosition = parseInt(scrollPositionCookie) || 0;
    window.scrollTo(0, scrollPosition);

    var form1 = document.getElementById('form_1');

    form1.addEventListener('submit', function () {
        document.cookie = 'scrollPosition=' + window.scrollY;
    });

    var form2 = document.getElementById('form_2');

    form2.addEventListener('submit', function () {
        document.cookie = 'scrollPosition=' + window.scrollY;
    });

});
