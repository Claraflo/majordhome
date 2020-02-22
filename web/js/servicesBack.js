
// var id = 0;

// function test(){

// const select = document.getElementById('select');
// const valueSelect = select.options[select.selectedIndex].text; // Récupération de la valeur du select 
// const name = document.getElementById('name').value // récupération du nom de champ
// const form = document.getElementById('form'); // container 


// nameValue = name.trim();

// if (nameValue != ""){

// id++;
// const createDiv = document.createElement("div");
// const createInput= document.createElement("input"); // Création de ma balise <input>
// const createLabel = document.createElement("label"); 
// const createBtn = document.createElement("i");


// // Les attributs de ma nouvelle balise


// createDiv.id = id;

// createBtn.setAttribute("class","fas fa-trash");
// createBtn.setAttribute("onclick","remove("+id+")");

// createLabel.innerHTML = nameValue;


// createInput.type = valueSelect;
// createInput.setAttribute("class","form-control");
// createInput.setAttribute("placeholder",valueSelect);



// // Ajout à mon container ! 

// form.appendChild(createDiv);

// createDiv.appendChild(createLabel);
// createDiv.appendChild(createInput);
// createDiv.appendChild(createBtn);



// }


// }


// function remove(id){


// 	  const del = document.getElementById(id);
//        del.parentNode.removeChild(del);


// }





// displayPublishedServices();

// function displayPublishedServices(){

// const req = new XMLHttpRequest();
// req.onreadystatechange = function() {
   
//    	if(req.readyState === 4) {
     		
//     	let table = document.getElementById('table');
//     	table.innerHTML = req.responseText;

//     }
// }
// req.open('GET', '../pages/displayPublishedServices.php');
// req.send();
// }











