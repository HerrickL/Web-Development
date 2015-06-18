window.onload = function(){
	//if anything is in local storage, display it
	for(var index = 0; index < localStorage.length; index++){
		url = localStorage.key(index);
		description = localStorage.getItem(url);

		AppendFavorites(url, description);
	}
}

/* Begin search section */

function getSearch(){
	//clear previous search results if necessary
	clearSearch();

	//variables
	var uPages = document.getElementById("pages");
	var uPages = uPages.options[uPages.selectedIndex].value;
	var thisPage = 1;

	//make ajax request per amount of pages specified by user
	for(thisPage; thisPage <= uPages; thisPage++)
	{
		var url = "https://api.github.com/gists?page=" + thisPage + "&per_page=30";
		ajaxRequest(url);
	}
}


//AJAX request
function ajaxRequest(url){	
	var req = new XMLHttpRequest();
	try{
		if(!req) throw 'Unable to create HttpRequest';
		}
	catch(err){
		message.innerHTML = "Error: " + err;
	}
	req.onreadystatechange = function(){
		//if page can load per w3 specs
		if(this.readyState === 4 && this.status === 200){

			//vars about to be used inside loop
			var objUrl, objDescrip, objLang;

			//JSON parse for each page
			var jsonObjects = JSON.parse(this.responseText);
		

			//iterate through base objects on page
			for(project in jsonObjects){

				//filenames are seperate objects with 'filename' as property also, get all
				for(var filename in jsonObjects[project].files)
				{
					//set vars
					objDescrip = jsonObjects[project].description;
					objLang = jsonObjects[project].files[filename].language;
					//there are mult urls, this points to direct file referencing, change if necessary
					objUrl = jsonObjects[project].files[filename].raw_url;

					//reduce selection to user language specs
					if(document.getElementById('Python').checked && objLang == 'Python'){
						//check if should display
						if(objDescrip == null || objDescrip == "")
						{
							objDescrip = "[no decscription given]";
						}
						//check if in favs
						favsCheck("Python: " + objDescrip, objUrl);
						}
					else if(document.getElementById('JSON').checked && objLang == 'JSON'){
						//check if should display
						if(objDescrip == null || objDescrip == "")
						{
							objDescrip = "[no decscription given]";
						}
						//check if in favs
						favsCheck("JSON: " + objDescrip, objUrl);
					}
					else if(document.getElementById('JavaScript').checked && objLang == 'JavaScript'){
						//check if should display
						if(objDescrip == null || objDescrip == "")
						{
							objDescrip = "[no decscription given]";
						}
						//check if in favs
						favsCheck("JavaScript: " + objDescrip, objUrl);
					}
					else if(document.getElementById('SQL').checked && objLang == 'SQL'){
						//check if should display
						if(objDescrip == null || objDescrip == "")
						{
							objDescrip = "[no decscription given]";
						}
						//check if in favs
						favsCheck("SQL: " + objDescrip, objUrl);
					}
					//if none are checked, all given options should be included
					else if(!document.getElementById('SQL').checked && !document.getElementById('SQL').checked && 
						!document.getElementById('JavaScript').checked && !document.getElementById('JSON').checked &&
						!document.getElementById('Python').checked){
						if(objDescrip == null || objDescrip == "")
						{
							objDescrip = "[no decscription given]";
						}
						//check if in favs
						favsCheck(objLang + ": " + objDescrip, objUrl);

					}

				}
			}
		}		

	};	
	req.open('GET', url);
	req.send();
}

function AppendResults(objDescrip, url){
	var dt = document.createElement('dt');
	//use url to set link with description
	dt.innerHTML = "<a href=" + url + ">" +  objDescrip + "</a>";
	//add to description list with space between 'dt's
	document.getElementById('results').appendChild(dt);

	//favorite button
	var favButton = document.createElement('BUTTON');
	favButton.type = "button";
	favButton.innerHTML = "Favorite";
	favButton.onclick = function(){
		//save info and send to favs
		console.log("button was clicked");
		console.log(url);
		SaveFavorite(url, objDescrip);

		//delete elemts from search list
		dt.remove();
		favButton.remove();
		spaceing1.remove()
	};
	document.getElementById('results').appendChild(favButton);

	//spacing for visual distinction
	var spaceing1 = document.createElement('br');
	document.getElementById('results').appendChild(spaceing1);
	var spaceing2 = document.createElement('br');
	document.getElementById('results').appendChild(spaceing2);

}

function clearSearch(){
	var list = document.getElementById('results');

	//if any dt in dl, remove
	while(list.firstChild){
		list.removeChild(list.lastChild);
	}
}

/* Begin Favorites Section */

function SaveFavorite(url, description){
	//store and display favorited items
	localStorage.setItem(url, description);
	AppendFavorites(url, description);
}

function ClearFavs(url, description){
	localStorage.removeItem(url);
}

function AppendFavorites(url, description){
	var dt = document.createElement('dt');
	//use url to set link with description
	dt.innerHTML = "<a href=" + url + ">" +  description + "</a>";
	//add to description list with space between 'dt's
	document.getElementById('favorites').appendChild(dt);

	//favorite button
	var clearButton = document.createElement('BUTTON');
	clearButton.type = "button";
	clearButton.innerHTML = "remove";

	clearButton.onclick = function(){
		//save info and send to favs
		console.log("button was clicked");
		ClearFavs(url, description);

		//delete elemts from search list
		dt.remove();
		clearButton.remove();
		spaceing3.remove();
	};

	document.getElementById('favorites').appendChild(clearButton);

	//spacing for visual distinction
	var spaceing3 = document.createElement('br');
	document.getElementById('favorites').appendChild(spaceing3);
	var spacing4 = document.createElement('br');
	document.getElementById('favorites').appendChild(spaceing3);
}

function favsCheck(objDescrip, objUrl){
	var isMatch = false;

	//if local storage, iterate through
	for(var index = 0; index < localStorage.length; index++){
		url = localStorage.key(index);
		description = localStorage.getItem(url);

		//if urls are a match, end
		if(objUrl === url){
			isMatch = true;
			index = localStorage.length;
		}
	}
	//if there is no match, result is unique, display
	if(!isMatch){
		AppendResults(objDescrip, objUrl);
	}
}
