(() => {
    document
        .getElementById("select_department")
        .addEventListener("change", () => {
            searchDestination();
        });
})();

const searchDestination = async () => {
    const queryDestination = document.getElementById("queryDestination");
    const filter = queryDestination.value;

    const selectDepartment = document.getElementById("select_department").value;

    try {
        const response = await fetch(
            `./listDestinationSearched?query=${filter}&location=${selectDepartment}`
        );
        const data = await response.json();

        const destinations_section__container = document.getElementById(
            "destinations_section__container"
        );

        destinations_section__container.innerHTML = "";

        if (data.length > 0) {
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
        } else {
            destinations_section__container.innerHTML =
                "<p style='margin-left:2px;'>No se encontraron destinos.</p>";
        }
    } catch (error) {
        console.error("Error al cargar los destinos:", error);
    }
};

const resetFilterInputs = () => {
    document.getElementById("queryDestination").value = "";
    document.getElementById("select_department").value = "";
    searchDestination();
};
