(async () => {
    try {
        const response = await fetch(action);
        const data = await response.json();

        const destinations_section__container = document.getElementById(
            "destinations_section__container"
        );

        destinations_section__container.innerHTML = data
            .map(
                (destination) => `
            <div class="card">
                <img src="${destination.Image}" loading="lazy" alt="${destination.Name}">
                <div class="card_body">
                    <h1>${destination.Name}</h1>
                    <p class="card_body__description">${destination.Description}</p>
                    <form action="./destinations" method="GET">
                        <input type="hidden" name="dest" value="${destination.DestinationID}">
                        <button type="submit">Ver más</button>
                    </form>
                </div>
            </div>
        `
            )
            .join("");
    } catch (error) {
        console.error("Error al cargar los destinos:", error);
    }
})();
