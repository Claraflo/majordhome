displayUnpublishedService();


function createService(){

const name = document.getElementById('name').value;
const price = document.getElementById('price').value;

const select = document.getElementById('select');
const selectValue = select.options[select.selectedIndex].innerHTML;

const description = document.getElementById('description').value;

const req = new XMLHttpRequest();
req.onreadystatechange = function(){
	if (req.readyState === 4) {	
		
		document.getElementById('name').value = "";
		document.getElementById('description').value = "";
		document.getElementById('price').value = "";



		let info = document.getElementById('information');
		info.innerHTML = req.responseText;
  		displayUnpublishedService();

    

	}
}

req.open("POST","../pages/saveService.php");
req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
req.send(`name=${name}&description=${description}&price=${price}&selectValue=${selectValue}`);





}


function displayUnpublishedService(){


 const req = new XMLHttpRequest();
 req.onreadystatechange = function() {
   
 	if(req.readyState === 4) {
     		
     	let table = document.getElementById('table');
     	table.innerHTML = req.responseText;

     }
 }

 req.open('GET', '../pages/displayUnpublishedService.php');
 req.send();


}