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
    <?php
    if (isset($_SESSION['modal'])) {
        $titleModal = $_SESSION['modal']['title'];
        $msgModal = $_SESSION['modal']['message'];

        include('../views/viewModal.php');

        unset($_SESSION['modal']);
    }
    ?>
    <section class="planning_trip_section">
        <header class="planning_trip_section__header" id="id=" dynamic_header"">
            <a href="./" class="img_box__a">
                <img src="../../assets/img/enterprise_logo.png" alt="logo de la empresa">
            </a>
            <nav class="planning_trip_section__header__nav">
                <button id="button_profile_user" type="button"></button>
            </nav>
            <div class="hidden" id="menu_profile_user">
                <ul>
                    <li><a href="">Ver Perfil</a></li>
                    <li><a href="./logout">Cerrar Sesión</a></li>
                </ul>
            </div>
        </header>
        <div class="container_form">
            <div class="intro_banner">
                <h1>Viaja y Descubre</h1>
                <p>Conéctate con la naturaleza, la cultura y la aventura. Nuestro equipo está aquí para planear el viaje
                    perfecto para ti.</p>
            </div>
            <form class="form_planning_trip" action="./payment" method="POST">
                <div class="full_width">
                    <h1>Escoge tu Viaje Ideal</h1>
                    <p>Completa el formulario y te ayudaremos con el viaje perfecto.</p>
                </div>
                <div class="custom-dropdown full_width">
                    <label for="">Seleccione un viaje</label>
                    <div class="dropdown-selected" id="select_list_programmed_trips">Selecciona una opción</div>
                    <input type="hidden" id="selected_trip_id" name="ProgrammedTripID" value="">
                    <div class="dropdown-options" id="list_programmed_trips"></div>
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
                        <input class="input_readonly" id="trip_date" type="text"
                            placeholder="Fecha del viaje seleccionado" disabled>
                    </div>
                    <div class="half_width">
                        <label for="">Precio del viaje</label>
                        <input class="input_readonly" id="trip_price" type="text"
                            placeholder="Precio del viaje seleccionado" disabled>
                    </div>
                </div>
                <button type="submit">Reservar</button>
            </form>
        </div>
    </section>
    <script src="../scripts/scriptFormPlanningTrip.js"></script>
</body>

</html>