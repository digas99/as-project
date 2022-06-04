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

const ticketPopup = (data) => {
	const wrapper = document.createElement("div");
	wrapper.classList.add("ticket-popup", "ticket-popup-closed");

	// upper part
	const upperContainer = document.createElement("div");
	wrapper.appendChild(upperContainer);
	// close
	const closeWrapper = document.createElement("div");
	upperContainer.appendChild(closeWrapper);
	closeWrapper.classList.add("clickable");
	closeWrapper.addEventListener("click", () => {
		wrapper.classList.add("ticket-popup-closed");
		setTimeout(() => wrapper.remove(), 500);
	});
	const close = document.createElement("div");
	closeWrapper.appendChild(close);
	const xBar1 = document.createElement("div");
	close.appendChild(xBar1);
	const xBar2 = document.createElement("div");
	close.appendChild(xBar2);
	// ticket title
	const ticketTitle = document.createElement("div");
	upperContainer.appendChild(ticketTitle);
	ticketTitle.appendChild(document.createTextNode("Ticket (0)"));
	// ticket type chooser
	const typeChooserWrapper = document.createElement("div");
	upperContainer.appendChild(typeChooserWrapper);
	const typeChooser = document.createElement("ul");
	typeChooserWrapper.appendChild(typeChooser);
	["Simple", "Multiple", "Group"].forEach(typeText => {
		const type = document.createElement("li");
		typeChooser.appendChild(type);
		type.appendChild(document.createTextNode(typeText));
		if (typeText == data["ticketType"]) type.style.backgroundColor = "var(--pink)";
	});
	// no bets yet
	const noBets = document.createElement("div");
	upperContainer.appendChild(noBets);
	noBets.classList.add("no-bets");
	noBets.appendChild(document.createTextNode("No bets yet!"));

	// lower part
	const lowerContainer = document.createElement("div");
	wrapper.appendChild(lowerContainer);
	// values
	const valuesWrapper = document.createElement("div");
	lowerContainer.appendChild(valuesWrapper);
	// values first layer
	const valuesFirstLayer = document.createElement("div");
	valuesWrapper.appendChild(valuesFirstLayer);
	const valuesOdds = document.createElement("div");
	valuesFirstLayer.appendChild(valuesOdds);
	valuesOdds.appendChild(document.createTextNode("Odds: "+data["odds"]));
	const valuesPayWrapper = document.createElement("div");
	valuesFirstLayer.appendChild(valuesPayWrapper);
	valuesPayWrapper.classList.add("money-input");
	const valueInput = document.createElement("input");
	valuesPayWrapper.appendChild(valueInput);
	valueInput.type = "text";
	valueInput.value = data["ticketValue"];
	const currencyButton = document.createElement("div");
	valuesPayWrapper.appendChild(currencyButton);
	const valueCurrency = document.createElement("div");
	currencyButton.appendChild(valueCurrency);
	valueCurrency.appendChild(document.createTextNode("€"));
	const imgArrow = document.createElement("img");
	currencyButton.appendChild(imgArrow);
	imgArrow.src = "images/arrow.png";
	// values middle white space
	valuesWrapper.appendChild(document.createElement("div"));
	// values second layer
	const valuesSecondLayer = document.createElement("div");
	valuesWrapper.appendChild(valuesSecondLayer);
	const valuesPossibleWins = document.createElement("div");
	valuesSecondLayer.appendChild(valuesPossibleWins);
	valuesPossibleWins.appendChild(document.createTextNode("Possible Wins:"));
	const valuesWin = document.createElement("div");
	valuesSecondLayer.appendChild(valuesWin);
	valuesWin.appendChild(document.createTextNode(data["wins"]+"€"));
	// button
	const buttonWrapper = document.createElement("div");
	lowerContainer.appendChild(buttonWrapper);
	buttonWrapper.classList.add("clickable");
	buttonWrapper.appendChild(document.createTextNode("BET NOW"));

	return wrapper;
}

const ticketButton = document.getElementsByClassName("ticket-button")[0];
if (ticketButton) {
	ticketButton.addEventListener("click", () => {
		fetch("api/tickets?ticketType=Multiple&userId="+userSession["userId"])
			.then(response => response.json())
			.then(data => {
				const popup = ticketPopup(data["data"][0]);
				document.body.appendChild(popup);
				setTimeout(() => popup.classList.remove("ticket-popup-closed"), 50);
			});
	});
}

window.addEventListener("click", e => {
	const target = e.target;

	// click outside to close cart popup
	const ticketPopup = document.getElementsByClassName("ticket-popup")[0];
	if (ticketPopup && !target.closest(".ticket-popup") && !target.closest(".ticket-button")) {
		ticketPopup.classList.add("ticket-popup-closed");
		setTimeout(() => ticketPopup.remove(), 500);
	}
});