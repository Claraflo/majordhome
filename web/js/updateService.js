function init(id){

	displayService(id);
	displayFeature(id);

}
function addFeature(id){

const select2 = document.getElementById('select2');
let selectValue = select2.options[select2.selectedIndex].innerHTML; // Récupération de la valeur du select 
const name = document.getElementById('name').value // récupération du nom de champ
const form = document.getElementById('form'); // container 


switch(selectValue){
	case 'Texte':
	selectValue = "text";
	break;
	case 'Date':
	selectValue = "date";
	break;
	case 'Nombre':
	selectValue = "number";
	break;
}


const req = new XMLHttpRequest();
req.onreadystatechange = function(){
  
  if (req.readyState === 4) { 

  	let info = document.getElementById('information');
    info.innerHTML = req.responseText;
    displayFeature(id);
  
  }
}

req.open("POST","../pages/saveFeature.php");
req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
req.send(`id=${id}&name=${name}&selectValue=${selectValue}`);


}

function displayFeature(id){

const req = new XMLHttpRequest();
req.onreadystatechange = function() {
   
   	if(req.readyState === 4) {
     		
    	let form = document.getElementById('form');
    	form.innerHTML = req.responseText;

    }
}
req.open('GET', `../pages/displayFeature.php?id=${id}`);
req.send();

}


function deleteFeature(id){

const request = new XMLHttpRequest();
request.onreadystatechange = function() {
	if(request.readyState === 4) {
     
	    const del = document.getElementById('feature-' +id);
	    del.parentNode.removeChild(del);
	    // displayUnpublishedService();

   
  }
}
request.open('DELETE', 'deleteFeature.php?id=' + id);
request.send();
}


function displayService(id){

const req = new XMLHttpRequest();
req.onreadystatechange = function() {
   
   	if(req.readyState === 4) {
     		
    	let table = document.getElementById('table');
    	table.innerHTML = req.responseText;

    }
}
req.open('GET', `../pages/displayService.php?id=${id}`);
req.send();

}

function getData(id){


  updtName = document.getElementById('updateName');
  updtDescription = document.getElementById('updateDescription');
  priceEur = document.getElementById('priceEur');
  priceCent = document.getElementById('priceCent');
  

  const updt = document.getElementById('tableService');

  const btnUpdt = document.getElementById('update');
  btnUpdt.setAttribute('onclick', 'updateService('+id+')');

  updtName.value = updt.childNodes[1].innerHTML;
  updtDescription.value =  updt.childNodes[2].innerHTML;
  price = updt.childNodes[3].innerHTML.split(',');
  priceEur.value =  price[0];
  priceCent.value =  price[1];





}


function updateService(id){


const name = document.getElementById('updateName').value;
const description = document.getElementById('updateDescription').value;
const priceEur = document.getElementById('priceEur').value;
const priceCent = document.getElementById('priceCent').value;
const select = document.getElementById('select');
const selectValue = select.options[select.selectedIndex].innerHTML;



const req = new XMLHttpRequest();
req.onreadystatechange = function(){
  if (req.readyState === 4) { 
    
      
    let info = document.getElementById('information');
    info.innerHTML = req.responseText;


    displayService(id);
    

  }
}

req.open("POST","../pages/modifiedService.php");
req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
req.send(`id=${id}&name=${name}&description=${description}&priceEur=${priceEur}&priceCent=${priceCent}&selectValue=${selectValue}`);

}















