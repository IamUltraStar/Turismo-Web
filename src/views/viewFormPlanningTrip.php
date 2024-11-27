<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planificar mi viaje</title>
    <link rel="icon" href="../../assets/img/enterprise_logo.png">
    <link rel="stylesheet" href="../../assets/css/styleFormPlanningTrip.css">
</head>
<body>
    <section class="planning_trip_section">
        <header class="planning_trip_section__header" id="id="dynamic_header"">
            <a href="view.php" class="img_box__a">
                <img src="../../assets/img/enterprise_logo.png" alt="">
            </a>
            <nav class="planning_trip_section__header__nav">
                <button class="<?php echo $opcUser; ?>" id="button_profile_user" type="button"><?php echo $initials; ?></button>
            </nav>
            <div class="hidden" id="menu_profile_user">
                <ul>
                    <li><a href="">Ver Perfil</a></li>
                    <li><a href="authentication.php?action=logout">Cerrar Sesión</a></li>
                </ul>
            </div>
        </header>
        <div class="container_form">
            <div class="intro_banner">
                <h1>Viaja y Descubre</h1>
                <p>Conéctate con la naturaleza, la cultura y la aventura. Nuestro equipo está aquí para planear el viaje perfecto para ti.</p>
            </div>
            <form class="form_planning_trip" action="view.php?view=payment-page" method="POST">
                <div class="full_width">
                    <h1>Escoge tu Viaje Ideal</h1>
                    <p>Completa el formulario y te ayudaremos con el viaje perfecto.</p>
                </div>
                <div class="custom-dropdown full_width">
                    <label for="">Seleccione un viaje</label>
                    <div class="dropdown-selected" id="select_list_programmed_trips">Selecciona una opción</div>
                    <input type="hidden" id="selected_trip_id" name="ProgrammedTripID" value="">
                    <div class="dropdown-options" id="list_programmed_trips">
                        <?php foreach ($arrayProgrammedTrip as $programmedTrip): ?>
                            <div class="dropdown-option" data-id="<?php echo $programmedTrip['ProgrammedTripID']; ?>"><?php echo $programmedTrip['Name']; ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="full_width">
                    <label for="">Número de telefono</label>
                    <input type="tel" name="PhoneNumber" placeholder="Ingrese su numero de telefono">
                  </div>
                <div class="full_width">
                    <label for="">Cantidad de personas</label>
                    <input type="number" name="NumberPeople" placeholder="Ingrese la cantidad de personas">
                </div>
                <div class="row">
                    <div class="half_width">
                        <label for="">Fecha del viaje</label>
                        <input class="input_readonly" id="trip_date" type="text" placeholder="Fecha del viaje seleccionado" disabled>
                    </div>
                    <div class="half_width">
                        <label for="">Precio del viaje</label>
                        <input class="input_readonly" id="trip_price" type="text" placeholder="Precio del viaje seleccionado" disabled>
                    </div>
                </div>
                <button type="submit">Reservar</button>
            </form>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const button_profile_user = document.getElementById('button_profile_user');
            const menu_profile_user = document.getElementById('menu_profile_user');
            const select_list_programmed_trips = document.getElementById('select_list_programmed_trips');
            const list_programmed_trips = document.getElementById('list_programmed_trips');
            const hiddenInput = document.getElementById('selected_trip_id');
            const tripDateField = document.getElementById('trip_date');
            const tripPriceField = document.getElementById('trip_price');

            // Mostrar/ocultar el menú al hacer clic en el ícono
            button_profile_user.addEventListener('click', () => {
                menu_profile_user.classList.toggle('hidden');
            });

            select_list_programmed_trips.addEventListener('click', () => {
                list_programmed_trips.classList.toggle('active');
            });

            // Ocultar el menú al hacer clic fuera de él
            document.addEventListener('click', (event) => {
                if (!menu_profile_user.contains(event.target) && event.target !== button_profile_user) {
                    menu_profile_user.classList.add('hidden');
                }

                if (!list_programmed_trips.contains(event.target) && event.target !== select_list_programmed_trips) {
                    list_programmed_trips.classList.remove('active');
                }
            });

            document.querySelectorAll('.dropdown-option').forEach(option => {
                option.addEventListener('click', function() {
                    const tripId = this.getAttribute('data-id');
                    select_list_programmed_trips.innerText = this.innerText;
                    hiddenInput.value = tripId;
                    list_programmed_trips.classList.remove('active');
                    
                    let ajax = new XMLHttpRequest();
                    ajax.open("POST", "data.php?action=get-date-programmed-trip", true);
                    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    ajax.send(`tripId=${tripId}`);

                    ajax.onreadystatechange = function () {
                        if (this.readyState === 4 && this.status === 200) {
                            const response = JSON.parse(this.responseText);

                            tripDateField.value = response['StartDate'] || "No disponible";
                            tripPriceField.value = response['Price'] || "No disponible";
                        }
                    }
                });
            });
        });

    </script>
</body>
</html>