display();

function display() {

    const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            const customer = document.getElementById('reservation');
            customer.innerHTML = request.responseText;
        }
    };
    request.open('POST', 'displayReservationBack.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}