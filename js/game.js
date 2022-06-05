let gameId = 1;

const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('id')) {
    gameId = urlParams.get('id')
}
else
    insertUrlParam("id", 1);

const gameName = document.getElementById("game-name");
if (gameName) {
    fetch("api/games?keys=name&id="+gameId)
        .then(response => response.json())
        .then(gameData => gameName.innerHTML = gameData["data"][0]["name"]);
}

const input = document.getElementsByClassName("input-field")[0];
const streamsWrapper = document.getElementById("streams");

const searchStreamers = endpoint => {
    // clear already existing streams
	Array.from(streamsWrapper.children).forEach(game => game.remove());

    let loading = document.getElementsByClassName("loading-cover")[0];
    if (!loading)
        document.body.insertBefore(makeLoading(), streamsWrapper);

	fetch(endpoint)
        .then(response => response.json())
        .then(streams =>  {
            const nEvents = document.getElementById("n-events");
            if (nEvents) nEvents.innerText = streams["size"]+" events";
            streams["data"].sort((a, b) => new Date(a["matchBeginning"]) - new Date(b["matchBeginning"]))
                .forEach(stream => streamsWrapper.appendChild(streamBox(stream)));        
    
            loading = document.getElementsByClassName("loading-cover")[0];
            if (loading) loading.remove();
            streamsWrapper.style.removeProperty("display");
        });
}

if (urlParams.has('q')) {
	if (input) {
  	    input.value = urlParams.get('q');
  	    searchStreamers("api/streams?gameId="+gameId+"&user="+input.value);
    }
}
else {
	searchStreamers("api/streams?gameId="+gameId);
}	

if (input) {
	input.addEventListener("input", e => {
		const value = e.target.value;
		insertUrlParam("q", value);
		searchStreamers("api/streams?gameId="+gameId+"&user="+value);
	}); 
}