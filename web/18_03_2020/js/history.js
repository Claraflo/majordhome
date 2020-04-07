
var tabSub = document.getElementById("tableHisSubscription");
var tabSer = document.getElementById("tableHisServices");
var tabBill = document.getElementById("tableHisBill");

function displayHisSubscription(){

    if (tabSer.style.display != "none"){
        tabSer.style.display ="none";
    }

    if (tabBill.style.display != "none"){
        tabBill.style.display = "none";
    }

    if (tabSub.style.display == "none"){
        tabSub.style.display = "block";
    }

}

function displayHisService(){


    if (tabBill.style.display != "none"){
        tabBill.style.display = "none";
    }

    if (tabSub.style.display != "none"){
        tabSub.style.display = "none";
    }

    if (tabSer.style.display != "block"){
        tabSer.style.display = "block";
    }

}


function displayHisBill(){

    if (tabSer.style.display != "none"){
        tabSer.style.display ="none";
    }

    if (tabSub.style.display != "none"){
        tabSub.style.display = "none";
    }

    if (tabBill.style.display != "block"){
        tabBill.style.display = "block";
    }
}