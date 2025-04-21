document.addEventListener("DOMContentLoaded", async () => {
    const button_profile_user = document.getElementById("button_profile_user");
    const menu_profile_user = document.getElementById("menu_profile_user");
    const select_list_programmed_trips = document.getElementById(
        "select_list_programmed_trips"
    );
    const list_programmed_trips = document.getElementById(
        "list_programmed_trips"
    );

    // Mostrar/ocultar el menú al hacer clic en el ícono
    button_profile_user.addEventListener("click", () => {
        menu_profile_user.classList.toggle("hidden");
    });

    select_list_programmed_trips.addEventListener("click", () => {
        list_programmed_trips.classList.toggle("active");
    });

    // Ocultar el menú al hacer clic fuera de él
    document.addEventListener("click", (event) => {
        if (
            !menu_profile_user.contains(event.target) &&
            event.target !== button_profile_user
        ) {
            menu_profile_user.classList.add("hidden");
        }

        if (
            !list_programmed_trips.contains(event.target) &&
            event.target !== select_list_programmed_trips
        ) {
            list_programmed_trips.classList.remove("active");
        }
    });

    try {
        const response = await fetch("./verifyExistSession");
        const data = await response.text();

        if (data) {
            button_profile_user.innerText = data;
        }
    } catch (error) {
        console.error("Error al cargar los destinos:", error);
    }

    try {
        const response = await fetch("./listProgrammedTripAvailable");
        const data = await response.json();

        const list_programmed_trips = document.getElementById(
            "list_programmed_trips"
        );

        data.forEach((programmedTrip) => {
            const dropdown_option = document.createElement("div");
            dropdown_option.className = "dropdown-option";
            dropdown_option.setAttribute(
                "data-id",
                programmedTrip.ProgrammedTripID
            );
            dropdown_option.textContent = programmedTrip.Name;

            list_programmed_trips.appendChild(dropdown_option);
        });

        if (data.length > 3) {
            list_programmed_trips.classList.add("scroll-y");
        }

        document.querySelectorAll(".dropdown-option").forEach((option) => {
            option.addEventListener("click", async function () {
                const ProgrammedTripID = this.getAttribute("data-id");
                const select_list_programmed_trips = document.getElementById(
                    "select_list_programmed_trips"
                );
                const hiddenInput = document.getElementById("selected_trip_id");
                const tripDateField = document.getElementById("trip_date");
                const tripPriceField = document.getElementById("trip_price");

                select_list_programmed_trips.innerText = this.innerText;
                hiddenInput.value = ProgrammedTripID;
                list_programmed_trips.classList.remove("active");

                try {
                    const response = await fetch(
                        `./getProgrammedTrip?trip=${ProgrammedTripID}`
                    );
                    const data = await response.json();

                    tripDateField.value =
                        `${data.StartDate} al ${data.EndDate}` ||
                        "No disponible";
                    tripPriceField.value = data.Price || "No disponible";
                } catch (error) {
                    console.error(
                        "Error al cargar los detalles del viaje:",
                        error
                    );
                }
            });
        });
    } catch (error) {
        console.error("Error al cargar los destinos:", error);
    }
});
