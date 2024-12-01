document.addEventListener("DOMContentLoaded", function() {
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

    navLinks.forEach(link => {
        link.addEventListener("click", function() {
            // Remover la clase 'active' de todos los enlaces
            navLinks.forEach(nav => nav.classList.remove("active"));
            // Agregar la clase 'active' al enlace clicado
            this.classList.add("active");
        });
    });
    
    fetch("admin.php?action=list-category")
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            const category_table = document.getElementById("category_table");
            const activity_select = document.getElementById("activity_select");
            
            data.forEach(category => {
                const tr = document.createElement("tr");
                const option = document.createElement("option");

                option.value = category.CategoryID;
                option.textContent = category.Name;

                tr.innerHTML = `
                            <td>${category.CategoryID}</td>
                            <td>${category.Name}</td>
                            <td>${category.Description}</td>
                            <td>
                                <form action="admin.php?action=get-category" method="POST" class="d-inline">
                                    <input type="hidden" name="category_id" value="${category.CategoryID}">
                                    <button type="submit" name="get_category" class="btn btn-info btn-sm">Editar</button>
                                </form>
                                <form action="admin.php?action=delete-category" method="POST" class="d-inline">
                                    <input type="hidden" name="category_id" value="${category.CategoryID}">
                                    <button type="submit" name="delete_category" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                            `;

                category_table.appendChild(tr);
                category_select.appendChild(option);
            });
        })
        .catch(error => {
            console.log("Ocurrio un error:", error);
        });

    /** destinos  */
    fetch("admin.php?action=list-destination")
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            const destination_table = document.getElementById("destination_table");
            const destination_select__programmedtrip = document.getElementById("destination_select__programmedtrip");
            

            data.forEach(destination => {
                const tr = document.createElement("tr");
                const option = document.createElement("option");

                option.value = destination.DestinationID;
                option.textContent = destination.Name;

                tr.innerHTML = `
                            <td>${destination.DestinationID}</td>
                            <td>${destination.Name}</td>
                            <td>${destination.Location}</td>
                            <td>${destination.Price}</td>
                            <td><img src="${destination.Image}" alt="${destination.Name}" width="50"></td>
                            <td>${destination.CategoryID}</td>
                            <td>
                                <form action="admin.php?action=get-destination" method="POST" class="d-inline">
                                    <input type="hidden" name="destination_id" value="${destination.DestinationID}">
                                    <button type="submit" name="get_destination" class="btn btn-info btn-sm">Editar</button>
                                </form>
                                <form action="admin.php?action=delete-destination" method="POST" class="d-inline">
                                    <input type="hidden" name="destination_id" value="${destination.DestinationID}">
                                    <button type="submit" name="delete_destination" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                            `;

                destination_table.appendChild(tr);
                destination_select__programmedtrip.appendChild(option);
            });
        })
        .catch(error => {
            console.log("Ocurrio un error:", error);
        });

    // programacion de hor
    fetch("admin.php?action=list-programmed-trip")
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            const programmedTrip_table = document.getElementById("programmedTrip_table");

            data.forEach(programeedtrip => {
                const tr = document.createElement("tr");

                tr.innerHTML = `
                            <td>${programeedtrip.ProgrammedTripID}</td>
                            <td>${programeedtrip.Name}</td>
                            <td>${programeedtrip.Description}</td>
                            <td>${programeedtrip.StartDate}</td>
                            <td>${programeedtrip.EndDate}</td>
                            <td>${programeedtrip.MaxCapacity}</td>
                            <td>${programeedtrip.Price}</td>
                            <td>${programeedtrip.DestinationID}</td>
                            <td>
                                <form action="admin.php?action=get-programmed-trip" method="POST" class="d-inline">
                                    <input type="hidden" name="programmedTrip_id" value="${programeedtrip.ProgrammedTripID}">
                                    <button type="submit" name="get_programmedTrip" class="btn btn-info btn-sm">Editar</button>
                                </form>
                                <form action="admin.php?action=delete-programmed-trip" method="POST" class="d-inline">
                                    <input type="hidden" name="programmedTrip_id" value="${programeedtrip.ProgrammedTripID}">
                                    <button type="submit" name="delete_programmedTrip" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                            `;

                programmedTrip_table.appendChild(tr);
            });
        })
        .catch(error => {
            console.log("Ocurrio un error:", error);
        });

    // metodos de pago
    fetch("admin.php?action=list-payment-method")
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            const paymentMethod_table = document.getElementById("paymentMethod_table");

            data.forEach(paymentMethod => {
                const tr = document.createElement("tr");

                tr.innerHTML = `
                            <td>${paymentMethod.PaymentMethodID}</td>
                            <td>${paymentMethod.Name}</td>
                            <td>${paymentMethod.Description}</td>
                            <td>
                                <form action="admin.php?action=get-payment-method" method="POST" class="d-inline">
                                    <input type="hidden" name="paymentMethod_id" value="${paymentMethod.PaymentMethodID}">
                                    <button type="submit" name="get_paymentMethod" class="btn btn-info btn-sm">Editar</button>
                                </form>
                                <form action="admin.php?action=delete-payment-method" method="POST" class="d-inline">
                                    <input type="hidden" name="paymentMethod_id" value="${paymentMethod.PaymentMethodID}">
                                    <button type="submit" name="delete_paymentMethod" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                            `;

                paymentMethod_table.appendChild(tr);
            });
        })
        .catch(error => {
            console.log("Ocurrio un error:", error);
        });

    //actividades
    fetch("admin.php?action=list-activity")
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            const activity_table = document.getElementById("activity_table");

            data.forEach(activity => {
                const tr = document.createElement("tr");

                tr.innerHTML = `
                            <td>${activity.ActivityID}</td>
                            <td>${activity.Name}</td>
                            <td>${activity.Description}</td>
                            <td>${activity.Price}</td>
                            <td>
                                <form action="admin.php?action=get-activity" method="POST" class="d-inline">
                                    <input type="hidden" name="activity_id" value="${activity.ActivityID}">
                                    <button type="submit" name="get_activity" class="btn btn-info btn-sm">Editar</button>
                                </form>
                                <form action="admin.php?action=delete-activity" method="POST" class="d-inline">
                                    <input type="hidden" name="activity_id" value="${activity.ActivityID}">
                                    <button type="submit" name="delete_activity" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                            `;

                activity_table.appendChild(tr);
            });
        })
        .catch(error => {
            console.log("Ocurrio un error:", error);
        });
});