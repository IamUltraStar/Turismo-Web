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
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>
<body>
    <section class="hero_section">
        <img class="hero_section_bg" src="../../assets/img/home_page_bg.jpg" alt="">
        <div class="hero_section_bg-effect"></div>
        <div style="position: relative; padding: 40px 0;">
            <header class="hero_section__header" id="dynamic_header">
                <a href="view.php" class="img_box__a">
                    <img src="../../assets/img/enterprise_logo.png" alt="">
                </a>
                <nav class="hero_section__header__nav">
                    <a href="view.php?view=view-destinations">Destinos</a>
                    <a href="view.php#about_us_section">Acerca de Nosotros</a>
                    <a href="view.php#contact_us_section">Contacto</a>
                    <a class="<?php echo $opcLogin; ?>" href="view.php?view=view-login">Iniciar Sesión</a>
                    <a class="<?php echo $opcLogin; ?>" id="button_sing_up" href="view.php?view=view-register">Registrarme</a>
                    <button class="<?php echo $opcUser; ?>" id="button_profile_user" type="button"><?php echo $initials; ?></button>
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
            <h1>Tu Próxima Aventura Te Espera</h1>
            <p>Haz clic para encontrar el plan perfecto para tu próxima escapada</p>
            <form action="view.php" method="GET">
                <input type="hidden" name="view" value="form-planning-trip">
                <button type="submit">Planificar mi viaje</button>
            </form>
        </div>
    </section>
    <section class="destinations_section">
        <header class="destinations_section__header">
            <h1>Explora los Destinos Más Populares</h1>
            <p>Aquí están los destinos favoritos de nuestros viajeros, ¡anímate a conocerlos!</p>
        </header>
        <div class="destinations_section__container">
            <?php foreach ($arrayDestination as $destination): ?>
                <div class="card">
                    <img src="<?php echo htmlspecialchars($destination['Image']); ?>" alt="">
                    <div class="card_body">
                        <h1><?php echo $destination['Name']; ?></h1>
                        <p class="card_body__description"><?php echo $destination['Description']; ?></p>
                        <form action="view.php" method="GET">
                            <input type="hidden" name="view" value="view-destinations">
                            <input type="hidden" name="destination" value="<?php echo $destination['DestinationID']; ?>">
                            <button type="submit">Ver más</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="about_us_section" id="about_us_section">
        <header class="about_us_section__header">
            <div>
                <h1>ACERCA DE NOSOTROS</h1>
            </div>
        </header>
        <div class="about_us_section__body">
            <p>En Turismo Piesco, creemos que cada viaje es una oportunidad para descubrir, conectar y vivir experiencias únicas. Somos una empresa apasionada por el turismo nacional, comprometida con mostrarte la riqueza cultural, histórica y natural que nuestro país tiene para ofrecer.</p>
            <p>Desde nuestras primeras rutas hasta los itinerarios más personalizados, trabajamos para que cada viajero disfrute de un servicio excepcional, con atención a los detalles y un enfoque en crear recuerdos inolvidables.</p>
            <p>Nuestra misión es inspirarte a explorar, nuestra visión es convertirnos en tu compañero de aventuras, y nuestros valores están enfocados en la sostenibilidad, la diversidad y el amor por nuestro territorio. ¡Déjanos ayudarte a planear tu próximo gran viaje y vive la magia de viajar con nosotros!</p>
        </div>
    </section>
    <section class="contact_us_section" id="contact_us_section">
        <div class="contact_us_section__information">
            <h2>Informacion de Contacto</h2>
            <div>
                <i class="fi fi-rr-marker"></i>
                <p>Calle 123, Lima</p>
            </div>
            <div>
                <i class="fi fi-rr-envelope"></i>
                <p>piesco_turismo@gmail.com</p>
            </div>
            <div>
                <i class="fi fi-rr-phone-call"></i>
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
                <textarea class="contact_us_input" name="" id="" cols="30" rows="5" placeholder="Ingresa tu mensaje"></textarea>
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
    <script>
        const url = new URL(window.location);

        if (url.searchParams.has('view')) {
            url.searchParams.delete('view');
            window.history.replaceState({}, document.title, url);
        }
    </script>
    <script src="../scripts/scriptHeroSection.js"></script>
</body>
</html>