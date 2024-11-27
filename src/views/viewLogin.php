<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titleTab; ?></title>
    <link rel="icon" href="../../assets/img/enterprise_logo.png">
    <link rel="stylesheet" href="../../assets/css/styleLogin.css">
</head>
<body>
    <section class="login_section">
        <header class="login_section__header">
            <a href="view.php" class="img_box__a">
                <img src="../../assets/img/enterprise_logo.png" alt="">
            </a>
        </header>
        <div class="container_form">
            <div class="intro_banner">
                <h1>Explora Sin Límites</h1>
                <p>Tu próxima aventura está a un paso. Crea tu cuenta y empieza a explorar con nosotros.</p>
            </div>
            <form class="form_login <?php echo $visibleFormLogin; ?>" action="../controllers/authentication.php?action=execute-login" method="POST">
                <div class="login_input_box">
                    <h1>Bienvenido de nuevo</h1>
                    <p>Inicia sesión para disfrutar de las mejores opciones de viaje a tu alcance.</p>
                </div>
                <div class="login_input_box">
                    <input class="login_input" type="text" name="username" placeholder="">
                    <label class="login_input__label" for="">Nombre de Usuario</label>
                </div>
                <div class="login_input_box">
                    <input class="login_input" type="password" name="password" placeholder="">
                    <label class="login_input__label" for="">Contraseña</label>
                </div>
                <button>Iniciar sesión</button>
                <p>No estas registrado? <a href="view.php?view=view-register">Registrate ahora</a></p>
            </form>
            <form class="form_login <?php echo $visibleFormRegister; ?>" action="../controllers/authentication.php?action=execute-register" method="POST">
                <div class="login_input_box">
                    <h1>Registrate ahora</h1>
                    <p>Completa el formulario y permítenos guiarte hacia experiencias inolvidables.</p>
                </div>
                <div class="login_input_box">
                    <input class="login_input" type="text" name="name" placeholder="">
                    <label class="login_input__label" for="">Nombres</label>
                </div>
                <div class="login_input_box">
                    <input class="login_input" type="text" name="email" placeholder="">
                    <label class="login_input__label" for="">Correo Electronico</label>
                </div>
                <div class="login_input_box">
                    <input class="login_input" type="text" name="username" placeholder="">
                    <label class="login_input__label" for="">Nombre de Usuario</label>
                </div>
                <div class="row">
                    <div class="login_input_box half_width">
                        <input class="login_input" type="password" name="password" placeholder="">
                        <label class="login_input__label" for="">Contraseña</label>
                    </div>
                    <div class="login_input_box half_width">
                        <input class="login_input" type="password" name="password1" placeholder="">
                        <label class="login_input__label" for="">Repetir Contraseña</label>
                    </div>
                </div>
                <button>Registrarme</button>
                <p>Ya estas registrado? <a href="view.php?view=view-login">Inicia sesión ahora</a></p>
            </form>
        </div>
    </section>
</body>
</html>