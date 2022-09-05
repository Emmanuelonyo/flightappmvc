// flight search 

const flightfrom = document.getElementById("flightFrom")
const flightTo = document.getElementById("flightTo")
const flightFromOption = document.getElementById("flightFromOption")
const flightToOption = document.getElementById("flightToOption")
const submitFlight = document.getElementById('submitFlight')
const flightForm = document.getElementById('bookingFlight')

flightfrom.addEventListener("input", () => {
	if(flightfrom.value.length > 0){

	const data = JSON.stringify({
	  "subType": "CITY,AIRPORT",
	  "keyword": flightfrom.value
	});

	const options = {
		method: 'POST',
		headers: {'Content-Type': 'application/json'},
		body: data
	  };
	  
	  fetch('api/v1/airport-list', options)
		.then(response => response.json())
		.then( (response) => {

			 let resp = response.data
		
			var len=flightToOption.options.length; 
			if(len > 0) {flightToOption.innerHTML = ''}

			resp.forEach(function(k){
			
			// flightFromOption.innerHTML = `<option value="${k.name}">`

			newOption = document.createElement("option");
			newOption.value = k.id;  // assumes option string and value are the same
			newOption.text = k.name;  // assumes option string and value are the same
		
			try { 
				flightFromOption.add(newOption);  // this will fail in DOM browsers but is needed for IE
			}catch (e) {      
				flightFromOption.appendChild(newOption);      
			} 
	   
			})



			})
		.catch(err => console.error(err));


	}
})


//flight to autocomplete search
flightTo.addEventListener("input", () => {
	if(flightTo.value.length > 0){

	const data = JSON.stringify({
	  "subType": "CITY,AIRPORT",
	  "keyword": flightTo.value
	});

	const options = {
		method: 'POST',
		headers: {'Content-Type': 'application/json'},
		body: data
	  };
	  
	  fetch('api/v1/airport-list', options)
		.then(response => response.json())
		.then( (response) => {

			// console.log(flightToOption);
			var len=flightToOption.options.length; 
			if(len > 0) {flightToOption.innerHTML = ''}

			response.data.forEach(function(k){
			
			// flightToOption.innerHTML = `<option value="${k.name}">`

			newList = document.createElement("option");
			newList.value = k.id;  // assumes option string and value are the same
			newList.text = k.name;  // assumes option string and value are the same
		
			try { 
				flightToOption.add(newList);  // this will fail in DOM browsers but is needed for IE
			}catch (e) {      
				flightToOption.appendChild(newList);      
			} 
	   
			})



			})
		.catch(err => console.error(err));


	}
})

//search flight details
document.addEventListener('submit', async (e) =>{
	e.preventDefault()
	
	const  formdata = serializeForm(e.target)

	console.log(formdata);
	rootDOM.innerHTML = `${searchResultContent}`
	
})

var serializeForm = function (form) {
	var obj = {};
	var formData = new FormData(form);
	for (var key of formData.keys()) {
		obj[key] = formData.get(key);
	}
	return obj;
};