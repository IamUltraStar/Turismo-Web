const url = new URL(window.location);
const destinationId = url.searchParams.get('destination');

fetch("data.php?action=list-activity-by-destination", {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `destinationId=${destinationId}`
})
.then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
})
.then(data => {
    const information_section__activities_container = document.getElementById("information_section__activities_container");

    data.forEach(activity => {
        const width_card = document.createElement("div");
        width_card.className = "width-card";

        const card = document.createElement("div");
        card.className = "card";

        const title = document.createElement("h3");
        title.textContent = activity.Name;

        const description = document.createElement("p");
        description.textContent = activity.Description;

        const price = document.createElement("p");
        price.textContent = `Precio: S/${activity.Price}`;

        card.appendChild(title);
        card.appendChild(description);
        card.appendChild(price);

        width_card.appendChild(card);

        information_section__activities_container.appendChild(width_card);
    });
})
.catch(error => {console.error("Error:", error);});

fetch("data.php?action=get-programmed-trip-by-destination", {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `destinationId=${destinationId}`
})
.then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.text();
})
.then(price => {
    const price_dataProgrammedTrip = document.getElementById("price_dataProgrammedTrip");
    const form = document.getElementById("form-planning-trip");
    
    price_dataProgrammedTrip.innerText = `Precio Total: S/${price}`;

    if (price != "--.--") {
        form.action = "view.php";
        form.method = "GET";

        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "view";
        input.value = "form-planning-trip";

        form.append(input);
    }else{
        form.querySelector("button").type = "button";
    }
})
.catch(error => {console.error("Error:", error);});