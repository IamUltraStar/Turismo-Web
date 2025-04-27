<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinos</title>
    <link rel="icon" href="<?= base_url("../../assets/img/enterprise_logo.png") ?>">
    <link rel="stylesheet" href="<?= base_url("../../assets/css/styleHeroSection.css") ?>">
    <link rel="stylesheet" href="<?= base_url("../../assets/css/styleDestinationPage.css") ?>">
    <link rel="stylesheet" href="<?= base_url("../../assets/css/styleFooter.css") ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.maptiler.com/maptiler-sdk-js/v3.0.1/maptiler-sdk.umd.min.js"></script>
    <link href="https://cdn.maptiler.com/maptiler-sdk-js/v3.0.1/maptiler-sdk.css" rel="stylesheet" />
</head>

<body>
    <?php if (isset($_SESSION['modal'])): ?>
        <?php
        $titleModal = $_SESSION['modal']['title'];
        $msgModal = $_SESSION['modal']['message'];

        include(ROOT_PATH . '/views/viewModal.php');

        unset($_SESSION['modal']);
        ?>
    <?php else: ?>
        <div class="initLoader">
            <canvas id="canvas" width="220" height="220"></canvas>
        </div>
        <script type="module">
            history.scrollRestoration = 'manual';

            document.body.style.overflow = "hidden";
            import { DotLottie } from "<?= base_url("../services/DotLottie/DotLottie.js") ?>";

            new DotLottie({
                autoplay: true,
                loop: true,
                speed: 1.5,
                canvas: document.getElementById("canvas"),
                src: "<?= base_url("../../assets/lottie/utmuJXMSRn.lottie") ?>",
            });

            window.scrollTo(0, 0);

            setTimeout(() => {
                document.body.style.overflow = "auto";
                document.querySelector(".initLoader").style.display = "none";
            }, 3200); // 3200
        </script>
    <?php endif; ?>
    <input id="dynamic_burger_input" type="checkbox" class="hidden">
    <aside class="hero_section__sidebar" id="dynamic_sidebar">
        <a href="<?= base_url() ?>" class="img_box__a">
            <img src="<?= base_url("../../assets/img/enterprise_logo.png") ?>" alt="logo de la empresa">
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
                    <a href="<?= base_url() ?>" class="img_box__a">
                        <img src="<?= base_url("../../assets/img/enterprise_logo.png") ?>" alt="logo de la empresa">
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
                            <li><a href="<?= base_url("profile") ?>">Ver Perfil</a></li>
                            <li><a href="<?= base_url("logout") ?>">Cerrar Sesión</a></li>
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
                <div class="information_section__map__options">
                    <button onclick="relocateDestination()">Reubicar destino</button>
                    <a id="linkGoogleMaps" target="_blank">Ir a Google Maps</a>
                </div>
            </div>
            <div class="information_section__photos">
                <h1 class="text-xl font-semibold">Fotos de usuarios</h1>
                <div id="information_section__photos_container">
                    No hay fotos disponibles.
                </div>
            </div>
            <div class="information_section__reviews space-y-8">
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold">Comentarios</h2>
                    <div class="information_section__reviews_container space-y-6">
                        <?php if (isset($dataReviews) && !empty($dataReviews)): ?>
                            <?php foreach ($dataReviews as $review): ?>
                                <div class="information_section__reviews_container__review flex gap-4 p-4 border-b">
                                    <div class="flex-shrink-0">
                                        <img src="<?= base_url("../../assets/img/user_profile.png") ?>" alt="avatar"
                                            loading="lazy" width="40" height="40" class="rounded-full">
                                    </div>
                                    <div class="flex-1 space-y-2">
                                        <div class="flex items-center justify-between">
                                            <div class="font-medium"><?php echo $review['FullName']; ?></div>
                                            <div class="text-sm text-gray-600"><?= $review['ReviewDate'] ?></div>
                                        </div>
                                        <div class="flex">
                                            <?php for ($i = 0; $i < 5; $i++): ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="lucide lucide-star-icon lucide-star w-4 h-4 <?= ($i <= $review['Rating']) ? 'fill-amber-400 text-amber-400' : 'text-gray-600' ?>">
                                                    <path
                                                        d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="text-sm"><?php echo $review['Comment']; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="information_section__reviews__container__no_reviews">No hay comentarios
                                disponibles.</p>
                        <?php endif; ?>
                    </div>
                    <form class="space-y-4 p-4 border rounded-md" action="<?= base_url("destinations/send-review") ?>"
                        method="POST">
                        <h2 class="text-xl font-semibold">Comparte tu experiencia</h2>
                        <div class="information_section__reviews_container__review__rating space-y-2">
                            <input type="hidden" name="idDest" value="<?= $dataDestination['DestinationID']; ?>">
                            <input type="hidden" id="rating" name="rating">
                            <label for=""
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Puntuación</label>
                            <div class="stars" id="stars">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <button type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="lucide lucide-star-icon lucide-star w-6 h-6 transition-colors text-gray-600 hover:fill-amber-200 hover:text-amber-200">
                                            <path
                                                d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                                        </svg>
                                    </button>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="information_section__reviews_container__review__text space-y-2">
                            <label for=""
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Escribe
                                tu reseña</label>
                            <textarea
                                class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-gray-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                id="comment" name="comment" rows="4"
                                placeholder="Comparte tu experiencia con este destino..." required></textarea>
                        </div>
                        <button
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-black text-white hover:bg-black/90 h-10 px-4 py-2"
                            type="submit">Enviar reseña</button>
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
    <a class="scrollToTopButton hidden" id="scrollToTopButton" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
        </svg>
    </a>
    <script>
        const nameDestination = "<?php echo $dataDestination['DestinationName']; ?>";
        const locationDestination = "<?php echo $dataDestination['Location']; ?>";
    </script>
    <script src="../scripts/scriptHeroSection.js"></script>
    <script src="../scripts/scriptDestinationPage.js"></script>
</body>

</html>