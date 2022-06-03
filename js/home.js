fetch("api/games.php")
	.then(response => response.json())
	.then(data => {
		const nGames = data["size"];
		data = data["data"];
		
		const gamesWrapper = document.getElementsByClassName("games-list")[0];
		if (gamesWrapper) {
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
				});
		}
	});
