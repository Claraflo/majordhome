display();

function display() {

    var date = document.getElementById('date').value;


    const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            const customer = document.getElementById('reservation');
            customer.innerHTML = request.responseText;
        }
    };
    request.open('POST', 'displayAttribution.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`date=${date}`);
}

function attribution(idCustomer) {

    var idProvider = document.getElementById(idCustomer).value;

    const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.readyState === 4) {
            console.log(request.status);
        }
    };
    request.open("POST", "saveAttribution.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(`idCustomer=${idCustomer}&&idProvider=${idProvider}`);

    display();
}