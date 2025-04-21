(async () => {
    const url = new URL(window.location);
    const destinationId = url.searchParams.get("dest");
    let placeDetails;

    try {
        const response = await fetch(
            `./listActivityByDestination?dest=${destinationId}`
        );
        const data = await response.json();

        const information_section__activities_container =
            document.getElementById(
                "information_section__activities_container"
            );

        information_section__activities_container.innerHTML = data
            .map(
                (activity) => `
            <div class="card">
                <h3>${activity.Name}</h3>
                <p>${activity.Description}</p>
                <p>Precio: S/${activity.Price}</p>
            </div>
        `
            )
            .join("");
    } catch (error) {
        console.error("Error al cargar las actividades:", error);
    }

    try {
        const response = await fetch(
            `./getProgrammedTripByDestination?dest=${destinationId}`
        );
        const price = await response.text();

        const price_dataProgrammedTrip = document.getElementById(
            "price_dataProgrammedTrip"
        );
        const form = document.getElementById("form-planning-trip");

        price_dataProgrammedTrip.innerText = `Precio Total: S/${price}`;

        if (price != "--.--") {
            form.action = "./formPlanningTrip";
        } else {
            form.querySelector("button").type = "button";
        }
    } catch (error) {
        console.error("Error al cargar los destinos:", error);
    }

    try {
        console.log("Buscando lugar en Google Maps...", nameDestination);
        let urlFetch =
            "https://google-map-places-new-v2.p.rapidapi.com/v1/places:searchText";
        let options = {
            method: "POST",
            headers: {
                "x-rapidapi-key":
                    // "18f3b2bba7mshb3be33d8dd8c4f9p19ac80jsnb82308d6e070",
                    "7d20b2c277mshe7a2b80563ae31fp1a8ceejsnef969f499eca",
                "x-rapidapi-host": "google-map-places-new-v2.p.rapidapi.com",
                "Content-Type": "application/json",
                "X-Goog-FieldMask": "*",
            },
            body: JSON.stringify({
                textQuery: nameDestination,
                languageCode: "es",
                regionCode: "PE",
                rankPreference: 0,
                includedType: "",
                openNow: false,
                minRating: 0,
                maxResultCount: 1,
                strictTypeFiltering: true,
            }),
        };

        const response = await fetch(urlFetch, options);
        const result = await response.json();
        console.log(result);
        placeDetails = result.places[0];
        console.log(placeDetails);

        maptilersdk.config.apiKey = "ZISOEJg9RwzxrV6iqswp";
        const map = new maptilersdk.Map({
            container: "map", // container's id or the HTML element to render the map
            center: [
                placeDetails.location.longitude,
                placeDetails.location.latitude,
            ],
            zoom: 10,
            style: maptilersdk.MapStyle.HYBRID,
            cooperativeGestures: true,
        });

        document.getElementById("linkGoogleMaps").href =
            placeDetails.googleMapsUri;

        const information_section__photos_container = document.getElementById(
            "information_section__photos_container"
        );

        urlFetch = `https://google-map-places-new-v2.p.rapidapi.com/v1/places/${
            placeDetails.id
        }/photos/${
            placeDetails.photos[0].name.split("/")[3]
        }/media?maxWidthPx=1920&maxHeightPx=1080&skipHttpRedirect=true`;
        options = {
            method: "GET",
            headers: {
                "x-rapidapi-key":
                    // "18f3b2bba7mshb3be33d8dd8c4f9p19ac80jsnb82308d6e070",
                    "7d20b2c277mshe7a2b80563ae31fp1a8ceejsnef969f499eca",
                "x-rapidapi-host": "google-map-places-new-v2.p.rapidapi.com",
            },
        };

        const sleep = (ms) => new Promise((res) => setTimeout(res, ms));

        options = {
            method: "GET",
            headers: {
                "x-rapidapi-key":
                    // "18f3b2bba7mshb3be33d8dd8c4f9p19ac80jsnb82308d6e070",
                    "7d20b2c277mshe7a2b80563ae31fp1a8ceejsnef969f499eca",
                "x-rapidapi-host": "google-map-places-new-v2.p.rapidapi.com",
            },
        };

        // placeDetails.photos.forEach(async (photo) => {
        //     urlFetch = `https://google-map-places-new-v2.p.rapidapi.com/v1/places/${
        //         placeDetails.id
        //     }/photos/${
        //         photo.name.split("/")[3]
        //     }/media?maxWidthPx=1920&maxHeightPx=1080&skipHttpRedirect=true`;

        //     try {
        //         const res = await fetch(urlFetch, options);
        //         const data = await res.json();

        //         const viewPhoto = document.createElement("div");
        //         viewPhoto.classList.add("view_photo");

        //         // HTML interno
        //         viewPhoto.innerHTML = `
        //     <div class="view_photo__photo">
        //         <img src="${data.photoUri}" alt="Foto del lugar" loading="lazy">
        //     </div>
        //     <div class="view_photo__data">
        //         <div class="view_photo__author_photo">
        //             <img
        //                 src="${
        //                     photo.authorAttributions?.[0]?.photoUri ||
        //                     "../../assets/img/user_profile.png"
        //                 }"
        //                 alt="${
        //                     photo.authorAttributions?.[0]?.displayName ||
        //                     "Anónimo"
        //                 }"
        //                 onerror="this.src='../../assets/img/user_profile.png'"
        //                 loading="lazy"
        //             >
        //         </div>
        //         <p>${
        //             photo.authorAttributions?.[0]?.displayName || "Anónimo"
        //         }</p>
        //     </div>
        // `;

        //         information_section__photos_container.appendChild(viewPhoto);

        //         await sleep(3000); // Espera 3000ms entre imágenes
        //     } catch (err) {
        //         console.error("Error cargando la foto:", err);
        //     }
        // });
    } catch (error) {
        console.error(error);
    }
})();
