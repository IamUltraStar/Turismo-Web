<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinos</title>
    <link rel="icon" href="../../assets/img/enterprise_logo.png">
    <link rel="stylesheet" href="../../assets/css/styleHeroSection.css">
    <link rel="stylesheet" href="../../assets/css/styleDestinationsPage.css">
    <link rel="stylesheet" href="../../assets/css/styleFooter.css">
</head>
<body>
    <section class="hero_section">
        <img class="hero_section_bg" src="../../assets/img/home_page_bg.webp" alt="">
        <div class="hero_section_bg-effect"></div>
        <div style="position: relative; padding: 40px 0;">
            <header class="hero_section__header" id="dynamic_header">
                <a href="view.php" class="img_box__a">
                    <img src="../../assets/img/enterprise_logo.png" alt="logo de la empresa">
                </a>
                <nav class="hero_section__header__nav">
                    <a href="view.php?view=view-destinations">Destinos</a>
                    <a href="view.php#about_us_section">Acerca de Nosotros</a>
                    <a href="view.php#contact_us_section">Contacto</a>
                    <a class="" id="button_login" href="view.php?view=view-login">Iniciar Sesión</a>
                    <a class="" id="button_sing_up" href="view.php?view=view-register">Registrarme</a>
                    <button class="" id="button_profile_user" type="button"></button>
                <div class="hidden" id="menu_profile_user">
                    <ul>
                        <li><a href="">Ver Perfil</a></li>
                        <li><a href="authentication.php?action=logout">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </header>
        </div>
        <div class="hero_section__cta_box">
            <h1>Explora nuestros destinos ahora</h1>
            <p>Descubre las maravillas que hemos preparado para ti. Desliza hacia abajo y encuentra el destino perfecto para tu próxima aventura.</p>
        </div>
    </section>
    <section class="destinations_section">
        <header class="destinations_section__header">
            <h1>Explora todos los Destinos Disponibles</h1>
            <p>Aquí están todos los destinos que ofrecemos a nuestros viajeros, ¡anímate a conocerlos!</p>
        </header>
        <div class="destinations_section__container" id="destinations_section__container"></div>
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
    <script>
        const action = "list-destination";
    </script>
    <script src="../scripts/scriptHeroSection.js"></script>
    <script src="../scripts/scriptLoadDestinations.js"></script>
</body>
</html>