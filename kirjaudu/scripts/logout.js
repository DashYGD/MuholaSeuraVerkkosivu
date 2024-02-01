document.getElementById("logoutButton").addEventListener("click", function() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Redirect to the login page after successful logout
                window.location.href = "../login";
            } else {
                // Handle error
                console.error("Logout failed: " + xhr.responseText);
            }
        }
    };
    xhr.open("POST", "server/logout", true);
    xhr.send();
});
