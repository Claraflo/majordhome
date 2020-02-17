function createCategory(){

const name = document.getElementById('name').value;
const description = document.getElementById('description').value;

const req = new XMLHttpRequest();
req.onreadystatechange = function(){
	if (req.readyState === 4) {	
		
		document.getElementById('name').value = "";
		document.getElementById('description').value = "";


		let info = document.getElementById('information');
		info.innerHTML = req.responseText;

	}
}

req.open("POST","../pages/createCategory.php");
req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
req.send(`name=${name}&description=${description}`);

}

function displayCategory(){

const req = new XMLHttpRequest();
req.onreadystatechange = function() {
   
   	if(req.readyState === 4) {
     		
    	let table = document.getElementById('table');
    	table.innerHTML = req.responseText;

    }
}
req.open('GET', '../pages/displayCategory.php');
req.send();

}

setInterval("displayCategory()", 1000);



