
document.addEventListener("DOMContentLoaded", function () {
    const imageUpdateForms = document.querySelectorAll(".image-update-form");

    imageUpdateForms.forEach(form => {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(form); // Create FormData object

            // Send form data to the server using AJAX
            fetch("server/imageHandler.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text()) // Parse response as text
            .then(data => {
                // Update UI based on server response
                if (document.getElementById('image-display')) {
                    document.getElementById('image-display').src = data;
                }

                alert(data); // Show alert with server response (you can customize this)
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    });


    const eventUpdateForms = document.querySelectorAll(".event-update-form");

    eventUpdateForms.forEach(form => {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(form); // Create FormData object

            // Send form data to the server using AJAX
            fetch("server/eventHandler.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text()) // Parse response as text
            .then(data => {
                alert(data); // Show alert with server response (you can customize this)
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    });




});

function clearImages() {
    imageForm = document.getElementById('clearImageForm');
    imageForm.submit();
}


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
