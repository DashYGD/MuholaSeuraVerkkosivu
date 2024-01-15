


document.addEventListener('DOMContentLoaded', function () {
    // Set the scroll position on page load
    var scrollPositionCookie = document.cookie.replace(/(?:(?:^|.*;\s*)scrollPosition\s*=\s*([^;]*).*$)|^.*$/, '$1');
    var scrollPosition = parseInt(scrollPositionCookie) || 0;
    window.scrollTo(0, scrollPosition);

    var form1 = document.getElementById('yourFormId1');

    form1.addEventListener('submit', function () {
        // Set the scroll position before submitting the form
        document.cookie = 'scrollPosition=' + window.scrollY;
    });

    var form2 = document.getElementById('yourFormId2');

    form2.addEventListener('submit', function () {
        // Set the scroll position before submitting the form
        document.cookie = 'scrollPosition=' + window.scrollY;
    });

});


var quill1 = new Quill('#editor_1', {
    theme: 'snow',
});


var quill2 = new Quill('#editor_2', {
    theme: 'snow',
});

var quill3 = new Quill('#editor_3', {
    theme: 'snow',
});

function updateHiddenInputs_1() {
    document.getElementById('otsikko-input_1').value = quill1.root.innerHTML;
    document.getElementById('tietoameista-input_1').value = quill2.root.innerHTML;
    
}
function updateHiddenInput_3() {
    document.getElementById('tietoatoiminta-input_1').value = quill3.root.innerHTML;
}
