var quill1 = new Quill('#editor_1', {
    theme: 'snow',
});

var quill2 = new Quill('#editor_2', {
    theme: 'snow',
});

function updateHiddenInputs_1() {
    document.getElementById('tietoameista-input_1').value = quill1.root.innerHTML;
    
}
function updateHiddenInputs_2() {
    document.getElementById('tietoatoiminta-input_1').value = quill2.root.innerHTML;
}

