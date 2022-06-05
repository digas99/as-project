const streamBox = data => {
    const wrapper = document.createElement("div");
    wrapper.classList.add("stream-box");

    // click event listener
    wrapper.addEventListener("click", e => {
        const target = e.target;
        if (target.dataset.id) {
            postRequest("api/tickets?mode=increase", {
                "betId": target.dataset.id,
                "ticketId": userSession["userTickets"]["Multiple"]
            });
            const oldPopup = document.getElementsByClassName("ticket-popup")[0];
            if (oldPopup) {
                fetch(`api/tickets?ticketType=Multiple&userId=${userSession["userId"]}`)
                    .then(response => response.json())
                    .then(data => {
                        const ticketData = data["data"][0];
                        const popup = ticketPopup(ticketData);
                        document.body.insertBefore(popup, oldPopup);
                        popup.classList.remove("ticket-popup-closed");
                        // remove old popup
                        setTimeout(() => oldPopup.remove(), 50);   
                    });
            }
        }
    });

    // left container
    const leftContainer = document.createElement("div");
    wrapper.appendChild(leftContainer);
    const img = document.createElement("img");
    leftContainer.appendChild(img);
    img.src = data["thumbnail"];
    const user = document.createElement("div");
    leftContainer.appendChild(user);
    user.appendChild(document.createTextNode(data["user"]["username"]));

    // right container 
    const rightContainer = document.createElement("div");
    wrapper.appendChild(rightContainer);
    // top bar
    const topBar = document.createElement("div");
    rightContainer.appendChild(topBar);
    const date = document.createElement("div");
    topBar.appendChild(date);
    date.appendChild(document.createTextNode(data["matchBeginning"]));
    if (new Date()-new Date(data["matchBeginning"]) >= 0) {
        const span = document.createElement("span");
        topBar.appendChild(span);
        span.title = "Live match";
    }
    const topBarRight = document.createElement("div");
    topBar.appendChild(topBarRight);
    topBarRight.classList.add("stream-info");
    [data["platform"], data["matchFormat"]].forEach(imgName => {
        const img = document.createElement("img");
        topBarRight.appendChild(img);
        img.src = `images/${imgName.toLowerCase()}.png`;
    });
    // bets info
    const betsInfo = document.createElement("div");
    rightContainer.appendChild(betsInfo);
    // get bets data
    fetch("api/bets?keys=resultType,resultTeam,odd&id="+data["bets"].join(","))
        .then(response => response.json())
        .then(betsData => {
            betsData["data"].forEach(betData => {
                const betWrapper = document.createElement("div");
                betsInfo.appendChild(betWrapper);
                
                const betText = document.createElement("div");
                betWrapper.appendChild(betText);
                const bold = document.createElement("b");
                betText.appendChild(bold);
                bold.appendChild(document.createTextNode(betData["resultType"]+": "));
                betText.appendChild(document.createTextNode(betData["resultTeam"]));
    
                const betRight = document.createElement("div");
                betWrapper.appendChild(betRight);
                const odd = document.createElement("div");
                betRight.appendChild(odd);
                odd.appendChild(document.createTextNode(betData["odd"]));
                const betButton = document.createElement("div");
                betRight.appendChild(betButton);
                betButton.dataset.id = betData["id"];
                const betButtonText = document.createElement("div");
                betButton.appendChild(betButtonText);
                betButtonText.appendChild(document.createTextNode("BET"));
                const betButtonTextBold = document.createElement("b");
                betButtonText.appendChild(betButtonTextBold);
                betButtonTextBold.appendChild(document.createTextNode("$"));
                const betButtonArrow = document.createElement("div");
                betButton.appendChild(betButtonArrow);
                const arrow = document.createElement("img");
                betButtonArrow.appendChild(arrow);
                arrow.src = "images/arrow-down.svg";
            });
        });

    return wrapper;
}