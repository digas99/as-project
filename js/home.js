const updateGamesList = (gamesWrapper, data) => {
	// clear already existing games
	Array.from(gamesWrapper.children).forEach(game => game.remove());
	
	// loop through each game
	data.sort((a, b) => Number(b["streams"]) - Number(a["streams"]))
		.forEach(game => {
			const wrapper = document.createElement("div");
			gamesWrapper.appendChild(wrapper);
			const gameLink = document.createElement("a");
			wrapper.appendChild(gameLink);
			gameLink.href = "game?id="+game["id"];
			const gameInfo = document.createElement("ul");
			gameLink.appendChild(gameInfo);
			gameInfo.classList.add("game");
			
			const gameCoverWrapper = document.createElement("li");
			gameInfo.appendChild(gameCoverWrapper);
			const gameCover = document.createElement("img");
			gameCoverWrapper.appendChild(gameCover);
			gameCover.src = game["cover"];
			
			const gameNameWrapper = document.createElement("li");
			gameInfo.appendChild(gameNameWrapper);
			const gameName = document.createElement("div");
			gameNameWrapper.appendChild(gameName);
			gameName.appendChild(document.createTextNode(game["name"]));
			const gameStreams = document.createElement("div");
			gameNameWrapper.appendChild(gameStreams);
			gameStreams.appendChild(document.createTextNode((game["streams"] +" events")));
			
			gameInfo.addEventListener("mouseover", e => {
				gameInfo.style.filter = "opacity(0.7)";
				gameCover.style.transform = "scale(1.05)";
			});
					
			gameInfo.addEventListener("mouseout", e => {
				gameInfo.style.removeProperty("filter");
				gameCover.style.removeProperty("transform");
			});
		});
		
		// if no games found
		if (data.length == 0) {
			const noGames = document.createElement("p");
			gamesWrapper.appendChild(noGames);
			noGames.appendChild(document.createTextNode("No games found!"));
		}

		// wait until all game covers are loaded
		Promise.all(Array.from(gamesWrapper.getElementsByTagName("img"))
				.filter(img => !img.complete)
				.map(img => new Promise(resolve => { img.onload = img.onerror = resolve; })))
			.then(() => {
				const loading = document.getElementsByClassName("loading-cover")[0];
				if (loading) loading.remove();
				gamesWrapper.style.removeProperty("display");
			});
}

// number of games
let nGames = 0;
const input = document.getElementsByClassName("input-field")[0];

const searchGames = endpoint => {
	fetch(endpoint)
		.then(response => response.json())
		.then(data => {
			nGames = data["size"];
			const gamesTitle = document.getElementById("n-games");
			if (gamesTitle) {
				gamesTitle.innerHTML = `Games (${nGames})`;
			}
			data = data["data"];
			
			const gamesWrapper = document.getElementsByClassName("games-list")[0];
			if (gamesWrapper) {
				updateGamesList(gamesWrapper, data);
			}
		});
}

const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('q')) {
	if (input)
  	input.value = urlParams.get('q');
  	searchGames("api/games?name="+input.value);

}
else {
	searchGames("api/games");
}
	
const insertUrlParam = (key, value) => {
	let searchParams = new URLSearchParams(window.location.search);
	searchParams.set(key, value);
	let newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + searchParams.toString();
	window.history.replaceState({}, '', newurl);
}
	

if (input) {
	input.addEventListener("input", e => {
		const value = e.target.value;
		insertUrlParam("q", value);
		searchGames("api/games?name="+value);
	}); 
}
