function submitForm(selectedForm, selectedDisplay) {
    console.log(selectedForm, selectedDisplay);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Update the content of the span element with the received data
            document.getElementById(selectedDisplay).innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "server/eventHandler.php", true);
    // Add FormData with appropriate data to send to the server
    var formData = new FormData(document.getElementById(selectedForm));
    xhttp.send(formData);
}