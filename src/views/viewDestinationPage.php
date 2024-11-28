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
</head>
<body>
    <section class="hero_section">
        <img class="hero_section_bg" src="<?php echo $dataDestination['Image']; ?>" alt="">
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
                </nav>
                <div class="hidden" id="menu_profile_user">
                    <ul>
                        <li><a href="">Ver Perfil</a></li>
                        <li><a href="authentication.php?action=logout">Cerrar Sesión</a></li>
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
            <button>Reservar</button>
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
    <script src="../scripts/scriptHeroSection.js"></script>
    <script src="../scripts/scriptDestinationPage.js"></script>
</body>
</html>