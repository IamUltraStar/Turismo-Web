<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinos</title>
    <link rel="icon" href="../../assets/img/enterprise_logo.png">
    <link rel="stylesheet" href="../../assets/css/styleHeroSection.css">
    <link rel="stylesheet" href="../../assets/css/styleDestinationPage.css">
    <link rel="stylesheet" href="../../assets/css/styleFooter.css">
    <script src="https://cdn.maptiler.com/maptiler-sdk-js/v3.0.1/maptiler-sdk.umd.min.js"></script>
    <link href="https://cdn.maptiler.com/maptiler-sdk-js/v3.0.1/maptiler-sdk.css" rel="stylesheet" />
</head>

<body>
    <input id="dynamic_burger_input" type="checkbox" class="hidden">
    <aside class="hero_section__sidebar" id="dynamic_sidebar">
        <a href="./" class="img_box__a">
            <img src="../../assets/img/enterprise_logo.png" alt="logo de la empresa">
        </a>
        <nav class="hero_section__header__nav">
            <a href="./destinations" onclick="burger_buttonClicked()">Destinos</a>
            <a href="./#about_us_section" onclick="burger_buttonClicked()">Acerca de Nosotros</a>
            <a href="./#contact_us_section" onclick="burger_buttonClicked()">Contacto</a>
        </nav>
    </aside>
    <header class="hero_section__burger_container" id="dynamic_burger_container">
        <label class="toggle" for="dynamic_burger_input" id="dynamic_burger_button">
            <div id="bar1" class="bars"></div>
            <div id="bar2" class="bars"></div>
            <div id="bar3" class="bars"></div>
        </label>
        <nav>
            <a class="" id="button_login_mobile" href="./login">Iniciar Sesión</a>
            <a class="button_sign_up" id="button_sign_up_mobile" href="./register">Registrarme</a>
            <button class="button_profile_user" id="button_profile_user_mobile" type="button"></button>
        </nav>
    </header>
    <main>
        <section class="hero_section">
            <img class="hero_section_bg" src="<?php echo $dataDestination['Image']; ?>" alt="">
            <div class="hero_section_bg-effect"></div>
            <div style="position: relative; padding: 40px 0;">
                <header class="hero_section__header" id="dynamic_header">
                    <a href="./" class="img_box__a">
                        <img src="../../assets/img/enterprise_logo.png" alt="logo de la empresa">
                    </a>
                    <nav class="hero_section__header__nav">
                        <a href="./destinations">Destinos</a>
                        <a href="./#about_us_section">Acerca de Nosotros</a>
                        <a href="./#contact_us_section">Contacto</a>
                        <a class="" id="button_login" href="./login">Iniciar Sesión</a>
                        <a class="button_sign_up" id="button_sign_up" href="./register">Registrarme</a>
                        <button class="button_profile_user" id="button_profile_user" type="button"></button>
                    </nav>
                    <div class="hidden" id="menu_profile_user">
                        <ul>
                            <li><a href="">Ver Perfil</a></li>
                            <li><a href="./logout">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </header>
            </div>
            <div class="hero_section__cta_box">
                <h1><?php echo $dataDestination['DestinationName']; ?></h1>
            </div>
        </section>
        <section class="information_section">
            <div class="information_section__description">
                <p><?php echo $dataDestination['Description']; ?></p>
                <p><b>Ubicación:</b> <?php echo $dataDestination['Location']; ?></p>
                <p><b>Categoría:</b> <?php echo $dataDestination['CategoryName']; ?></p>
            </div>
            <div class="information_section__activities">
                <h1>Actividades</h1>
                <div id="information_section__activities_container"></div>
            </div>
            <div class="information_section__reservation">
                <p id="price_dataProgrammedTrip"></p>
                <form id="form-planning-trip">
                    <button>Reservar</button>
                </form>
            </div>
            <div class="information_section__map">
                <div id="map"></div>
                <a id="linkGoogleMaps" target="_blank">Ir a Google Maps</a>
            </div>
            <div class="information_section__photos">
                <h1>Fotos de usuarios</h1>
                <div id="information_section__photos_container"></div>
            </div>
        </section>
        <footer>
            <p>&copy; 2024 Turismo Piesco. Todos los derechos reservados.</p>
            <p>Síguenos en:</p>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Facebook</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Instagram</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Twitter</a>
                </li>
            </ul>
        </footer>
    </main>
    <a class="scrollToTopButton" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
        </svg>
    </a>
    <script>
        const nameDestination = "<?php echo $dataDestination['DestinationName']; ?>";
    </script>
    <script src="../scripts/scriptHeroSection.js"></script>
    <script src="../scripts/scriptDestinationPage.js"></script>
</body>

</html>