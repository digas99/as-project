let ticketData = {};

const ticketPopup = data => {
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
		// extend list of streams
		const streams = document.getElementById("streams");
		if (streams) document.body.classList.remove("shrinked-streams");
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
	ticketTitle.appendChild(document.createTextNode(`Ticket (${data["bets"].length})`));
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

		type.addEventListener("click", e => {

			fetch(`api/tickets?ticketType=${typeText}&userId=${userSession["userId"]}`)
				.then(response => response.json())
				.then(data => {
					const oldPopup = document.getElementsByClassName("ticket-popup")[0];
                    ticketData = data["data"][0];
					const popup = ticketPopup(ticketData);
					document.body.insertBefore(popup, oldPopup);
					popup.classList.remove("ticket-popup-closed");
					// remove old popup
                        setTimeout(() => oldPopup.remove(), 50);   
				});
		});
	});

	if (data["bets"].length > 0) {
		// put all bets
		const betsContainer = document.createElement("div");
		upperContainer.appendChild(betsContainer);
		fetch("api/bets?id="+data["bets"].join(","))
			.then(response => response.json())
			.then(betData => betData["data"].forEach(bet => betsContainer.appendChild(ticketBet(bet, data["ticketType"]))));
	}
	else {
		// no bets yet
		const noBets = document.createElement("div");
		upperContainer.appendChild(noBets);
		noBets.classList.add("no-bets");
		noBets.appendChild(document.createTextNode("No bets yet!"));
	}

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
	valuesWin.appendChild(document.createTextNode((Number(data["ticketValue"])*Number(data["odds"])).toFixed(2)+"€"));
	// button
	const buttonWrapper = document.createElement("div");
	lowerContainer.appendChild(buttonWrapper);
	buttonWrapper.classList.add("clickable");
	if (Number(ticketData["odds"]) == 0)
		buttonWrapper.classList.add("disabled");
	buttonWrapper.appendChild(document.createTextNode("BET NOW"));
	buttonWrapper.addEventListener("click", () => {
		if (Number(ticketData["odds"]) != 0) {
			// place bets
		}
	});

    valueInput.addEventListener("input", () => {
        ticketData["ticketValue"] = !isNaN(valueInput.value) ? valueInput.value : ticketData["ticketValue"];
        postRequest("api/tickets?mode=update", ticketData);

		valuesWin.innerText = (Number(ticketData["ticketValue"])*Number(ticketData["odds"])).toFixed(2)+"€";
    });

	return wrapper;
}

const ticketBet = (data, ticketType) => {
	const wrapper = document.createElement("div");
	wrapper.classList.add("ticket-bet");
	
	//bet info
	const betInfo = document.createElement("div");
	wrapper.appendChild(betInfo);
	// upper info
	const upperInfo = document.createElement("div");
	betInfo.appendChild(upperInfo);
	const date = document.createElement("div");
	upperInfo.appendChild(date);
	date.appendChild(document.createTextNode(data["stream"]["matchBeginning"]));
	const game = document.createElement("div");
	upperInfo.appendChild(game);
	fetch("api/games?keys=name&id="+data["stream"]["gameId"])
		.then(response => response.json())
		.then(gameData => {
			game.appendChild(document.createTextNode(gameData["data"][0]["name"]));
		});
	// lower info
	const lowerInfo = document.createElement("div");
	betInfo.appendChild(lowerInfo);
	const teams = document.createElement("div");
	lowerInfo.appendChild(teams);
	teams.appendChild(document.createTextNode(`${data["stream"]["teamA"]} vs ${data["stream"]["teamB"]}`));
	const betTitle = document.createElement("div");
	lowerInfo.appendChild(betTitle);
	const bold = document.createElement("b");
	betTitle.appendChild(bold);
	bold.appendChild(document.createTextNode(data["resultType"]+":"));
	betTitle.appendChild(document.createTextNode(data["resultTeam"]));
	const odd = document.createElement("div");
	lowerInfo.appendChild(odd);
	odd.appendChild(document.createTextNode(data["odd"]));

	// bin
	const binWrapper = document.createElement("div");
	wrapper.appendChild(binWrapper);
	const bin = document.createElement("img");
	binWrapper.appendChild(bin);
	bin.src="images/bin.png";
	binWrapper.addEventListener("click", () => {
		postRequest("api/tickets?mode=decrease", {
			"betId": data["id"],
			"ticketId": userSession["userTickets"][ticketType]
		});

		fetch(`api/tickets?ticketType=Multiple&userId=${userSession["userId"]}`)
			.then(response => response.json())
			.then(data => {
				const oldPopup = document.getElementsByClassName("ticket-popup")[0];
				const ticketData = data["data"][0];
				const popup = ticketPopup(ticketData);
				document.body.insertBefore(popup, oldPopup);
				popup.classList.remove("ticket-popup-closed");
				// remove old popup
				setTimeout(() => oldPopup.remove(), 50);   
			});
	});
	
	return wrapper;
}

const ticketButton = document.getElementsByClassName("ticket-button")[0];
if (ticketButton) {
	ticketButton.addEventListener("click", () => {
		fetch("api/tickets?ticketType=Multiple&userId="+userSession["userId"])
			.then(response => response.json())
			.then(data => {
                ticketData = data["data"][0];
				const popup = ticketPopup(ticketData);
				document.body.appendChild(popup);
				setTimeout(() => popup.classList.remove("ticket-popup-closed"), 50);

				const streams = document.getElementById("streams");
				if (streams) document.body.classList.add("shrinked-streams");
			});
	});
}

window.addEventListener("click", e => {
	const target = e.target;

	// click outside to close cart popup
	const ticketPopup = document.getElementsByClassName("ticket-popup")[0];
	if (ticketPopup && !target.closest(".ticket-popup") && !target.closest(".ticket-button") && window.getComputedStyle(target)["cursor"] !== "pointer") {
		ticketPopup.classList.add("ticket-popup-closed");
		setTimeout(() => ticketPopup.remove(), 500);

		// extend list of streams
		const streams = document.getElementById("streams");
		if (streams) document.body.classList.remove("shrinked-streams");
	}
});

// update value on ticket button
fetch("api/tickets?keys=bets&id="+userSession["userTickets"]["Multiple"])
	.then(response => response.json())
	.then(data => {
		const ticketButton = document.getElementsByClassName("ticket-button")[0];
		if (ticketButton) {
			const ticketButtonNumber = ticketButton.getElementsByClassName("absolute-centered")[0];
			if (ticketButtonNumber) ticketButtonNumber.innerHTML = data["data"][0]["bets"].length;
		}
	});