<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="icon" href="<?= base_url("../../assets/img/enterprise_logo.png") ?>">
    <link rel="stylesheet" href="<?= base_url("../../assets/css/styleLogin.css") ?>">
</head>

<body>
    <?php
    if (isset($_SESSION['modal'])) {
        $titleModal = $_SESSION['modal']['title'];
        $msgModal = $_SESSION['modal']['message'];

        include(ROOT_PATH . '/views/viewModal.php');

        unset($_SESSION['modal']);
    }
    ?>
    <section class="login_section">
        <header class="login_section__header">
            <a href="<?= base_url("") ?>" class="img_box__a">
                <img src="<?= base_url("../../assets/img/enterprise_logo.png") ?>" alt="logo de la empresa">
            </a>
        </header>
        <div class="container_form">
            <div class="intro_banner">
                <h1>Restablecer Contraseña</h1>
                <p>Recupera el acceso a tu cuenta y vuelve a disfrutar de nuestras experiencias.</p>
            </div>
            <form class="form_login" action="<?= base_url("login/update-password"); ?>" method="POST">
                <div class="login_input_box">
                    <h1>Restablecer Contraseña</h1>
                    <p>Ingresa tu nueva contraseña para continuar.</p>
                </div>
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="token" value="<?= $_GET['token'] ?>">
                <div class="login_input_box">
                    <input class="login_input" type="password" name="new_password" placeholder="">
                    <label class="login_input__label" for="">Nueva Contraseña</label>
                </div>
                <div class="login_input_box">
                    <input class="login_input" type="password" name="confirm_password" placeholder="">
                    <label class="login_input__label" for="">Confirmar Nueva Contraseña</label>
                </div>
                <button data-form-id="form-reset-password">Restablecer Contraseña</button>
            </form>
        </div>
    </section>
</body>

</html>