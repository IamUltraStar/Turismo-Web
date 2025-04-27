<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titleTab; ?></title>
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

    if (isset($_SESSION['view_forgotPassword'])) {
        include(ROOT_PATH . '/views/viewForgotPasswordModal.php');
        unset($_SESSION['view_forgotPassword']);
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
                <h1>Explora Sin Límites</h1>
                <p>Tu próxima aventura está a un paso. Crea tu cuenta y empieza a explorar con nosotros.</p>
            </div>
            <form id="form-login" class="form_login <?php echo $visibleFormLogin; ?>">
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
                    <a href="<?= base_url("login/forgot-password") ?>" class="forgot_password">Olvidaste tu
                        contraseña?</a>
                </div>
                <button data-form-id="form-login">Iniciar sesión</button>
                <p>No estas registrado? <a href="<?= base_url("register") ?>">Registrate ahora</a></p>
            </form>
            <form id="form-register" class="form_login <?php echo $visibleFormRegister; ?>">
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
                <button data-form-id="form-register">Registrarme</button>
                <p>Ya estas registrado? <a href="<?= base_url("login") ?>">Inicia sesión ahora</a></p>
            </form>
        </div>
    </section>
    <script>
        document.querySelectorAll('button[data-form-id]').forEach(button => {
            button.addEventListener('click', async function (event) {
                event.preventDefault();

                const formID = this.getAttribute('data-form-id');
                const form = document.getElementById(formID);
                const formData = new FormData(form);

                // Convertir FormData a un formato URL-encoded para AJAX
                const params = new URLSearchParams();
                for (let [key, value] of formData) {
                    params.append(key, value);
                }

                const actionUrl = formID == "form-login" ? "<?= base_url("login/execute-login") ?>" : "<?= base_url("login/execute-register") ?>";

                try {
                    const response = await fetch(actionUrl, {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: params.toString(),
                    });

                    if (response.ok) {
                        const result = await response.text();

                        if (result !== "0" && result !== "-1") {
                            handleModal(result);
                        } else {
                            window.location.href = result === "0" ? "<?= base_url("") ?>" : "<?= base_url("admin") ?>";
                        }
                    } else {
                        console.error("Error al enviar el formulario:", response.status);
                        alert("Hubo un error al enviar el formulario.");
                    }
                } catch (error) {
                    console.error("Error en la solicitud:", error);
                }
            });
        });

        function handleModal(responseText) {
            let msgModal = "";

            switch (responseText) {
                case "-2": msgModal = "Se envio un correo de activación a su correo."; break;
                case "1": msgModal = "Debe completar ambos campos."; break;
                case "2": msgModal = "Credenciales incorrectas."; break;
                case "3": msgModal = "Debes completar todos los campos."; break;
                case "4": msgModal = "Las contraseñas no coinciden."; break;
                case "5": msgModal = "Dominio de correo no permitido."; break;
                case "6": msgModal = "Este correo ya está registrado."; break;
                case "7": msgModal = "Este usuario ya está registrado."; break;
                default: msgModal = `Error. Inténtalo de nuevo. ${responseText}`; break;
            }

            if (!document.getElementById('dialog-modal')) {
                fetch("../views/viewModal.php")
                    .then(res => res.text())
                    .then(html => {
                        document.body.insertAdjacentHTML("beforeend", html);
                        document.getElementById('title-modal').innerText = '¡Ups! Algo Ocurrió';
                        if (responseText == "-2") {
                            document.getElementById('title-modal').innerText = '¡Éxito! Correo enviado';
                        }
                        document.getElementById('msg-modal').innerText = msgModal;
                    });
            } else {
                document.getElementById('dialog-modal').show();
                document.getElementById('title-modal').innerText = '¡Ups! Algo Ocurrió';
                document.getElementById('msg-modal').innerText = msgModal;
            }
        }
    </script>
</body>

</html>