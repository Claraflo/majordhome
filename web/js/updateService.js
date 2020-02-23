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
  updtPrice = document.getElementById('updatePrice');
  

  const updt = document.getElementById('tableService');

  const btnUpdt = document.getElementById('update');
  btnUpdt.setAttribute('onclick', 'updateService('+id+')');

  updtName.value = updt.childNodes[1].innerHTML;
  updtDescription.value =  updt.childNodes[2].innerHTML;
  updtPrice.value =  updt.childNodes[3].innerHTML;


}


function updateService(id){


const name = document.getElementById('updateName').value;
const description = document.getElementById('updateDescription').value;
const price = document.getElementById('updatePrice').value;
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
req.send(`id=${id}&name=${name}&description=${description}&price=${price}&selectValue=${selectValue}`);

}