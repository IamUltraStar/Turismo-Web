let map, placeDetails;

(async () => {
    const url = new URL(window.location);
    const destinationId = url.searchParams.get("dest");

    document
        .getElementById("stars")
        .querySelectorAll("button")
        .forEach((button, index) => {
            button.addEventListener("click", (event) => {
                const selectedRating = index + 1;
                document.getElementById("rating").value = selectedRating;

                document
                    .getElementById("stars")
                    .querySelectorAll("button")
                    .forEach((btn, i) => {
                        if (i + 1 <= selectedRating) {
                            btn.querySelector("svg").classList.value =
                                "w-6 h-6 transition-colors";
                            btn.querySelector("svg").classList.add(
                                "fill-amber-400",
                                "text-amber-400"
                            );
                        } else {
                            btn.querySelector("svg").classList.value =
                                "w-6 h-6 transition-colors";
                            btn.querySelector("svg").classList.add(
                                "text-gray-600",
                                "hover:fill-amber-200",
                                "hover:text-amber-200"
                            );
                        }
                        console.log("btnupdated");
                    });
            });
        });

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

    console.log("destinationName", `${nameDestination} ${locationDestination}`);

    try {
        let urlFetch =
            "https://google-map-places-new-v2.p.rapidapi.com/v1/places:searchText";
        let options = {
            method: "POST",
            headers: {
                "x-rapidapi-key":
                    "18f3b2bba7mshb3be33d8dd8c4f9p19ac80jsnb82308d6e070",
                // "7d20b2c277mshe7a2b80563ae31fp1a8ceejsnef969f499eca",
                "x-rapidapi-host": "google-map-places-new-v2.p.rapidapi.com",
                "Content-Type": "application/json",
                "X-Goog-FieldMask": "*",
            },
            body: JSON.stringify({
                textQuery: `${nameDestination}`,
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
        placeDetails = result.places[0];

        maptilersdk.config.apiKey = "ZISOEJg9RwzxrV6iqswp";
        map = new maptilersdk.Map({
            container: "map", // container's id or the HTML element to render the map
            center: [
                placeDetails.location.longitude,
                placeDetails.location.latitude,
            ],
            zoom: 6,
            style: maptilersdk.MapStyle.HYBRID,
            cooperativeGestures: true,
        });

        const marker = new maptilersdk.Marker()
            .setLngLat([
                placeDetails.location.longitude,
                placeDetails.location.latitude,
            ])
            .addTo(map);

        const start = [-77.11705, -12.062286]; // [lng, lat]
        const end = [
            placeDetails.location.longitude,
            placeDetails.location.latitude,
        ];
        const curvedCoords = generateCurve(start, end, 0.3);

        var geojson = {
            type: "FeatureCollection",
            features: [
                {
                    type: "Feature",
                    properties: {},
                    geometry: {
                        coordinates: curvedCoords,
                        type: "LineString",
                    },
                },
            ],
        };

        map.on("load", function () {
            map.addSource("line", {
                type: "geojson",
                lineMetrics: true,
                data: geojson,
            });

            map.addLayer({
                id: "geojson-overlay-line",
                type: "line",
                source: "line",
                layout: {},
                paint: {
                    "line-color": "#fff",
                    "line-width": 3,
                },
            });
        });

        document.getElementById("linkGoogleMaps").href =
            placeDetails.googleMapsUri;

        const information_section__photos_container = document.getElementById(
            "information_section__photos_container"
        );

        options = {
            method: "GET",
            headers: {
                "x-rapidapi-key":
                    "18f3b2bba7mshb3be33d8dd8c4f9p19ac80jsnb82308d6e070",
                // "7d20b2c277mshe7a2b80563ae31fp1a8ceejsnef969f499eca",
                "x-rapidapi-host": "google-map-places-new-v2.p.rapidapi.com",
            },
        };

        const sleep = (ms) => new Promise((res) => setTimeout(res, ms));
        const photos = placeDetails.photos.slice(0, 4);
        // information_section__photos_container.innerHTML = "";

        // for (let i = 0; i < photos.length; i++) {
        //     const photo = photos[i];
        //     const photoName = photo.name.split("/")[3];
        //     const url = `https://google-map-places-new-v2.p.rapidapi.com/v1/places/${placeDetails.id}/photos/${photoName}/media?maxWidthPx=1920&maxHeightPx=1080&skipHttpRedirect=true`;

        //     try {
        //         const res = await fetch(url, options);
        //         const data = await res.json();

        //         const viewPhoto = document.createElement("div");
        //         viewPhoto.classList.add("view_photo");

        //         // HTML interno
        //         viewPhoto.innerHTML = `
        //             <div class="view_photo__photo">
        //                 <img src="${
        //                     data.photoUri
        //                 }" alt="Foto del lugar" loading="lazy">
        //             </div>
        //             <div class="view_photo__data">
        //                 <div class="view_photo__author_photo">
        //                     <img
        //                         src="${
        //                             photo.authorAttributions?.[0]?.photoUri ||
        //                             "../../assets/img/user_profile.png"
        //                         }"
        //                         alt="${
        //                             photo.authorAttributions?.[0]
        //                                 ?.displayName || "Anónimo"
        //                         }"
        //                         onerror="this.src='../../assets/img/user_profile.png'"
        //                         loading="lazy"
        //                     >
        //                 </div>
        //                 <p>${
        //                     photo.authorAttributions?.[0]?.displayName ||
        //                     "Anónimo"
        //                 }</p>
        //             </div>
        //         `;

        //         information_section__photos_container.appendChild(viewPhoto);
        //         await sleep(3000); // Espera 300ms entre imágenes
        //     } catch (err) {
        //         console.error("Error cargando la foto:", err);
        //     }
        // }
    } catch (error) {
        console.error(error);
    }
})();

const relocateDestination = () => {
    map.setCenter([
        placeDetails.location.longitude,
        placeDetails.location.latitude,
    ]);
    // Reset bearing to north
};

const generateCurve = (start, end, curvature = 0.2, segments = 100) => {
    const [x1, y1] = start;
    const [x2, y2] = end;

    // Calcular dirección perpendicular para la curva
    const dx = x2 - x1;
    const dy = y2 - y1;
    const distance = Math.sqrt(dx * dx + dy * dy);

    // Punto medio entre inicio y fin
    const mx = (x1 + x2) / 2;
    const my = (y1 + y2) / 2;

    // Vector perpendicular normalizado
    const normalX = -dy / distance;
    const normalY = dx / distance;

    // Punto de control desplazado desde el punto medio
    const cx = mx + normalX * distance * curvature;
    const cy = my + normalY * distance * curvature;

    // Generar la curva usando índices enteros para evitar errores de precisión
    const curve = [];
    for (let i = 0; i <= segments; i++) {
        const t = i / segments;
        const xt = (1 - t) ** 2 * x1 + 2 * (1 - t) * t * cx + t ** 2 * x2;
        const yt = (1 - t) ** 2 * y1 + 2 * (1 - t) * t * cy + t ** 2 * y2;
        curve.push([xt, yt]);
    }

    return curve;
};
