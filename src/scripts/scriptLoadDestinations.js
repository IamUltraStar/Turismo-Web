fetch(`data.php?action=${action}`, {
    method: "GET",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    }
})
.then(response => {
    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
    return response.json();
})
.then(data => {
    const destinations_section__container = document.getElementById("destinations_section__container");

    data.forEach(destination => {
        const card = document.createElement("div");
        card.className = "card";

        const img = document.createElement("img");
        img.src = destination.Image;

        const cardBody = document.createElement("div");
        cardBody.className = "card_body";

        const title = document.createElement("h1");
        title.textContent = destination.Name;

        const description = document.createElement("p");
        description.className = "card_body__description";
        description.textContent = destination.Description;

        const form = document.createElement("form");
        form.action = "view.php";
        form.method = "GET";

        const inputView = document.createElement("input");
        inputView.type = "hidden";
        inputView.name = "view";
        inputView.value = "view-destinations";

        const inputDestination = document.createElement("input");
        inputDestination.type = "hidden";
        inputDestination.name = "destination";
        inputDestination.value = destination.DestinationID;

        const button = document.createElement("button");
        button.type = "submit";
        button.textContent = "Ver más";

        form.appendChild(inputView);
        form.appendChild(inputDestination);
        form.appendChild(button);

        cardBody.appendChild(title);
        cardBody.appendChild(description);
        cardBody.appendChild(form);

        card.appendChild(img);
        card.appendChild(cardBody);

        destinations_section__container.appendChild(card);
    });
})
.catch(error => {console.error("Error al cargar los destinos:", error);});