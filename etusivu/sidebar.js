
document.addEventListener('mousedown', function () {
    document.body.classList.add('using-mouse');
});

document.addEventListener('keydown', function () {
    document.body.classList.remove('using-mouse');
});



const menubutton1 = document.querySelector('.menubutton1');

menubutton1.addEventListener('click', w3_open);

const menubutton2 = document.querySelector('.menubutton');


var x = 0;

function w3_open() {
if (x == 0) {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myMenubutton").style.transition = ".75s";
    document.getElementById("myMenubutton").style.backgroundColor = "grey";
    menubutton2.classList.add("openMenu");
    x = 1;
} else {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myMenubutton").style.transition = ".75s";
    document.getElementById("myMenubutton").style.backgroundColor = "#333";
    menubutton2.classList.remove("openMenu");
    x = 0;
}
}



menubutton1.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        // Prevent the default behavior of the Enter key (submitting forms, etc.)
        event.preventDefault();

        // Call the function
        w3_open();
    }
});


document.getElementById("myHomebutton").onclick = function () {
    location.href = "/etusivu";
};

window.addEventListener('scroll', function() {
    document.getElementById('scrollPositionBtn').value = window.scrollY;
});

// Restore scroll position on page load
window.addEventListener('DOMContentLoaded', function() {
    var storedScrollPos = parseInt(document.getElementById('scrollPositionBtn').value, 10);

    if (!isNaN(storedScrollPos)) {
        window.scrollTo(0, storedScrollPos);
    }
});

window.addEventListener('load', function() {
    setTimeout(function() {
      document.getElementById('base').classList.add('w3-animate-top');
      document.getElementById('base').style.opacity = "100%";
    }, 500); // Adjust the delay as needed
  });