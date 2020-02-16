// Get the modal
var content = document.getElementById("content-delete");

// Get the button that opens the modal
var btn = document.getElementById("delete");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("cross")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    content.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    content.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == content) {
        content.style.display = "none";
    }
}