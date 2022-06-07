const pay = document.getElementById("pay");
if (pay) {
	pay.addEventListener("click", () => {
		if (pay.dataset.value) {
			fetch("api/users?keys=money&id="+userSession["userId"])
				.then(response => response.json())
				.then(data => {
					postRequest("api/users?mode=balance", {
						"id": userSession["userId"],
						"money": Number(data["data"][0]["money"])+Number(pay.dataset.value)
					}, () => window.location.reload());
				});
		}
	});
}

const depositValues = document.getElementsByClassName("deposit-values")[0];
if (depositValues) {
	Array.from(depositValues.getElementsByTagName("button")).forEach(deposit => {
		deposit.addEventListener("click", () => {

			if (pay && !deposit.classList.contains("deposit-values-selected")) {
				pay.dataset.value = deposit.innerText.replaceAll("€", "");
				Array.from(document.getElementsByClassName("deposit-values-selected")).forEach(deposit => deposit.classList.remove("deposit-values-selected"));	
				deposit.classList.add("deposit-values-selected");
			}
			
			else if (deposit.classList.contains("deposit-values-selected")) {
				deposit.classList.remove("deposit-values-selected");
				pay.dataset.value = "";
			}

		});
	});
}
