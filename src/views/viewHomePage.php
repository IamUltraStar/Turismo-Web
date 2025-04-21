<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turismo Piesco</title>
    <link rel="icon" href="../../assets/img/enterprise_logo.png">
    <link rel="stylesheet" href="../../assets/css/styleHeroSection.css">
    <link rel="stylesheet" href="../../assets/css/styleHomePage.css">
    <link rel="stylesheet" href="../../assets/css/styleFooter.css">
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['modal'])) {
        $titleModal = $_SESSION['modal']['title'];
        $msgModal = $_SESSION['modal']['message'];

        include('../views/viewModal.php');

        unset($_SESSION['modal']);
    }
    ?>
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
            <img class="hero_section_bg" src="../../assets/img/home_page_bg.webp" alt="">
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
                <h1>Tu Próxima Aventura Te Espera</h1>
                <p>Haz clic para encontrar el plan perfecto para tu próxima escapada</p>
                <form action="./formPlanningTrip">
                    <button type="submit">Planificar mi viaje</button>
                </form>
            </div>
        </section>
        <section class="destinations_section">
            <header class="destinations_section__header">
                <h1>Explora los Destinos Más Populares</h1>
                <p>Aquí están los destinos favoritos de nuestros viajeros, ¡anímate a conocerlos!</p>
            </header>
            <div class="destinations_section__container" id="destinations_section__container"></div>
        </section>
        <section class="about_us_section" id="about_us_section">
            <header class="about_us_section__header">
                <div>
                    <h1>ACERCA DE NOSOTROS</h1>
                </div>
            </header>
            <div class="about_us_section__body">
                <p>En Turismo Piesco, creemos que cada viaje es una oportunidad para descubrir, conectar y vivir
                    experiencias únicas. Somos una empresa apasionada por el turismo nacional, comprometida con
                    mostrarte la riqueza cultural, histórica y natural que nuestro país tiene para ofrecer.</p>
                <p>Desde nuestras primeras rutas hasta los itinerarios más personalizados, trabajamos para que cada
                    viajero disfrute de un servicio excepcional, con atención a los detalles y un enfoque en crear
                    recuerdos inolvidables.</p>
                <p>Nuestra misión es inspirarte a explorar, nuestra visión es convertirnos en tu compañero de aventuras,
                    y nuestros valores están enfocados en la sostenibilidad, la diversidad y el amor por nuestro
                    territorio. ¡Déjanos ayudarte a planear tu próximo gran viaje y vive la magia de viajar con
                    nosotros!</p>
            </div>
        </section>
        <section class="contact_us_section" id="contact_us_section">
            <div class="contact_us_section__information">
                <h2>Informacion de Contacto</h2>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <p>Calle 123, Lima</p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <p>piesco_turismo@gmail.com</p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    <p>+51 912 323 123</p>
                </div>
            </div>
            <form class="contact_us_section__form" action="" method="">
                <h2>Enviar un mensaje</h2>
                <div class="row">
                    <div class="contact_us_box half_width">
                        <input class="contact_us_input" type="text" placeholder="">
                        <label class="contact_us_input__label" for="">Nombre</label>
                    </div>
                    <div class="contact_us_box half_width">
                        <input class="contact_us_input" type="text" placeholder="">
                        <label class="contact_us_input__label" for="">Apellido</label>
                    </div>
                </div>
                <div class="row">
                    <div class="contact_us_box half_width">
                        <input class="contact_us_input" type="text" placeholder="">
                        <label class="contact_us_input__label" for="">Correo Electronico</label>
                    </div>
                    <div class="contact_us_box half_width">
                        <input class="contact_us_input" type="text" placeholder="">
                        <label class="contact_us_input__label" for="">Numero de telefono</label>
                    </div>
                </div>
                <div>
                    <textarea class="contact_us_input" name="" id="" cols="30" rows="5"
                        placeholder="Ingresa tu mensaje"></textarea>
                </div>
                <div class="button_box">
                    <button>Enviar</button>
                </div>
            </form>
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
    <script>const action = "listPopularDestinations";</script>
    <script src="../scripts/scriptHeroSection.js"></script>
    <script src="../scripts/scriptLoadDestinations.js"></script>
    <script>
        if (window.location.hash) {
            setTimeout(() => {
                let hash = window.location.hash;
                if (hash) {
                    const targetElement = document.querySelector(hash);
                    if (targetElement) {
                        targetElement.scrollIntoView({ behavior: "smooth" });
                    }
                }
            }, 200);
        }
    </script>
</body>

</html>